<?php

namespace App\Http\Controllers;

use App\Jobs\StoreSmsJob;
use App\Models\Group;
use App\Models\PackageType;
use App\Models\PhoneDirectory;
use App\Models\StripeSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class BulkSmsController extends Controller
{
    public function create()
    {
        return view('admin.sms.create', [
            'groups' =>Auth::user()->getGroups,
        ]);
    }
    public function index(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ],[
            'title.required' => 'Please enter title',
            'body.required' => 'Please enter body',
        ]);
        
        if($request->group_id != '')
        {
            $data = PhoneDirectory::where('group_id', $request->group_id)->first();
            $numbers = explode(' ', $data->numbers);
        }
        else 
        {
            $numbers = explode(' ', $request->numbers);
        }

        if(count($numbers) > Auth::user()->total_sms - Auth::user()->send_message){
            return back()->with('error', "Sorry you don'n have limit to send ". count($numbers) ." sms, Plase topup your balance to send sms efficiently. You have ". Auth::user()->total_sms - Auth::user()->send_message ." remaining sms");
        }
        else{
            Auth::user()->update([
                'send_message' => Auth::user()->send_message + count($numbers),
            ]);
        }
        
        
        $title = $request->title;
        $body = $request->body;
        
        
        $basic  = new \Nexmo\Client\Credentials\Basic(nexmosetting()->api_key, nexmosetting()->api_secret);
        // $basic  = new \Nexmo\Client\Credentials\Basic('4bce8cdb', 'gI0cUAkFDzfQ8DyU');
        $client = new \Nexmo\Client($basic);
        
        // try and catch solve the issue 
        try {
            foreach($numbers as $number)
            {
                $message = $client->message()->send([
                    'to' => $number,
                    'from' => $title,
                    'text' => $body
                ]);
            }

            $this->dispatch(new StoreSmsJob($title, $body, $numbers, Auth::id(), $request->group_id));


            return back()->withSuccess('Message sent successfully');
            

        } catch (Exception $e) {
           return back()->withError($e);
        }
 
       
    }

    public function balanceTopup(Request $request){
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
                    'stripe_setting'=> $stripe_setting,
                );
                  
                return view('admin.stripe-payment', ['data'=>$data]); 
            }
            catch(Exception $e){
                dd($e);
                return redirect()->route('dashboard');
            }
        }else{
            return redirect()->route('dashboard');
        } 
    }

    public function topupSuccess(Request $request){
        $package = PackageType::where('package_price', $request->amount)->first();
        if($package){
            Auth::user()->update([
                'total_sms' => Auth::user()->total_sms + $package->sms_quantity ?? 0, 
                'amount' => Auth::user()->amount + $request->amount, 
            ]);
        }

        return response('success');

    }

    // END
}
