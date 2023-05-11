<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Validator;
use DB;

use function GuzzleHttp\Promise\all;

class RatingController extends Controller
{   
    public function uid(){
        // $u_ids = DB::table('ratings')->pluck('uid');
        $u_ids = Rating::pluck('uid');
        
        return response()->json(
            $u_ids
        );
    }
    public function index(){
        $ratings = Rating::latest()->get();
        return response()->json([
             $ratings
        ]);
    }

    public function store(Request $request){

        if(Rating::where('uid', $request->uid)->exists()){
            Rating::where('uid', $request->uid)->first()->delete();
        }

        $validator = Validator::make($request->all(),[
            'uid' => 'required|unique:ratings,uid',
            'image' => 'required|image',
            'name' => 'required',
            'description' => 'required',
            'ratings' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                // 'error' => 400, 
            ]);
        }

        $rating = new Rating();
        $rating->uid = $request->uid;
        if($request->file('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $fullName = asset('uploads/ratings').'/'.$filename;
            $location = public_path('/uploads/ratings');
            $image->move($location, $filename);
            $rating->image = $fullName;
        }

        $rating->name = $request->name;
        $rating->description = $request->description;
        $rating->ratings = $request->ratings;
        $rating->save();

        return response()->json([
            'data' => $rating,
            'status' => 'success'
        ]);
    }

    // public function update(Request $request){
    //     $rating = Rating::find($request->id);
    //     $validator = Validator::make($request->all(),[
    //         'uid' => 'required',
    //         'image' => 'required|image',
    //         'name' => 'required',
    //         'description' => 'required',
    //         'ratings' => 'required'
    //     ]);

    //     if($validator->fails()){
    //         return response()->json([
    //             'message' => 'Validation error',
    //             'errors' => $validator->errors(),
    //             // 'error' => 400, 
    //         ]);
    //     }
    //     // $rating->uid = $request->uid;
    //     if($request->file('image')){
    //         $image = $request->file('image');
    //         $filename = $rating->id.'-'.time().'.'.$image->getClientOriginalExtension();
    //         $location = public_path('/uploads/ratings/');
    //         $image->move($location, $filename);
    //         $rating->image = $filename;
    //     }
    //     // $rating->name = $request->name;
    //     // $rating->description = $request->description;
    //     // $rating->ratings = $request->ratings;
    //     // $rating->save();
    //     $rating->update($request->all());
    //     $rating->save();
    //     return response()->json([
    //         'data' => $rating,
    //         'success' => "Updated Successfully"
    //     ]);
    // }

    // public function destroy($id){
    //     $rating = Rating::find($id);
    //     $rating->delete();
    //     return response()->json([
    //         'data' => $rating,
    //         'success' => "deleted Successfully"
    //     ]);
    // }
}
