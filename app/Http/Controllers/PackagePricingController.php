<?php

namespace App\Http\Controllers;

use App\Models\PackageItems;
use App\Models\PackageType;
use Carbon\Carbon;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PackagePricingController extends Controller
{
    public function index(){
        return view('admin.packagePricing.index',[
            'packages'      =>PackageType::all(),
            'packageItems'  =>PackageItems::all()
        ]);
    }
    public function packageItem(){
        return view('admin.packagePricing.item',[
            'packageItems'  =>PackageItems::all()
        ]);
    }

    public function packageStore(Request $request){
        $request->validate([
            'package_type' => 'required',
            'package_price' => 'required|numeric',
            'sms_quantity' => 'required|numeric',
            'package_purpose' => 'required'
        ],
    [
        'package_type' => 'Package type is required',
        'package_price' => 'Package preice is required',
        'sms_quantity' => 'SMS quantity is required',
        'package_purpose' => 'Package purpose is required'
    ]);
        $packages = PackageType::create($request->except('_token') + ['created_at' =>  Carbon::now()]);
        $packages->save();
        return back()->withSuccess('Package Added');

    }

    public function packageUpdate(Request $request, $id){
        $package = PackageType::find($id);
        $request->validate([
            'package_type' => 'required',
            'package_price' => 'required|numeric',
            'sms_quantity' => 'required|numeric',
            'package_purpose' => 'required'
        ],
    [
        'package_type' => 'Package type is required',
        'package_price' => 'Package preice is required',
        'sms_quantity' => 'SMS quantity is required',
        'package_purpose' => 'Package purpose is required'
    ]);
        $package->package_type = $request->package_type;
        $package->package_price = $request->package_price;
        $package->sms_quantity = $request->sms_quantity;
        $package->package_purpose = $request->package_purpose;
        $package->save();
        return back()->withSuccess('Package Updated');
    }


    public function packageDelete($id){
        $package = PackageType::find($id);
        $package->delete();
        return back()->withSuccess('Package deleted');
    }


    public function itemStore(Request $request){
        $request->validate([
            'package_items' =>'required'
        ],
    [
        'package_items' => 'Item is required'
    ]);
    $items = PackageItems::create($request->except('_token') + ['created_at'=>Carbon::now()]);
    $items->save();
    return back()->withSuccess('Item Added');
    }
    public function itemUpdate(Request $request, $id){
        $item = PackageItems::find($id);
        $request->validate([
            'package_items' =>'required'
        ],
    [
        'package_items' => 'Item is required'
    ]);

    $item->package_items = $request->package_items;
    $item->save();
    return back()->withSuccess('Item Updated');

    }

    public function itemDelete($id){
        $item = PackageItems::find($id);
        $item->delete();
        return back()->withSuccess('Package deleted');
    }
}
