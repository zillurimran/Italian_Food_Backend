<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordMail;
use App\Mail\PasswordChangedMail;
use App\Models\Banner;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\Feature;
use App\Models\SingleFeature;
use App\Models\Address;
use App\Models\EmailAddress;
use App\Models\PackageItems;
use App\Models\PackageType;
use App\Models\PhoneNumber;
use App\Models\User;
use App\Models\VerifyCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index(){
        return view('frontend.pages.homepage', [
            'banners'           => Banner::all(),
            'features'          => Feature::first(),
            'featureSpecs'      => SingleFeature::all(),
            'address'           => Address::first(),
            'phones'            => PhoneNumber::all(),
            'emails'            => EmailAddress::all(),
            'packagePricings'   => PackageType::all(),
            'packageItems'      => PackageItems::all(),

        ]);
    }

    public function forgotPassword(){
        return view('frontend.pages.forgot-password-page');
    }

    public function sendCode(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $name = $user->name;

        if(VerifyCode::where('user_id', $user->id)->exists()){
            VerifyCode::where('user_id', $user->id)->delete();
        }
        $code = VerifyCode::create([
            'user_id' => $user->id,
            'verify_code' => rand(1000, 9999) . $user->id,
        ]);
       
        Mail::to($user->email)->send(new ForgetPasswordMail($name, $code->verify_code));
        session()->put('user_id', $user->id);

        return redirect()->route('verify.code')->with('success', 'Code sent to your email address. Please check your email address.');
    }


    public function verifyCode(){

        if(session('user_id'))
        {
            $user = User::find(session()->get('user_id'));
            return view('frontend.pages.verify-code-page', compact('user'));
        }
        else 
        {
            return view('frontend.pages.verify-code-page');
        }
    }
    
    public function validateCode(Request $request)
    {
        $code = $request->code; 
        $user_id = $request->user_id; 
        if(VerifyCode::where('user_id', $user_id)->where('verify_code', $code)->exists())
        {
            $db_code = VerifyCode::where('user_id', $user_id)->where('verify_code', $code)->first();
            session()->put('code_id', $db_code->id);
            return redirect()->route('change.password') ;
        }

    }

    public function changePassword(){
        if(session('user_id') && session('code_id'))
        {
            return view('frontend.pages.change-password-page', [
                'user_id' => session('user_id'),
                'code_id' => session('code_id'),
            ]);
        }
        else 
        {
            return redirect()->route('forgot.password')->with('error', 'Session Expired !! Please re-enter your email address first.');
            
        }
    }

    public function updatePassword(Request $request)
    {
        $user_id = $request->user_id;
        $code_id = $request->code_id;
        $password = $request->password;
        $confirm_password = $request->password_confirm;


        if($password == $confirm_password)
        {
            $user = User::find($user_id);
            $user->password = bcrypt($password);
            $user->save();

            VerifyCode::find($code_id)->delete();
            session()->forget('user_id');
            session()->forget('code_id');

            Mail::to($user->email)->send(new PasswordChangedMail($user->name));

            return redirect()->route('frontend.index')->with('password', 'Password changed successfully. Please login with your new password.');
        }
        else 
        {
            return redirect()->route('change.password')->with('error', 'Password and Confirm Password does not match.');
        }
    }

    public function userEmailCheck(Request $request){
        if(User::where('email', $request->email)->exists()){
            return response('found');
        }else{
            return response('not found');
        }
    }


    // public function pricing(){
    //     return view('frontend.pages.pricingpage');
    // }

    // public function blog(){
    //     return view('frontend.pages.blogpage', [
    //         'categories' => BlogCategory::all(),
    //         'tags' => BlogTag::all(),
    //     ]);
    // }

    // public function blogDetails(){
    //     return view('frontend.pages.blog-details-page');
    // }

    // public function contact(){
    //     return view('frontend.pages.contactpage');
    // }

}
