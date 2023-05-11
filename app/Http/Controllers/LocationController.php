<?php

namespace App\Http\Controllers;

use App\Models\SetLocation;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(){
        return view('admin.location.index',['location' => SetLocation::first()]);
    }

    public function update(Request $request, $id){
        $location = SetLocation::find($id);
        $location->location_url = $request->location_url;
        $location->save();
        return back()->withSuccess('Location updated');
    }
}
