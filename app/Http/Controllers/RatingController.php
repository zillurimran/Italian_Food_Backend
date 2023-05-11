<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(){
        return view('admin.ratings.index',['ratings' => Rating::all()]);
    }

    public function delete($id){
        $rating = Rating::find($id);
        $rating->delete();
        return back()->withSuccess('Rating deleted');
    }
}
