<?php

namespace App\Http\Controllers;

use App\Mail\InviteMailManager;
use App\Models\ContractType;
use Auth;
use App\Models\User;
use App\Models\Follow;
use App\Models\History;
use App\Models\Industry;
use App\Models\Invite;
use App\Models\JobType;
use App\Models\profile\Profile;
use App\Models\Project;
use App\Models\Review;
use App\Models\Week;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;
use Str;

class UserController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id' => 'required|numeric|max:12',
            'name' => 'required|string|max:255',
            'nameKana' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(User $user, array $data)
    {
        $user->name = $data['name'];
        $user->name_kana = $data['nameKana'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->avatar = $data['avatarPath'];

        if ($user->user_type == config("constants.user_type.company")){
            $user->website = $data['website'];
        }
        if (isset($data['password']) && $data['password'] != '') {
            $user->password = Hash::make($data['password']);
        }
        return $user;
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        if($request->file()) {
            $avatarFile = $request->file('avatar');
            $fileName = $avatarFile->hashName();
            $avatarPath = $avatarFile->storeAs('avatar', $fileName, 'public_uploads');
            $request->merge([
                'avatarPath' => $avatarPath,
            ]);
        }
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if($user->email !== $request->email && User::where('email', $request->email)->first() != null){
                flash('???????????????????????????????????????');
                return back()->withInput();
            }
        }

        $this->validator($request->all())->validate();
        $user = $this->create($user, $request->all());

        if($user->email != null){
            $user->save();
        }

        History::create(['user_id' => $user->id, 'type_id' => 26]);

        return $this->updated($request, $user);
    }

    protected function updated(Request $request, $user)
    {
        if ($user->user_type === config("constants.user_type.company")) {
            return redirect()->route('company.setting', ['step' => 3]);
        } elseif ($user->user_type === config("constants.user_type.agent")) {
            return redirect()->route('agent.setting', ['step' => 3]);
        } elseif ($user->user_type === config("constants.user_type.engineer")) {
            return redirect()->route('engineer.setting', ['step' => 3]);
        }

        return back()->with('step', 3);
    }

    public function invite(Request $request) {
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email'
            ],[
                'email.required' => '????????????????????????????????????????????????',
                'email.email' => '????????????????????????????????????????????????????????????',
                'email.unique' => '????????????????????????????????????',
            ]);

            $validator->validate();
            
            do {
                $token = Str::random(20);
            } while(Invite::firstWhere('token', $token));

            $invite = new Invite;
            $invite->user_id = Auth::user()->id;
            $invite->email = $request->email;
            $invite->token = $token;
            $invite->save();

            History::create(['user_id' => Auth::user()->id, 'type_id' => 15]);

            $array['subject'] = Auth::user()->name . '??????????????????????????????????????????????????????';
            $array['link'] = route('invite.accept', ['token' => $token]);
            $array['username'] = Auth::user()->name;
            $array['useremail'] = Auth::user()->email;
            Mail::to($request->email)->queue(new InviteMailManager($array));

            return view('invite.success');
        }
        else if($request->isMethod('get'))
            return view('invite.index');
    }

    public function invited(Request $request, $token) {
        $invite = Invite::where('token', $token)->firstOrFail();
        return view('invite.entry', compact('invite'));
    }

    protected function search_result($search) {
        $search['for'] = $search['for'] ?? config("constants.tab_for.engineer");
        $search['jobType'] = $search['jobType'] ?? [];
        $search['contractType'] = $search['contractType'] ?? [];
        $search['week'] = $search['week'] ?? [];
        $search['industries'] = $search['industries'] ?? [];
        $search['addresses'] = $search['addresses'] ?? [];
        $search['s'] = $search['s'] ?? '';
        $search['minPrice'] = $search['minPrice'] ?? null;
        $search['project'] = $search['project'] ?? null;
        $search['project_viewed'] = $search['project_viewed'] ?? null;
        $search['contract'] = $search['contract'] ?? null;
        $search['following'] = $search['following'] ?? null;
        $search['follower'] = $search['follower'] ?? null;
        $search['referral'] = $search['referral'] ?? null;

        $matchThese = [];
        if ($search['for'] == config("constants.tab_for.agent")) {
            $matchThese[] = ['user_type', config("constants.user_type.agent")];
        } elseif ($search['for'] == config("constants.tab_for.company")) {
            $matchThese[] = ['user_type', config("constants.user_type.company")];
        } elseif ($search['for'] == config("constants.tab_for.engineer")) {
            $matchThese[] = ['user_type', config("constants.user_type.engineer")];
        }

        $users = User::where($matchThese);
        
        if ($search['jobType']) {
            $users = $users->whereHas('profile.jobs', function ($query) use ($search) {
                return $query->whereIn((new JobType)->getTable().'.id', $search['jobType']);
            });
        }
        if ($search['contractType']) {
            $users = $users->whereHas('profile.contractTypes', function ($query) use ($search) {
                $query->whereIn((new ContractType)->getTable().'.id', $search['contractType']);
            });
        }
        if ($search['week']) {
            $users = $users->whereHas('profile', function ($query) use ($search) {
                $query->where((new Profile)->getTable().'.week', $search['week']);
            });
        }
        // if ($search['industries']) {
        //     $users = $users->whereIn('industry', $search['industries']);
        // }
        // if ($search['addresses']) {
        //     $users = $users->whereIn('work_location', $search['addresses']);
        // }
        if ($search['minPrice']) {
            $users = $users->whereHas('profile', function($query) use ($search) {
                $query->where((new Profile)->getTable().'.salary', '>=', $search['minPrice']);
            });
        }
        if ($search['s']) {
            $users = $users->where('name', 'LIKE', '%'.$search['s'].'%')->orWhere('name_kana', 'LIKE', '%'.$search['s'].'%');
        }

        return ['users' => $users, 'search' => $search];
    }

    public function list(Request $request)
    {
        $result = $this->search_result($request->all());
        extract($result);

        $jobTypes = JobType::all();
        $industries = Industry::all();
        $weeks = Week::all();
        $contractTypes = ContractType::all();

        $count = $users->count();
        $users = $users->get();

        return view('user.list.index', compact('search', 'users', 'jobTypes', 'industries', 'weeks', 'contractTypes', 'count'));
    }

    public function detail(Request $request, $id) {
        $user = User::findOrFail($id);
        History::create(['user_id' => Auth::check() ? Auth::user()->id : 0, 'type_id' => 14, 'data_id' => $id]);
        if($user->user_type == config('constants.user_type.engineer')) {
            $profile = Profile::where('user_id', $id)->firstOrFail();
            return view('user.detail.engineer', compact('profile'));
        }
        else if($user->user_type == config('constants.user_type.agent')) {
            $profile = Profile::where('user_id', $id)->firstOrFail();
            $projects = Project::where('user_id', $id);

            $review = $profile->getReview($user->id);
            
            return view('user.detail.agent', compact('profile', 'review'));
        }
        else if($user->user_type == config('constants.user_type.company')) {
            $projects = Project::where('user_id', $id)->get();
            return view('user.detail.company', compact('projects'));
        }
    }

    public function follow(Request $request, $id) {
        $result = array();

        if(!Auth::check()) {
            $result = array(
                'success' => false,
                'message' => '??????????????????????????????????????????????????????????????????'
            );
            return response()->json($result);
        }

        $user_id = Auth::user()->id;
        $followed_user = User::find($id);
        if(!$followed_user || $followed_user->user_type == config('constants.user_type.admin')) {
            $result = array(
                'success' => false,
                'message' => '?????????????????????????????????????????????'
            );
            return response()->json($result);
        }

        if($user_id == $id) {
            $result = array(
                'success' => false,
                'message' => '??????????????????????????????????????????????????????'
            );
            return response()->json($result);
        };

        $follow = Follow::where(['follow' => $id, 'follow_by' => $user_id]);
        if($follow->count()) {
            $result = array(
                'success' => false,
                'message' => '????????????????????????????????????????????????????????????????????????'
            );
            return response()->json($result);
        }

        $follow = new Follow();
        $follow->follow = $id;
        $follow->follow_by = $user_id;
        $follow->save();
        History::create(['user_id' => $user_id, 'type_id' => 11, 'data_id' => $id]);
        $result = array('success' => true);
        return response()->json($result);
    }

    public function unfollow(Request $request, $id) {
        $result = array();

        if(!Auth::check()) {
            $result = array(
                'success' => false,
                'message' => '??????????????????????????????????????????'
            );
            return response()->json($result);
        }

        $user_id = Auth::user()->id;
        $followed_user = User::find($id);
        if(!$followed_user || $followed_user->user_type == config('constants.user_type.admin')) {
            $result = array(
                'success' => false,
                'message' => '?????????????????????????????????????????????'
            );
            return response()->json($result);
        }

        if($user_id == $id) {
            $result = array(
                'success' => false,
                'message' => '??????????????????????????????????????????????????????'
            );
            return response()->json($result);
        };

        $follow = Follow::where(['follow' => $id, 'follow_by' => $user_id]);
        if(!$follow->count()) {
            $result = array(
                'success' => false,
                'message' => '??????????????????????????????????????????????????????'
            );
            return response()->json($result);
        }
        $follow->delete();
        History::create(['user_id' => $user_id, 'type_id' => 12, 'data_id' => $id]);
        $result = array('success' => true);
        return response()->json($result);

    }

    //display list of users who follow me.
    public function user_follow(Request $request) {
        $result = $this->search_result($request->all());
        extract($result);
        $search['follow'] = 1;

        $jobTypes = JobType::all();
        $industries = Industry::all();
        $weeks = Week::all();
        $contractTypes = ContractType::all();

        $user_ids = Follow::where('follow_by', Auth::user()->id)->pluck('follow');
        $users = $users->whereIn('id', $user_ids);

        $count = $users->count();
        $users = $users->get();
        return view('user.list.follow', compact('search', 'users', 'jobTypes', 'industries', 'weeks', 'contractTypes', 'count'));
    }

    //display list of users whom I follow
    public function user_follower(Request $request) {
        $result = $this->search_result($request->all());
        extract($result);
        $search['follow'] = 0;

        $jobTypes = JobType::all();
        $industries = Industry::all();
        $weeks = Week::all();
        $contractTypes = ContractType::all();

        $user_ids = Follow::where('follow', Auth::user()->id)->pluck('follow_by');
        $users = $users->whereIn('id', $user_ids);

        $count = $users->count();
        $users = $users->get();
        return view('user.list.follow', compact('search', 'users', 'jobTypes', 'industries', 'weeks', 'contractTypes', 'count'));
    }
}
