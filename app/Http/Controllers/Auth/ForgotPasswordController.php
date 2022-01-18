<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\User;
use App\Mail\SecondEmailVerifyMailManager;
use Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */

    public function sendResetLinkEmail(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $request->email)->first();
            if ($user != null) {
                $token = rand(100000, 999999);
                $token = md5(strval($token));
                $user->verification_code = $token;
                $user->save();

                $array['view'] = 'emails.verification';
                $array['from'] = env('MAIL_FROM_ADDRESS');
                $array['subject'] = 'Password Reset';
                $array['content'] = 'Verification Code is '.$user->verification_code;

                // Mail::to($user->email)->queue(new SecondEmailVerifyMailManager($array));

                return back()->withInput(array('success' => 'Please click link in your email.'));
            }
            else {
                flash('No account exists with this email')->error();
                return back();
            }
        }
    }
}
