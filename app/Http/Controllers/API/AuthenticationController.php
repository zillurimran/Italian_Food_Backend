<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fcm;
use App\Models\ThemeSetting;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);


        if (!Auth::attempt($attr)) {
            return response()->json(['error' => 'Wrong credentials'], 401);
        }


        return response()->json([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);

    }


    public function fcmRetriever(Request $request)
    {
         
        Fcm::create([
            'user_id' => Auth::id(),
            'fcmid'   => $request->fcmid,
            'token'   => request()->user()->currentAccessToken()->token,
        ]);

         return response()->json(['status' => 'id retrieved']);
    }

    
    public function logout()
    {
        // $user = User::find(Auth::id()); 

        // $user->fcmid = null;  
        // $user->save();

        $fcm = Fcm::where('token', request()->user()->currentAccessToken()->token)->first();
        if($fcm){
            $fcm->delete();
        }
        

        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }

    public function register(Request $request){
        if(!$request->email){
            return response()->json(['status' => 'Email required'], 401);
        }
        if(!$request->name){
            return response()->json(['status' => 'Name required'], 401);
        }
        if(User::where('email', $request->email)->doesntExist()){
           $new_user = User::create([
                'name' => $request->name,
                'email' =>$request->email,
                'password' => bcrypt('dummy@123'),
                'fcmid'=> $request->fcmid ?? null,
                'uid'=> $request->uid ?? null, 
                'role' => 'user',     
            ]);

            UserProfile::create([
                'user_id' => $new_user->id,
                'phone' => '88888888',
            ]);

            ThemeSetting::create([
                'user_id' => $new_user->id, 
                'theme'   => 'light-layout', 
                'nav'     => 'expanded', 
            ]);

            $attr = [
                'email'=> $new_user->email,
                'password'=> 'dummy@123',
            ];

            if (Auth::attempt($attr)) {
                return response()->json([
                    'token'   => auth()->user()->createToken('API Token')->plainTextToken, 
                    'status'  => $new_user->role
                ]);
            }
        }
        else 
        {
            $user = User::where('email', $request->email)->first();
            if($user->role == 'admin')
            {
                $attr = [
                    'email'=> $request->email,
                    'password'=> $request->password,
                ];
    
                if (Auth::attempt($attr)) {
                    return response()->json([
                        'token'    => auth()->user()->createToken('API Token')->plainTextToken, 
                        'status'   => $user->role,
                    ]);
                }
                else 
                {
                    return response()->json(['status' => "Wrong Credentials"]);
                }
            }
            else 
            {

                $attr = [
                    'email'=> $request->email,
                    'password'=> 'dummy@123',
                ];

                $getRole = User::where('email', $request->email)->first();
    
                if (Auth::attempt($attr)) {
                    return response()->json([
                        'token' => auth()->user()->createToken('API Token')->plainTextToken, 
                        'user'  => $getRole->role,
                    ]);
                }
            }

        }

    }
}
