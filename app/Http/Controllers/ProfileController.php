<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\ContractType;
use App\Models\Industry;
use App\Models\JobType;
use App\Models\Project;
use App\Models\Week;
use App\Models\profile\Profile;
use App\Models\profile\ProfileEducation;
use App\Models\profile\ProfileEmployee;
use App\Models\profile\ProfileExperience;
use App\Models\profile\ProfileJob;
use App\Models\profile\ProfileContract;
use App\Models\profile\ProfilePortfolio;
use App\Models\profile\ProfileQualification;
use App\Models\profile\ProfileWriting;
use App\Models\profile\ProfileSkill;
use App\Http\Controllers\Controller;
use App\Models\Dress;
use App\Models\Follow;
use App\Models\History;
use App\Models\Invite;
use App\Models\RemoteWork;
use App\Models\Review;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class ProfileController extends Controller
{
    public function setting(Request $request) {
        $step = $request->query('step', 2);
        $user_id = Auth::user()->id;

        $profile = Profile::where('user_id', $user_id)->first();
        if(!$profile) $step = 1;

        $jobTypes = JobType::all();
        $weeks = Week::all();
        $contractTypes = ContractType::all();
        $remote_works = RemoteWork::all();
        $dresses = Dress::all();
        if(isAgent()) $review = $profile->getReview($user_id);

        if(isAgent())
            return view("profile.agent", compact('profile', 'step', 'jobTypes', 'weeks', 'contractTypes', 'remote_works', 'dresses', 'review'));
        elseif(isEngineer())
            return view("profile.engineer", compact('profile', 'step', 'jobTypes', 'weeks', 'contractTypes', 'remote_works', 'dresses'));
    }

    public function score(Request $request) {
        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->firstOrFail();
        $review = $profile->getReview($user_id);
        $projects = Review::where('type', config('constants.review.projects'))->orderBy('id', 'desc')->get();
        $projects_view = Review::where('type', config('constants.review.projects_view'))->orderBy('id', 'desc')->get();
        $projects_end = Review::where('type', config('constants.review.projects_end'))->orderBy('id', 'desc')->get();
        $follow_cnt = Review::where('type', config('constants.review.follow_cnt'))->orderBy('id', 'desc')->get();
        $followed_cnt = Review::where('type', config('constants.review.followed_cnt'))->orderBy('id', 'desc')->get();
        $invites = Review::where('type', config('constants.review.invites'))->orderBy('id', 'desc')->get();
        return view('profile.score', compact('review', 'projects', 'projects_view', 'projects_end', 'follow_cnt', 'followed_cnt', 'invites'));
    }

    public function update(Request $request) {
        $user_id = Auth::user()->id;
        
        Profile::where('user_id', $user_id)->delete();
        $profile = new Profile();        
        $profile->user_id = $user_id;
        $profile->week = $request->availableDaysWeek;
        $profile->icon = $request->icon ? 1 : 0;
        $profile->full_name = $request->fullName ? 1 : 0;
        $profile->phone = $request->phone ? 1 : 0;
        $profile->open_job = $request->openJob ? 1 : 0;
        $profile->salary = comma_to_number($request->salary);
        $profile->location = $request->work_location;
        $profile->remote_work_id = $request->remote;
        $profile->join_date = $request->join_date;
        $profile->dress_id = $request->dress;
        $profile->other = $request->other;
        $profile->save();

        ProfileContract::where('user_id', $user_id)->delete();
        if(isset($request->contractType)) {
            foreach($request->contractType as $value => $status) {
                $profile_contract = new ProfileContract();
                $profile_contract->user_id = $user_id;
                $profile_contract->contract_id = $value;
                $profile_contract->save();
            }
        }

        ProfileEducation::where('user_id', $user_id)->delete();
        if(isset($request->schoolName)) {
            foreach($request->schoolName as $i => $item) {
                $education = new ProfileEducation();
                $education->user_id = $user_id;
                $education->school_name = $request->schoolName[$i]; 
                $education->subject_name = $request->departmentSubjectName[$i];
                $education->start_date = $request->educationStartDate[$i];
                $education->end_date = $request->educationEndDate[$i];
                $education->save();
            }   
        }     

        ProfileEmployee::where('user_id', $user_id)->delete();
        if(isset($request->employmentName)) {
            foreach($request->employmentName as $i => $item) {
                $employee = new ProfileEmployee();
                $employee->user_id = $user_id;
                $employee->employee_name = $request->employmentName[$i];
                $employee->employee_date = $request->employmentDate[$i];
                $employee->save();
            }
        }

        ProfileExperience::where('user_id', $user_id)->delete();
        if(isset($request->experienceTitle)) {
            foreach($request->experienceTitle as $i => $item) {
                $experience = new ProfileExperience();
                $experience->user_id = $user_id;
                $experience->title = $request->experienceTitle[$i];
                $experience->start_date = $request->experienceStartDate[$i];
                $experience->end_date = $request->experienceEndDate[$i];
                $experience->content = $request->experienceComment[$i];
                $experience->save();
            }
        }

        ProfileJob::where('user_id', $user_id)->delete();
        if(isset($request->professionalOccupation)) {
            foreach($request->professionalOccupation as $item) {
                $job = new ProfileJob();
                $job->user_id = $user_id;
                $job->job_id = $item;
                $job->save();
            }
        }

        ProfilePortfolio::where('user_id', $user_id)->delete();
        if(isset($request->portfolioName)) {
            foreach($request->portfolioName as $i => $item) {
                $portfolio = new ProfilePortfolio();
                $portfolio->user_id = $user_id;
                $portfolio->name = $request->portfolioName[$i];
                $portfolio->link = $request->portfolioLink[$i];
                $portfolio->date = $request->portfolioDate[$i];
                if(isset($request->file('image')[$i])) {
                    $imageFile = $request->file('image')[$i];
                    $fileName = $imageFile->hashName();
                    $imagePath = $imageFile->storeAs('portfolio', $fileName, 'public_uploads');
                    $portfolio->image = $imagePath;
                }
                else $portfolio->image = $request->portfolioImageUrl[$i];
                $portfolio->save();
            }
        }

        ProfileQualification::where('user_id', $user_id)->delete();
        if(isset($request->qualificationName)) {
            foreach($request->qualificationName as $i => $item) {
                $qualification = new ProfileQualification();
                $qualification->user_id = $user_id;
                $qualification->name = $request->qualificationName[$i];
                $qualification->date = $request->qualificationDate[$i];
                $qualification->save();
            }
        }

        ProfileWriting::where('user_id', $user_id)->delete();
        if(isset($request->writingName)) {
            foreach($request->writingName as $i => $item) {
                $writing = new ProfileWriting();
                $writing->user_id = $user_id;
                $writing->name = $request->writingName[$i];
                $writing->date = $request->writingDate[$i];
                $writing->save();
            }
        }

        ProfileSkill::where('user_id', $user_id)->delete();
        if(isset($request->skill_os)) {
            foreach($request->skill_os as $i => $item) {
                $skill = new ProfileSkill();
                $skill->user_id = $user_id;
                $skill->name = $request->skill_os[$i];
                $skill->year = $request->skill_os_year[$i];
                $skill->type = 'os';
                $skill->save();
            }
        }
        if(isset($request->skill_pro)) {
            foreach($request->skill_pro as $i => $item) {
                $skill = new ProfileSkill();
                $skill->user_id = $user_id;
                $skill->name = $request->skill_pro[$i];
                $skill->year = $request->skill_pro_year[$i];
                $skill->type = 'pro';
                $skill->save();
            }
        }
        if(isset($request->skill_db)) {
            foreach($request->skill_db as $i => $item) {
                $skill = new ProfileSkill();
                $skill->user_id = $user_id;
                $skill->name = $request->skill_db[$i];
                $skill->year = $request->skill_db_year[$i];
                $skill->type = 'db';
                $skill->save();
            }
        }
        if(isset($request->skill_infra)) {
            foreach($request->skill_infra as $i => $item) {
                $skill = new ProfileSkill();
                $skill->user_id = $user_id;
                $skill->name = $request->skill_infra[$i];
                $skill->year = $request->skill_infra_year[$i];
                $skill->type = 'infra';
                $skill->save();
            }
        }
        if(isset($request->skill_frame)) {
            foreach($request->skill_frame as $i => $item) {
                $skill = new ProfileSkill();
                $skill->user_id = $user_id;
                $skill->name = $request->skill_frame[$i];
                $skill->year = $request->skill_frame_year[$i];
                $skill->type = 'frame';
                $skill->save();
            }
        }
        if(isset($request->skill_tool)) {
            foreach($request->skill_tool as $i => $item) {
                $skill = new ProfileSkill();
                $skill->user_id = $user_id;
                $skill->name = $request->skill_tool[$i];
                $skill->year = $request->skill_tool_year[$i];
                $skill->type = 'tool';
                $skill->save();
            }
        }
        if(isset($request->skill_other_category)) {
            foreach($request->skill_other_category as $i => $category) {
                $skill = new ProfileSkill();
                $skill->user_id = $user_id;
                $skill->name = $request->skill_other[$i];
                $skill->year = $request->skill_other_year[$i];
                $skill->type = $category;
                $skill->save();
            }
        }

        History::create(['user_id' => $user_id, 'type_id' => 10, 'data_id' => $profile->id]);

        if(isAgent())
            return redirect()->route('agent.profile.setting', ['step' => 3]);
        else if(isEngineer())
            return redirect()->route('engineer.profile.setting', ['step' => 3]);
    }
}
