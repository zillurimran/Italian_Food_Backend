<?php

namespace App\Http\Controllers;

use App\Jobs\RegisteredUserJob;
use App\Mail\RegiteredUserMail;
use App\Mail\UserRegisterMail;
use App\Models\ThemeSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use Session;
use Validator;
use Mail;

class UserController extends Controller
{
    public function storeUser(Request $request){
        $request->validate([
            'name'              => 'required|string|max:255',
            'register_email'    => 'required|email|max:255|unique:users,email',
            'register_password' => 'required|string|min:8',
            'confirm_password'  => 'required|same:register_password'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->register_email;
        $user->password = bcrypt($request->register_password);
        $user->role = 'user';
        $user->save();
        ThemeSetting::create([
            'user_id'    => $user->id,
            'created_at' => Carbon::now(),
        ]);
        Auth::attempt(['email' => $request->register_email, 'password' => $request->register_password]);


        $this->dispatch(new RegisteredUserJob($request->name, $request->register_email));

        return redirect()->route('dashboard');
    }

    public function checkUser(Request $request){
        // $userInfo = User::where('email', $request->email)->first();
        // // dd($userInfo);

        // $user = User::where('email', $request->email)->first();
        // // Auth::attempt();
        // Auth::login($user);
        // // Fortify::authenticateUsing(function (Request $request) {
        // //     DD($request->all());
        // //     if ($user &&
        // //         Hash::check($request->password, $user->password)) {
        // //         return $user;
        // //     }
        // // });
        // dd('success');
        // // if($userInfo){
        // //     $existingPassword = $userInfo->password;
        // //     if(password_verify($request->password, $existingPassword)){
        // //             Session::put('userId', $userInfo->id);
        // //             Session::put('userName', $userInfo->name);
        // //             return back();
        // //     }else{
        // //         return back()->withSuccess('message','Incorrect Password');
        // //     }
        // // }else{
        // //     return back()->withSuccess('message','Invalid username');
        // // }
    }

}
