<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodTypeController extends Controller
{
    public function index(){
        return view('admin.foodTypes.index');
    }
}
