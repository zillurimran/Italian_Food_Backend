<?php

namespace App\Http\Controllers;

use App\Models\StripeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class StripeSettingController extends Controller
{
    public function index(){
        return view('admin.stripe.index',['key'=>StripeSetting::first()]);
    }

    public function updateKey(Request $request, $id){
        $key = StripeSetting::find($id);
        $request->validate([
            'stripe_key' => 'required',
            'secret_key'=> 'required'
        ],
    [
        'stripe_key.required' => 'Stripe key isrequired',
            'secret_key.required'=> 'Secret Key required'
    ]);
        $key->stripe_key = $request->stripe_key;
        $key->secret_key = $request->secret_key;
        $key->save();
        return back()->withSuccess('Key has been updated');
    }
}
