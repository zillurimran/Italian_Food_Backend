<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index(){
        $policy = PrivacyPolicy::first()->privacy_policy;
        return response()->json([
            'policies' => $policy
        ]);
    }
}
