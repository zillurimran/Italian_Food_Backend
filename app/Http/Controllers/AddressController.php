<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\EmailAddress;
use App\Models\PhoneNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AddressController extends Controller
{
    public function index(){
        return view('admin.detailAddress.index',
        [
            'address'  => Address::first(),
            'phones'   => PhoneNumber::all(),
            'emails'   => EmailAddress::all()
        
        ]);
    }

    public function update(Request $request, $id){
        $address = Address::find($id);
        $request->validate([
            'address' => 'required'
        ],[
            'address' => 'Address is required'
        ]);

        $address->address = $request->address;
        $address->save();

        return back()->withSuccess('Addresss has beed updated');
    }

    public function storePhone(Request $request){
        $request->validate([
            'phone' => 'required|numeric'
        ],[
            'phone' => 'Phone is required'
        ]);

        $phone = PhoneNumber::create($request->except('_token')+['created_at'=>Carbon::now()]);
        $phone->save();

        return back()->withSuccess('Phone added successfully');
    }

    public function updatePhone(Request $request, $id){
        $phone = PhoneNumber::find($id);
        $request->validate([
            'phone' => 'required|numeric'
        ],
        [
            'phone' => 'Phone is required'
        ]);
        $phone->phone = $request->phone;
        $phone->save();

        return back()->withSuccess('Phone number updated');

    }

    public function deletePhone($id){
        $phone = PhoneNumber::find($id);
        $phone->delete();
        return back()->withSuccess('Phone number deleted');
    }

    public function emailStore(Request $request){
        $request->validate([
            'email' => 'required|email|unique:email_addresses'
        ],
        [
            'email.required' => 'Email is required',
            'email.email' => 'Insert a valid email Address',
            'email.unique' => 'Email already exists'
        ]);

        $email = EmailAddress::create($request->except('_token')+['created_at'=>Carbon::now()]);
        $email->save();

        return back()->withSuccess('Email has been added');
    }

    public function emailUpdate(Request $request, $id){
        $email = EmailAddress::find($id);
        $request->validate([
            'email' => 'required|email|unique:email_addresses'
        ],
        [
            'email.required' => 'Email is required',
            'email.email' => 'Insert a valid email Address',
            'email.unique' => 'Email already exists'
        ]);
        $email->email = $request->email;
        $email->save();

        return back()->withSuccess('Email has been updated');
    }

    public function emailDelete($id){
        $email = EmailAddress::find($id);
        $email->delete();
        return back()->withSuccess('Email address deleted');
    }

}
