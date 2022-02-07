<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\ContractType;
use App\Models\Industry;
use App\Models\JobType;
use App\Models\Project;
use App\Models\ProjectContract;
use App\Models\Week;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'caseName' => 'required|string|max:1023',
            'unitPriceMin' => 'required',
            'unitPriceMax' => 'required',
            'jobType' => 'required',
            'industry' => 'required',
            'jobContent' => 'required',
            'requiredSkills' => 'required',
            'applicableSkills' => 'required',
            'requiredPerson' => 'required',
            'teamStructure' => 'required',
            'gainedSkills' => 'required',
            'workLocation' => 'required',
            'interviews' => 'required',
            'startDate' => 'required',
            'startTime' => 'required',
            'endTime' => 'required',
            'averageUptimeStart' => 'required',
            'averageUptimeEnd' => 'required',
            'week' => 'required',
            'contractType' => 'required',
            'onlineInterview' => 'required',
            'remoteWork' => 'required',
            'comment' => 'required',
        ]);
    }

    protected function createProject(array $data)
    {
        $project = Project::create([
            'name' => $data['caseName'],
            'price_min' => comma_to_number($data['unitPriceMin']),
            'price_max' => comma_to_number($data['unitPriceMax']),
            'job_type' => $data['jobType'],
            'industry' => $data['industry'],
            'content' => $data['jobContent'],
            'required_skills' => $data['requiredSkills'],
            'applicable_skills' => $data['applicableSkills'],
            'required_person' => $data['requiredPerson'],
            'team_structure' => $data['teamStructure'],
            'gained_skills' => $data['gainedSkills'],
            'work_location' => $data['workLocation'],
            'interviews' => $data['interviews'],
            'start_date' => $data['startDate'],
            'start_time' => $data['startTime'],
            'end_time' => $data['endTime'],
            'uptime_min' => $data['averageUptimeStart'],
            'uptime_max' => $data['averageUptimeEnd'],
            'week' => $data['week'],
            'online_interview' => $data['onlineInterview'],
            'remote_work' => $data['remoteWork'],
            'comment' => $data['comment'],
            'avatar' => $data['icon'] ?? 0,
            'client' => $data['fullName'] ?? 0,
            'user_id' => Auth::user()->id,
            'user_type' => Auth::user()->user_type,
        ]);
        if (isset($data['imagePath'])){
            $project->image = $data['imagePath'];
        }
        return $project;
    }

    public function create(Request $request) {
        if($request->file()) {
            $imageFile = $request->file('image');
            $fileName = $imageFile->hashName();
            $imagePath = $imageFile->storeAs('project', $fileName, 'public_uploads');
            $request->merge([
                'imagePath' => $imagePath,
            ]);
        }
        $this->validator($request->all())->validate();

        $project = $this->createProject($request->all());
        $project->save();
        
        foreach($request->contractType as $value => $status) {
            $project_contract = new ProjectContract;
            $project_contract->project_id = $project->id;
            $project_contract->contract_id = $value;
            $project_contract->save();
        }
        return back()->with('step', 3);
    }

    protected function updateProject(Project $project, array $data)
    {
        $project->name = $data['caseName'];
        $project->price_min = comma_to_number($data['unitPriceMin']);
        $project->price_max = comma_to_number($data['unitPriceMax']);
        $project->job_type = $data['jobType'];
        $project->industry = $data['industry'];
        $project->content = $data['jobContent'];
        $project->required_skills = $data['requiredSkills'];
        $project->applicable_skills = $data['applicableSkills'];
        $project->required_person = $data['requiredPerson'];
        $project->team_structure = $data['teamStructure'];
        $project->gained_skills = $data['gainedSkills'];
        $project->work_location = $data['workLocation'];
        $project->interviews = $data['interviews'];
        $project->start_date = $data['startDate'];
        $project->start_time = $data['startTime'];
        $project->end_time = $data['endTime'];
        $project->uptime_min = $data['averageUptimeStart'];
        $project->uptime_max = $data['averageUptimeEnd'];
        $project->week = $data['week'];
        $project->online_interview = $data['onlineInterview'];
        $project->remote_work = $data['remoteWork'];
        $project->comment = $data['comment'];
        $project->avatar = $data['icon'] ?? 0;
        $project->client = $data['fullName'] ?? 0;
        if (isset($data['imagePath'])){
            $project->image = $data['imagePath'];
        }
        return $project;
    }

    public function update(Request $request) {
        $project = Project::find($request->id);
        if($request->file()) {
            $imageFile = $request->file('image');
            $fileName = $imageFile->hashName();
            $imagePath = $imageFile->storeAs('project', $fileName, 'public_uploads');
            $request->merge([
                'imagePath' => $imagePath,
            ]);
        }
        $this->validator($request->all())->validate();
        $project = $this->updateProject($project, $request->all());
        $project->save();

        ProjectContract::where('project_id', $project->id)->delete();
        foreach($request->contractType as $value => $status) {
            $project_contract = new ProjectContract;
            $project_contract->project_id = $project->id;
            $project_contract->contract_id = $value;
            $project_contract->save();
        }
        return back()->with('step', 3);
    }

    public function delete(Request $request) {
        $user_id = Auth::user()->id;
        $project = Project::where([['user_id', $user_id], ['id', $request->id]])->firstOrFail();
        if (!$project) {
            abort(404);
        }
        $project->deleted = 1;
        $project->save();

        return view("project.deleted");
    }

    public function status(Request $request) {
        $user_id = Auth::user()->id;
        $project = Project::where([['user_id', $user_id], ['id', $request->id]])->firstOrFail();
        $project->status = $request->status == 'true' ? 1 : 0;
        $project->save();
    }

    protected function getChildrenAddresses($parentId) {
        $addresses = Address::where('parent_id', $parentId)->get();
        if (!$addresses) {
            return [];
        }
        foreach ($addresses as $address) {
            $address['children'] = $this->getChildrenAddresses($address->id);
        }
        return $addresses;
    }

    public function addressesTree(Request $request) {
        return response()->json([
            'success' => true,
            'data' => $this->getChildrenAddresses(0)
        ]);
    }

    public function list(Request $request){
        $search = $request->all();
        $search['for'] = $search['for'] ?? config("constants.tab_for.agent");
        $search['jobType'] = $search['jobType'] ?? [];
        $search['contractType'] = $search['contractType'] ?? [];
        $search['week'] = $search['week'] ?? [];
        $search['industries'] = $search['industries'] ?? [];
        $search['addresses'] = $search['addresses'] ?? [];
        $search['s'] = $search['s'] ?? null;
        $search['minPrice'] = $search['minPrice'] ?? null;

        $jobTypes = JobType::all();
        $industries = Industry::all();
        $weeks = Week::all();
        $contractTypes = ContractType::all();

        $projects = [];
        $profiles = [];
        $matchThese = [];

        if ($search['for'] == config("constants.tab_for.agent")) {
            $matchThese[] = ['user_type', config("constants.user_type.agent")];
        } elseif ($search['for'] == config("constants.tab_for.company")) {
            $matchThese[] = ['user_type', config("constants.user_type.company")];
        }
        $projects = Project::where($matchThese)->where('status', 1);
        if ($search['jobType']) {
            $projects = $projects->whereIn('job_type', $search['jobType']);
        }
        if ($search['contractType']) {
            $projects = $projects->whereIn('contract_type', $search['contractType']);
        }
        if ($search['week']) {
            $projects = $projects->whereIn('week', $search['week']);
        }
        if ($search['industries']) {
            $projects = $projects->whereIn('industry', $search['industries']);
        }
        if ($search['addresses']) {
            $projects = $projects->whereIn('work_location', $search['addresses']);
        }
        if ($search['minPrice']) {
            $projects = $projects->where(function($query) use ($search) {
                $query->where('price_min', '>=', $search['minPrice']);
            });
        }
        if ($search['s']) {
            $projects = $projects->where('name', 'LIKE', '%'.$search['s'].'%');
        }

        $cnt = $projects->count();
        $projects = $projects->paginate(7);

        $addresses = $this->getChildrenAddresses(0);
        return view("project.list.index",
            compact(
                'projects',
                'search',
                'jobTypes',
                'industries',
                'weeks',
                'contractTypes',
                'addresses',
                'profiles',
                'cnt'
            ));
    }

    public function detail(Request $request, $id) {
        $project = Project::findOrFail($id);
        
        if($project->user_type == config('constants.user_type.company')) {
            return view('project.detail.company', compact('project'));
        }
        else if($project->user_type == config('constants.user_type.agent')) {
            return view('project.detail.agent', compact('project'));
        }
    }
}
