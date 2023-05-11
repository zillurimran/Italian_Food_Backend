<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class SubscriberController extends Controller
{

      /**
     * Construct
     */
    public function __construct()
    {
        $this->middleware('auth')->only('index');
        // $this->middleware('verified');
        // $this->middleware('checkAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subscribers.index',[
            'subscribers' => Subscriber::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //Form Validation
        // $request->validate([
        //     'email'    => 'required|unique:subscribers,email',
        // ]);
        $validator = Validator::make($request->all(),[
            'subscriber_email' => ['required', 'regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,4}$/i', 'email', 'unique:subscribers,email']
        ]);

        $validator->setAttributeNames([
            'subscriber_email'=>'email'
        ]);

        if($validator->fails()){
            $validator->validate(); 
        }

        // Subscriber::create($request->except('_token') + ['created_at' => Carbon::now()]);
        $subscriber = new Subscriber();
        $subscriber->email = $request->subscriber_email;
        $subscriber->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

         // Return back with success message
         return redirect()->route('subscribers.index')->withSuccess('Deleted successfully');
    }
}
