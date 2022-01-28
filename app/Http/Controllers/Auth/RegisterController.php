<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'nameKana' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if ($data['userType'] == config("constants.user_type.admin")){
            abort(404);
        }
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::create([
                'name' => $data['name'],
                'name_kana' => $data['nameKana'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'avatar' => $data['avatarPath'],
                'user_type' => $data['userType'],
                'password' => Hash::make($data['password']),
            ]);
            if ($data['userType'] == config("constants.user_type.company")){
                $user->website = $data['website'];
            }
            return $user;
        }
        return null;
    }

    public function register(Request $request)
    {
        if($request->file()) {
            $avatarFile = $request->file('avatar');
            $fileName = $avatarFile->hashName();
            $avatarPath = $avatarFile->storeAs('avatar', $fileName, 'public_uploads');
            $request->merge([
                'avatarPath' => $avatarPath,
            ]);
        }
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if(User::where('email', $request->email)->first() != null){
                flash('メールはすでに存在します。');
                return back()->withInput();
            }
        }

        $this->validator($request->all())->validate();
        $user = $this->create($request->all());

        $this->guard()->login($user);

        if($user->email != null){
            if (true) {
                $user->email_verified_at = date('Y-m-d H:m:s');
                $user->save();
            }
            else {
                event(new Registered($user));
            }
        }

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        return back()->with('step', 3);
    }
}
