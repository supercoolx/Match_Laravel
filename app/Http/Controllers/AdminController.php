<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Project;
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
        $members = $members->get();
        
        return view("admin.members", compact('members', 'tab_for', 'cnt'));
    }

    public function user(Request $request, $usertype, $id) {
        $user = User::find($id);
        $tab_for = $usertype;
        return view("admin.user", compact('user', 'tab_for'));
    }

    public function exportCSV(Request $request) {
        $fileName = 'users.csv';
        $users = User::where('user_type', '<>', config('constants.user_type.admin'))->get();
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        $columns = array('ユーザー名', 'ユーザーのメール', '公開案件数', '契約成立数', '友達紹介数');
        $callback = function () use($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($users as $user) {
                $projects = Project::where('user_id', $user->id);
                $row['username'] = $user->name;
                $row['useremail'] = $user->email;
                $row['projects'] = $projects->count();
                $row['projects_end'] = $projects->where('status', 0)->count();
                $row['follow_cnt'] = $user->follow->count();
                fputcsv($file, array($row['username'], $row['useremail'], $row['projects'], $row['projects_end'], $row['follow_cnt']));
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function members_delete(Request $request) {
        User::whereIn('id', $request->user_id)->update(['deleted' => 1]);
        History::create(['user_id' => Auth::user()->id, 'type_id' => 23, 'data_id' => $request->user_id]);
        return view("admin.deleted");
    }
}
