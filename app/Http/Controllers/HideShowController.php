<?php

namespace App\Http\Controllers;

use App\Models\HideShow;
use Illuminate\Http\Request;

class HideShowController extends Controller
{
    public function bannerStatus(Request $request)
    {
       $hideshow = HideShow::first(); 
       $hideshow->banner_status = $request->status; 
       $hideshow->save();
    }

    public function bannerBottomStatus(Request $request)
    {
       $hideshow = HideShow::first(); 
       $hideshow->banner_bottom_status = $request->status; 
       $hideshow->save();
    }

    public function pricingStatus(Request $request)
    {
       $hideshow = HideShow::first(); 
       $hideshow->pricing_status = $request->status; 
       $hideshow->save();
    }

    public function testimonialStatus(Request $request)
    {
       $hideshow = HideShow::first(); 
       $hideshow->testimonial_status = $request->status; 
       $hideshow->save();
    }

    public function contactStatus(Request $request)
    {
       $hideshow = HideShow::first(); 
       $hideshow->contact_status = $request->status; 
       $hideshow->save();
    }

    public function mapStatus(Request $request)
    {
       $hideshow = HideShow::first(); 
       $hideshow->map_status = $request->status; 
       $hideshow->save();
    }

}

