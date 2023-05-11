<?php

namespace App\Http\Controllers;

use App\Models\NexmoSetting;
use Illuminate\Http\Request;

class NexmoSettingController extends Controller
{
    public function index()

    {
        return view('admin.nexmo.index');
    }

    public function update(Request $request, $id)
    {
        $data = NexmoSetting::find($id);

        $data->api_key = $request->api_key;
        $data->api_secret = $request->api_secret;

        $data->save();

        return redirect()->route('nexmo.index')->with('success', 'Nexmo Setting updated successfully.');
    }

 // END    
}
