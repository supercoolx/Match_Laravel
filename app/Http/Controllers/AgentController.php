<?php

namespace App\Http\Controllers;

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
use App\Models\profile\ProfilePortfolio;
use App\Models\profile\ProfileQualification;
use App\Models\profile\ProfileWriting;
use Auth;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function register(Request $request) {
        if(!session('step') && Auth::check()) return redirect()->route('home');
        if($request->has('token') && $request->has('email'))
            return view("auth.agent.register", ['invite_token' => $request->token, 'invite_email' => $request->email]);
        else return view("auth.agent.register");
    }

    public function dashboard(Request $request) {
        $user_id = Auth::user()->id;
        $projects = Project::where('user_id', $user_id)->paginate(5);
        return view("dashboard.agent", compact('projects'));
    }

    public function setting(Request $request) {
        $step = $request->query('step', 1);
        $agent = Auth::user();
        return view("setting.agent", compact('agent', 'step'));
    }

    public function postProject(Request $request) {
        $jobTypes = JobType::all();
        $industries = Industry::all();
        $weeks = Week::all();
        $contractTypes = ContractType::all();
        $agent = Auth::user();
        $addresses = AddressController::getAddresses();

        return view("project.edit.index", compact('jobTypes','industries', 'addresses', 'weeks', 'contractTypes', 'agent'));
    }

    public function projectDetail(Request $request, $id) {
        $user_id = Auth::user()->id;
        $project = Project::where([['user_id', $user_id], ['id', $id]])->first();
        if (!$project) {
            abort(404);
        }
        return view("project.detail.agent", compact('project'));
    }

    public function editProject(Request $request, $id) {
        $user_id = Auth::user()->id;
        $project = Project::where([['user_id', $user_id], ['id', $id]])->first();
        if (!$project) {
            abort(404);
        }

        $jobTypes = JobType::all();
        $industries = Industry::all();
        $weeks = Week::all();
        $contractTypes = ContractType::all();
        $agent = Auth::user();
        $addresses = AddressController::getAddresses();
        return view("project.edit.index", compact('project', 'jobTypes','industries', 'addresses', 'weeks', 'contractTypes', 'agent'));
    }
}
