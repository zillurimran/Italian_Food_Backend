<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function index()
    {
        // $banners = Banner::all();
        // return view('admin.banners.index', compact('banners'));
        return view('admin.banners.index', [
            'banners' => Banner::all(),
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'sub_heading' => 'required',
            'tag_line' => 'required',
            'btn_txt' => 'required',
            'btn_url' => 'required',
            'media' => 'required|image',
        ],[
            'heading.required' => 'Heading is required',
            'sub_heading.required' => 'Sub Heading is required',
            'tag_line.required' => 'Tag Line is required',
            'btn_txt.required' => 'Please put a button text to continue',
            'btn_url.required' => 'Link for a redirection from the button is required',
            'media.required' => 'Banner Image is required',
            'media.image' => 'Banner image must be a image file',
        ]);

        $banner = Banner::create($request->except('_token') + ['created_at' => Carbon::now()]);


        $media = $request->file('media');
        $filename = $banner->id . '-' . time() . '.' . $media->getClientOriginalExtension();
        $location = public_path('/uploads/banners/');
        $media->move($location, $filename);

        $banner->media = $filename;
        $banner->save();

        return back()->withSuccess('Banner has been added');



    }


    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);

        $request->validate([
            'heading' => 'required',
            'sub_heading' => 'required',
            'tag_line' => 'required',
            'btn_txt' => 'required',
            'btn_url' => 'required',
        ],[
            'heading' => 'Heading is required',
            'sub_heading' => 'Sub Heading is required',
            'tag_line' => 'Tag Line is required',
            'btn_txt' => 'Please put a button text to continue',
            'btn_url' => 'Link for a redirection from the button is required',
        ]);


        if($request->hasFile('media'))
        {
            // dd($request->all());
            $media = $request->file('media');
            $filename = $banner->id . '-' . time() . '.' . $media->getClientOriginalExtension();
            $location = public_path('/uploads/banners/');
            $media->move($location, $filename);

            $banner->media = $filename;
        }

        $banner->heading = $request->heading;
        $banner->sub_heading = $request->sub_heading;
        $banner->tag_line = $request->tag_line;
        $banner->btn_txt = $request->btn_txt;
        $banner->btn_url = $request->btn_url;
        $banner->save() ;

        return back()->withSuccess('Banner has been updated');


    }


    public function delete($id)
    {
        $banner = Banner::find($id);
        $banner->delete();

        return back()->withSuccess('Banner has been deleted');

    }



// END

}
