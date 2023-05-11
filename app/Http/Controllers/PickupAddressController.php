<?php

namespace App\Http\Controllers;

use App\Models\PickupAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class PickupAddressController extends Controller
{
    public function index(){
        return view('admin.pickupAddress.index',['pickupAddresses' => PickupAddress::all()]);
    }

    public function create(){
        return view('admin.pickupAddress.create');
    }

    public function store(Request $request){
        
        $request->validate([
            'boutique_name' => 'required|unique:pickup_addresses,boutique_name',
            'address' => 'required',
            'opened_at' => 'required',
            'closed_at' => 'required',
        ]);

        $pickupAddress = PickupAddress::create($request->except('_token') + ['created_at' => Carbon::now()]);
        // return back()->withSuccess('Pickup address added');
        return redirect()->route('pickup_address.index')->withSuccess('Pickup address added');
    }

    public function update(Request $request, $id){
        $pickupAddress = PickupAddress::find($id);
        $request->validate([
            'boutique_name' => 'required',
            'address' => 'required',
            'opened_at' => 'required',
            'closed_at' => 'required',
        ]);
        $pickupAddress->update($request->all());
        $pickupAddress->save();
        return back()->withSuccess('Pickup address updated');
    }

    public function delete($id){
        $pickupAddress = PickupAddress::find($id);
        $pickupAddress->delete();
        return back()->withSuccess('Pickup address deleted');
    }

    public function deleteBoutiques(Request $request){
        $ids = $request->ids;
        PickupAddress::whereIn('id', $ids)->delete();
        
        // DB::table('pickup_addresses')->delete();
        
        return back()->withSuccess('Boutiques deleted');
    }

    
}
