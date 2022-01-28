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
}
