<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use CoreComponentRepository;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(Request $request) {
        return redirect()->route('admin.members', ['tab_for' => 'engineer']);
    }

    public function login(Request $request) {
        return view("admin.login");
    }

    public function password(Request $request) {
        
        if (Hash::check($request->current_password, Auth::user()->password) && $request->new_password === $request->confirm_password) {
            User::find(Auth::user()->id)->update(['password'=> Hash::make($request->new_password)]);
            return redirect()->route('admin.dashboard');
        }
        else return redirect()->back()->withErrors(['正しく入力してください。']);
    }

    public function projects(Request $request) {
        return view("admin.projects");
    }

    public function members(Request $request, $tab_for) {
        $search = $request->query('search', '');
        $members = [];
        if ($tab_for == 'engineer') {
            $members = User::where('user_type', config("constants.user_type.engineer"));
        } elseif ($tab_for == 'agent') {
            $members = User::where('user_type', config("constants.user_type.agent"));
        } elseif ($tab_for == 'company') {
            $members = User::where('user_type', config("constants.user_type.company"));
        }
        if($search) $members = $members->where('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%");

        $cnt = $members->count();
        $members = $members->paginate(10);
        
        return view("admin.members", compact('members', 'tab_for', 'cnt'));
    }

    public function user(Request $request, $usertype, $id) {
        $user = User::find($id);
        $tab_for = $usertype;
        return view("admin.user", compact('user', 'tab_for'));
    }

    public function members_delete(Request $request) {
        User::whereIn('id', $request->user_id)->update(['deleted' => 1]);
        return view("admin.deleted");
    }
}
