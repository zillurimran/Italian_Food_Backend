<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index(){
        
        return view('admin.privacy_policy.index',['policy' => PrivacyPolicy::first()]);
    }

    public  function update(Request $request){
        $policy = PrivacyPolicy::first();
        $policy->update([
            'privacy_policy' => $request->privacy_policy
        ]);
        return back()->withSuccess('Policy Updated');
    }
}
