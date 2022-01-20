<?php

namespace App\Http\Controllers;

use App\Models\ContractType;
use App\Models\Industry;
use App\Models\JobType;
use App\Models\Project;
use App\Models\Week;
use Auth;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function register(Request $request) {
        return view("auth.agent.register");
    }

    public function dashboard(Request $request) {
        $user_id = Auth::user()->id;
        $projects = Project::where('user_id', $user_id)->with('user', 'jobType', 'industries', 'weeks', 'contractType')->paginate(5);
        return view("agent.dashboard", compact('projects'));
    }

    public function setting(Request $request) {
        $step = $request->query('step', 1);
        $agent = Auth::user();
        return view("agent.setting", compact('agent', 'step'));
    }

    public function postProject(Request $request) {
        $jobTypes = JobType::all();
        $industries = Industry::all();
        $weeks = Week::all();
        $contractTypes = ContractType::all();
        $agent = Auth::user();
        $addresses = AddressController::getAddresses();

        return view("project.edit", compact('jobTypes','industries', 'addresses', 'weeks', 'contractTypes', 'agent'));
    }

    public function projectDetail(Request $request, $id) {
        $user_id = Auth::user()->id;
        $project = Project::where([['user_id', $user_id], ['id', $id]])->with('user', 'jobType', 'industries', 'weeks', 'contractType')->first();
        if (!$project) {
            abort(404);
        }
        return view("project.detail", compact('project'));
    }

    public function editProject(Request $request, $id) {
        $user_id = Auth::user()->id;
        $project = Project::where([['user_id', $user_id], ['id', $id]])->with('user', 'jobType', 'industries', 'weeks', 'contractType')->first();
        if (!$project) {
            abort(404);
        }

        $jobTypes = JobType::all();
        $industries = Industry::all();
        $weeks = Week::all();
        $contractTypes = ContractType::all();
        $agent = Auth::user();
        $addresses = AddressController::getAddresses();
        return view("project.edit", compact('project', 'jobTypes','industries', 'addresses', 'weeks', 'contractTypes', 'agent'));
    }
}
