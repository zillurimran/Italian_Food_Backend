<?php

namespace App\Http\Controllers;

use App\Models\BlogTag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogTagController extends Controller
{
    // Read
    public function index(){
        return view('admin/blogs/tags/index', [
            'tags' => BlogTag::all(),
        ]);
    }

    // Create
    public function create(Request $request){
        $request->validate([
            'name' => 'required',
        ],[
            'name' => 'Tag name is required',
        ]);

        $tag = BlogTag::create($request->except('_token') + ['created_at' => Carbon::now()]);
        $tag->save();

        return back()->withSuccess('Tag has been added');
    }

    //Update
    public function update(Request $request, $id){
        $tag = BlogTag::find($id);

        $request->validate([
            'name' => 'required',
        ],[
            'name' => 'Tag name is required',
        ]);

        $tag->name = $request->name;
        $tag->save();

        return Back()->withSuccess('Tag has been updated');
    }

    //Delete
    public function delete(Request $request, $id){
        $tag = BlogTag::find($id);
        $tag->delete();

        return Back()->withSuccess('Tag has been deleted successfully');
    }
}
