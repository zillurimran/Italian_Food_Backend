<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index(){
        return view('admin.blogs.items.index');
    }

    // Create
    public function create(){

        return view('admin.blogs.items.create');

    }

    public function store(Request $request){
        // dd($request);
        $request->validate([
            'title' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'thumbnail_img' => 'required|image',
            'written_by' => 'required',
            'category_id' => 'required',
            'tag' => 'required'
        ]);

        $blog = Blog::create($request->except('_token') + ['created_at' => Carbon::now()]);

        // foreach($request->tags as $tag)
        // {
        //     TagBlog::create([
        //         'blog_id' => $blog->id,
        //         'blog_tag_id' => $tag,
        //     ]);
        // }

        $thumbnail_img = $request->file('thumbnail_img');
        $filename = $blog->id . '-' . time() . '.' . $thumbnail_img->getClientOriginalExtension();
        $path = public_path('/uploads/blogs');
        $thumbnail_img->move($path, $filename);

        $blog->thumbnail_img = $filename;
        $blog->save();
        return back()->withSuccess('Blog Created successfully');
    }
}
