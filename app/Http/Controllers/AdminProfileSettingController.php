<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProfileSettingController extends Controller
{
    public function index(){
        return view('admin.adminProfile.index');
    }
}
