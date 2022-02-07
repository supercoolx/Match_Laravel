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
use App\Models\FavouriteProject;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class EngineerController extends Controller
{
    public function register(Request $request) {
        if(!session('step') && Auth::check()) return redirect()->route('home');
        if($request->has('token') && $request->has('email'))
            return view("auth.register.engineer", ['invite_token' => $request->token, 'invite_email' => $request->email]);
        else return view("auth.register.engineer");
    }

    public function setting(Request $request) {
        $step = $request->query('step', 1);
        $engineer = Auth::user();
        return view("setting.engineer", compact('engineer', 'step'));
    }

    public function dashboard(Request $request) {
        $isFavour = $request->has('favourite');
        $tabs_for = $request->for ?? 'agent';
        if($tabs_for == config('constants.tab_for.company'))
            $projects = Project::where('user_type', config('constants.user_type.company'));
        else
            $projects = Project::where('user_type', config('constants.user_type.agent'));
        if($isFavour) {
            $project_ids = FavouriteProject::where('user_id', Auth::user()->id)->pluck('project_id')->toArray();
            $projects = $projects->whereIn('id', $project_ids);
        }
        $cnt = $projects->count();
        $projects = $projects->paginate(7);
        return view("dashboard.engineer", compact('projects', 'tabs_for', 'isFavour', 'cnt'));
    }
}
