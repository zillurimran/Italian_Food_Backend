<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Auth;

class UserProfileController extends Controller
{
    public function index(){
        
        $user_profile = User::where('id', Auth::id())->first();
        return response()->json([
            'id' => $user_profile->id,
            'name' => $user_profile->name,
            'email' => $user_profile->email,
            'phone' => $user_profile->phone,
            'push_notification' =>$user_profile->push_notification
           
        ]);
    }

    public function updateProfile(Request $request){
        
        $user_profile = User::where('id', Auth::id())->first();
        $user_profile->update([
            'name' => $request->name ?? $user_profile->name,
            'phone' => $request->phone ?? $user_profile->phone,
            'push_notification' =>$request->push_notification
        ]);
        return response()->json([
            'status' => 'User Profile updated',
            'id'     => $user_profile->id,
            'name'   => $user_profile->name,
            'phone'  => $user_profile->phone,
            'push_notification'   => $user_profile->push_notification,
        ]);
    }
}
