<?php

namespace App\Http\Controllers;

use App\Mail\BillingInfoMail;
use App\Mail\UserRegisterMail;
use App\Mail\RegiteredUserMail;
Use App\Mail\PaymentMail;
use App\Models\PackageType;
use App\Models\StripeSetting;
use App\Models\ThemeSetting;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Stripe;
use Illuminate\Support\Facades\Mail;

class ProductOrderController extends Controller
{
    public function orderStore(Request $request){
  
        $package = PackageType::find($request->package_id);
        $stripe_setting = StripeSetting::first();
        if($package){
            try {
                $amount = $package->package_price;
    
                \Stripe\Stripe::setApiKey($stripe_setting->secret_key);
    
                $intent = \Stripe\PaymentIntent::create([
                        'amount' => ($amount)*100,
                        'currency' => 'EUR',
                        'metadata' => ['integration_check'=>'accept_a_payment']
                ]);
    
                $data = array( 
                    'amount'=> $amount,
                    'client_secret'=> $intent->client_secret,
                    'stripe_setting' => $stripe_setting
                );
                  
                return view('frontend.pages.stripe-payment', ['data'=>$data]); 
            }
            catch(Exception $e){
                return redirect('/');
            }
        }else{
            return redirect('/');
        } 
    }

    public function paymentSuccess(Request $request){
         $user = User::where('email', $request->email)->first();
         $package = PackageType::where('package_price', $request->amount)->first();

        if(!$user){
           $user= User::create([
                'name'          => $request->name,
                'phone'         => $request->phone,
                'email'         => $request->email,
                'password'      => bcrypt($request->password),
                'address'       => $request->address,
                'package_id'    => $package->id ?? '',
                'amount'        => $request->amount,
                'total_sms'     => $package->sms_quantity ?? 0, 
                'role'          => 'user',
            ]);
            ThemeSetting::create([
                'user_id' => $user->id
            ]);

            Mail::to($request->email)->send(new UserRegisterMail($request->name, $request->email));
            Mail::to(generalsettings()->email)->send(new RegiteredUserMail($request->name, $request->email));

        }else{
            $user->update([
                'total_sms' => $user->total_sms + $package->sms_quantity ?? 0, 
                'amount' => $user->amount + $request->amount, 
            ]);
        }
       
        Mail::to($request->email)->send(new BillingInfoMail($user->name, $user->email, $user->phone, $user->address, $package->package_type, $package->package_price, $package->sms_quantity));
        Mail::to(generalsettings()->email)->send(new PaymentMail($user->name, $user->email, $user->phone, $user->address, $package->package_type, $package->package_price, $package->sms_quantity));
        return response('success');

    }

    // End
}
