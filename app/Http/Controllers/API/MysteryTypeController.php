<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MysteryType;
use App\Models\User;
use Illuminate\Http\Request;

class MysteryTypeController extends Controller
{
    public function index(){
        $mysteryTypes = MysteryType::all();
        return response()->json([
            $mysteryTypes
        ]);
    }

}
