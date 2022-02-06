<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showResetForm(Request $request, $token) {
        $user = User::where('verification_code', $token)->firstOrFail();
        return view('auth.passwords.reset', ['token' => $token, 'email' => $user->email]);
    }

    public function reset(Request $request) {

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::where([['email', $request->email], ['verification_code', $request->token]])->firstOrFail();
        
        $user->password = Hash::make($request->password);
        $user->verification_code = "";
        $user->save();
        if($user->user_type == 'admin') return redirect()->route('admin.login');
        else return redirect()->route('login');
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
/*    protected function sendResetResponse(Request $request, $response)
    {
        if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
        {
            return redirect()->route('admin.dashboard')
                            ->with('status', trans($response));
        }

        return redirect()->route('home')
                            ->with('status', trans($response));
    }*/
}
