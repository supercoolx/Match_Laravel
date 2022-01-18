<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        $user = User::find($request->id);
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
                flash('メールはすでに存在します。');
                return back()->withInput();
            }
        }

        $this->validator($request->all())->validate();
        $user = $this->create($user, $request->all());

        if($user->email != null){
            $user->save();
            flash('登録完了しました。')->success();
        }

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
}
