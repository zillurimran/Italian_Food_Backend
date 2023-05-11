<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index(){
        return view('admin.blogs.categories.index', [
            'categories' => BlogCategory::all(),
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ],[
            'name' => 'Category name is required',
        ]);

        $category = BlogCategory::create($request->except('_token') + ['created_at' => Carbon::now()]);
        $category->save();

        return back()->withSuccess('Category has been added');
    }

    public function update(Request $request, $id){
        $category = BlogCategory::find($id);

        $request->validate([
            'name' => 'required',
        ],[
            'name' => 'Category name is required',
        ]);

        $category->name = $request->name;
        $category->save();

        return back()->withSuccess('Category has been updated');
    }

    public function delete(Request $request, $id){
        $category = BlogCategory::find($id);
        $category->delete();

        return back()->withSuccess('Category has been deleted successfully');
    }
}
