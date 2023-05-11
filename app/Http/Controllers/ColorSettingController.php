<?php

namespace App\Http\Controllers;

use App\Models\ColorSetting;
use Illuminate\Http\Request;

class ColorSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.colorSettings.index', [

            'colorSettings' => colorSetting::first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ColorSetting  $colorSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ColorSetting $colorSetting)
    {   
        
        // Form Validation
        $request->validate([

            'primary_color'  => 'required',
        ]);

        $colorSetting->primary_color = $request->primary_color;
        $colorSetting->secondary_color = $request->secondary_color;
        $colorSetting->button_color = $request->button_color;
        $colorSetting->text_color = $request->text_color;
        $colorSetting->hover_color = $request->hover_color;
        $colorSetting->bg_color = $request->bg_color;


        $colorSetting->save();

        return back()->withSuccess('Updated Successfully');
    }

}
