<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Models\ContractType;
use App\Models\Industry;
use App\Models\JobType;
use App\Models\Project;
use App\Models\Week;
use App\Models\Channel;
use App\Models\Message;
use App\Models\profile\Profile;
use App\Models\profile\ProfileEducation;
use App\Models\profile\ProfileEmployee;
use App\Models\profile\ProfileExperience;
use App\Models\profile\ProfileJob;
use App\Models\profile\ProfilePortfolio;
use App\Models\profile\ProfileQualification;
use App\Models\profile\ProfileWriting;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class EngineerController extends Controller
{
    public function register(Request $request) {
        if(!session('step') && Auth::check()) return redirect()->route('home');
        return view("auth.engineer.register");
    }

    public function setting(Request $request) {
        $step = $request->query('step', 1);
        $engineer = Auth::user();
        return view("setting.engineer", compact('engineer', 'step'));
    }

    public function dashboard(Request $request) {
        $engineer = Auth::user()->id;
        $channel_ids = Message::where('from', $engineer)->pluck('channel_id')->toArray();
        $project_ids = Channel::whereIn('id', $channel_ids)->pluck('project_id')->toArray();
        $projects = Project::whereIn('id', $project_ids)->with('user', 'jobType', 'industries', 'weeks', 'contractType');
        $tabs_for = $request->for ?? 'agent';
        $cnt = $projects->count();
        $projects = $projects->paginate(7);
        return view("dashboard.engineer", compact('projects', 'tabs_for', 'cnt'));
    }

    public function profile_setting(Request $request) {
        $step = $request->query('step', 1);
        $engineer = Auth::user();
        $profile        = Profile::where('user_id', $engineer->id)->with('weeks', 'contractType')->first();
        if($profile) {
            $educations     = ProfileEducation::where('user_id', $engineer->id)->get();
            $employees      = ProfileEmployee::where('user_id', $engineer->id)->get();
            $experiences    = ProfileExperience::where('user_id', $engineer->id)->get();
            $jobs           = ProfileJob::where('user_id', $engineer->id)->with('type')->get();
            $portfolios     = ProfilePortfolio::where('user_id', $engineer->id)->get();
            $qualifications = ProfileQualification::where('user_id', $engineer->id)->get();
            $writings       = ProfileWriting::where('user_id', $engineer->id)->get();
        }
        else {
            $step = 1;

            $profile          = new Profile();
            $educations[]     = new ProfileEducation();
            $employees[]      = new ProfileEmployee();
            $experiences[]    = new ProfileExperience();
            $jobs[]           = new ProfileJob();
            $portfolios[]     = new ProfilePortfolio();
            $qualifications[] = new ProfileQualification();
            $writings[]       = new ProfileWriting();
        }
        $jobTypes = JobType::all();
        $weeks = Week::all();
        $contractTypes = ContractType::all();
        return view("profile.engineer", compact('engineer', 'profile', 'step', 'profile', 'educations', 'employees', 'experiences', 'jobs', 'portfolios', 'qualifications', 'writings', 'weeks', 'contractTypes', 'jobTypes'));
    }

    public function profile_update(Request $request) {
        $user_id = Auth::user()->id;
        
        Profile::where('user_id', $user_id)->delete();
        $profile = new Profile();        
        $profile->user_id = $user_id;
        $profile->week = $request->availableDaysWeek;
        $profile->contract = $request->desiredContractForm;
        $profile->icon = $request->icon ? 1 : 0;
        $profile->full_name = $request->fullName ? 1 : 0;
        $profile->save();

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
            foreach($request->professionalOccupation as $i => $item) {
                $job = new ProfileJob();
                $job->user_id = $user_id;
                $job->job_id = $request->professionalOccupation[$i];
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
                $writing->link = $request->writingLink[$i];
                $writing->date = $request->writingDate[$i];
                $writing->save();
            }
        }
        
        return redirect()->route('engineer.profile.setting', ['step' => 3]);
    }
}
