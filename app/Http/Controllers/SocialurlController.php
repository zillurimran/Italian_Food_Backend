<?php

namespace App\Http\Controllers;

use App\Models\Socialurl;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SocialurlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.socialurls.index',[

            'socialurls' => Socialurl::all(),
        ]);
    }

    public function store(Request $request)
    {
        SocialUrl::create($request->except('_token') + ['created_at' => Carbon::now()]);

        return back()->withSuccess('Social Media link created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Socialurl  $socialurl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Socialurl $socialurl)
    {



        $socialurl->icon  = $request->icon;
        $socialurl->link  = $request->link;

        $socialurl->save();

        return back()->withSuccess('Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Socialurl  $socialurl
     * @return \Illuminate\Http\Response
     */
    public function destroy(Socialurl $socialurl)
    {
        $socialurl->delete();
        return back()->withSuccess('Social Link Removed');
    }
}
