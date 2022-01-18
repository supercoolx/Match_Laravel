<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        if (isCompany()) {
            return redirect()->route('company.dashboard');
        }
        elseif (isAgent()) {
            return redirect()->route('agent.dashboard');
        }
        elseif (isEngineer()){
            return redirect()->route('engineer.dashboard');
        }
        elseif (isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('login');
    }
}
