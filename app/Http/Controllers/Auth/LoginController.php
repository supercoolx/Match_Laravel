<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use CoreComponentRepository;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    /*protected $redirectTo = '/';*/

    public function login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => ['1', '2', '3']])) {
            History::create(['user_id' => Auth::user()->id, 'type_id' => 2]);   
            return $this->sendLoginResponse($request);
        // OR this one
        // return $this->authenticated($request, auth()->user());
        }
        else {
            return $this->sendFailedLoginResponse($request, 'auth.failed_status');
        }
    }

    public function admin_login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => '0'])) {
            History::create(['user_id' => Auth::user()->id, 'type_id' => 2]);
            return $this->sendLoginResponse($request);
        // OR this one
        // return $this->authenticated($request, auth()->user());
        }
        else {
            return $this->sendFailedLoginResponse($request, 'auth.failed_status');
        }
    }


    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        if(filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)){
            return $request->only($this->username(), 'password');
        }
        return null;
    }

    /**
     * Check user's role and redirect user based on their role
     * @return
     */
    public function authenticated()
    {
        if(session('link') != null){
            $link = session('link');
            session()->forget('link');
            return redirect($link);
        }
        if(auth()->user()->user_type == config("constants.user_type.company")) {
            return redirect()->route('company.dashboard');
        } else if(auth()->user()->user_type == config("constants.user_type.agent")) {
            return redirect()->route('agent.dashboard');
        } else if(auth()->user()->user_type == config("constants.user_type.engineer")) {
            return redirect()->route('engineer.dashboard');
        } else if(auth()->user()->user_type == config("constants.user_type.admin")) {
            return redirect()->route('admin.members', ['tab_for' => 'engineer']);
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        flash("無効なメールアドレスまたはパスワード")->error();
        return back();
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $user_id = Auth::user()->id;
        if (isAdmin())
            $redirect_route = 'admin.login';
        else 
            $redirect_route = 'login';

        $this->guard()->logout();

        $request->session()->invalidate();

        History::create(['user_id' => $user_id, 'type_id' => 3]);

        return $this->loggedOut($request) ?: redirect()->route($redirect_route);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
