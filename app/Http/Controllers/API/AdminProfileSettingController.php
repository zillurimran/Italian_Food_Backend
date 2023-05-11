<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AdminProfileSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AdminProfileSettingController extends Controller
{
    public function index(){
        $settings = User::find(Auth::id());
        return response()->json([
            'data' => $settings
        ]);
    }

    public function update(Request $request){
        $settings = User::find($request->id);
        $settings->update($request->all());
        return response()->json([
            $settings ,
            'status'=>"Updated successfully"
        ]);
    }
}
