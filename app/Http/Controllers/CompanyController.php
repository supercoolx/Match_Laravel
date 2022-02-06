<?php

namespace App\Http\Controllers;

use App\Models\ContractType;
use App\Models\Industry;
use App\Models\JobType;
use App\Models\Project;
use App\Models\Week;
use Auth;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function register(Request $request) {
        if(!session('step') && Auth::check()) return redirect()->route('home');
        if($request->has('token') && $request->has('email'))
            return view("auth.register.company", ['invite_token' => $request->token, 'invite_email' => $request->email]);
        else return view("auth.register.company");
    }

    public function dashboard(Request $request) {
        $user_id = Auth::user()->id;
        $projects = Project::where('user_id', $user_id)->paginate(5);
        return view("dashboard.company", compact('projects'));
    }

    public function setting(Request $request) {
        $step = $request->query('step', 1);
        $company = Auth::user();
        return view("setting.company", compact('company', 'step'));
    }

    public function postProject(Request $request) {
        $jobTypes = JobType::all();
        $industries = Industry::all();
        $weeks = Week::all();
        $contractTypes = ContractType::all();
        $company = Auth::user();
        $addresses = AddressController::getAddresses();

        return view("project.edit.index", compact('jobTypes','industries', 'weeks', 'contractTypes', 'company', 'addresses'));
    }

    public function projectDetail(Request $request, $id) {
        $user_id = Auth::user()->id;
        $project = Project::where([['user_id', $user_id], ['id', $id]])->first();
        if (!$project) {
            abort(404);
        }
        return view("project.detail.company", compact('project'));
    }

    public function editProject(Request $request, $id) {
        $company = Auth::user();
        $project = Project::where([['user_id', $company->id], ['id', $id]])->first();
        if (!$project) {
            abort(404);
        }
        $jobTypes = JobType::all();
        $industries = Industry::all();
        $weeks = Week::all();
        $contractTypes = ContractType::all();
        $addresses = AddressController::getAddresses();
        return view("project.edit.index", compact('project', 'jobTypes', 'industries', 'weeks', 'contractTypes', 'company', 'addresses'));
    }
}
