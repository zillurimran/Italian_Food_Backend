<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\FoodOffer;
use App\Models\FoodsOffer;
use App\Models\PickupAddress;
use Illuminate\Http\Request;
use Validator;

class FoodOfferController extends Controller
{
    public function index(){

        $foods = FoodsOffer::all();
        return response()->json(
             $foods

        );
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[

            'food_type'         => 'required',
            'food_name'         => 'required',
            'food_description'  => 'required',
            'food_image'        => 'required|image',
            'food_stock'        => 'required|numeric',
            'price'             => 'required|numeric',
            'discount_price'    => 'numeric',
            'prefix'            => 'required',
            'boutique_id'       => 'required',
            'pickup_date_from'  => 'required|after:yesterday',
            'pickup_date_to'    => 'required|after:yesterday',
            'pickup_time_from'  => 'required',
            'pickup_time_to'    => 'required',


        ]);
        if($validator->fails()){
            return response()->json([
                'Validation error',
                $validator->errors()
            ]);
        }
        $food = new FoodsOffer();
        $food->food_type        = $request->food_type;
        $food->mystery_type_id  = $request->mystery_type_id ?? null;
        $food->food_name        = $request->food_name;
        $food->food_description = $request->food_description;

        if($request->file('food_image')){
            $image      = $request->file('food_image');
            $filename   = time().'.'.$image->getClientOriginalExtension();
            $fullName   = asset('uploads/foodOffers').'/'.$filename;
            $location   = public_path('uploads/foodOffers');
            $image->move($location, $filename);
            $food->food_image = $fullName;
        }
        // return [
        //     'path' => env('APP_URL')."/uploads/foodOffers/".$filename
        // ];

        if($request->file('thumbnail_image')){
            $image      = $request->file('thumbnail_image');
            $filename   = time().'.'.$image->getClientOriginalExtension();
            $fullName   = asset('uploads/thumbnail').'/'.$filename;
            $location   = public_path('uploads/thumbnail');
            $image->move($location, $filename);
            $food->thumbnail_image = $fullName;
        }

        if($request->file('list_image')){
            $image      = $request->file('list_image');
            $filename   = time().'.'.$image->getClientOriginalExtension();
            $fullName   = asset('uploads/list').'/'.$filename;
            $location   = public_path('uploads/list');
            $image->move($location, $filename);
            $food->list_image = $fullName;
        }


        $food->food_stock       = $request->food_stock;
        $food->price            = $request->price;
        $food->discount_price   = $request->discount_price;
        $food->prefix           = trim($request->prefix);
        $food->boutique_id      = $request->boutique_id;
        $food->pickup_date_from = $request->pickup_date_from;
        $food->pickup_date_to   = $request->pickup_date_to;
        $food->pickup_time_from = $request->pickup_time_from;
        $food->pickup_time_to   = $request->pickup_time_to;
        $food->hide_show        = $request->hide_show;
        $food->allergy_ids      = $request->allergy_ids ?? '';
        $food->save();
        return response()->json([
            $food,
            'status' => "Successfull"
        ]);
    }

    public function update(Request $request){
        // $pickup_location = PickupAddress::where('id', $request->boutique_id)->first();
        $food = FoodsOffer::find($request->id);
        $validator = Validator::make($request->all(),[
                'food_type'         => 'required',
                'food_name'         => 'required',
                'food_description'  => 'required',
                // 'food_image'        => 'required|image',
                'food_stock'        => 'required|numeric',
                'price'             => 'required|numeric',
                'discount_price'    => 'numeric',
                'prefix'            => 'required',
                'boutique_id'       => 'required',
                'pickup_date_from'  => 'required',
                'pickup_date_to'    => 'required',
                'pickup_time_from'  => 'required',
                'pickup_time_to'    => 'required',
    ]);
    if($validator->fails()){
        return response()->json([
            'Validation error',
            $validator->errors()
        ]);
    }
        // $allergy_ids = implode(',', $request->allergy_ids);
        $food->food_type = $request->food_type;
        $food->food_name = $request->food_name;
        $food->food_description = $request->food_description;

        if($request->file('food_image')){
            $image      = $request->file('food_image');
            $filename   = time().'.'.$image->getClientOriginalExtension();
            $fullName   = asset('uploads/foodOffers').'/'.$filename;
            $location   = public_path('uploads/foodOffers');
            $image->move($location, $filename);
            $food->food_image = $fullName;
        }
        if($request->file('thumbnail_image')){
            $image      = $request->file('thumbnail_image');
            $filename   = time().'.'.$image->getClientOriginalExtension();
            $fullName   = asset('uploads/thumbnail').'/'.$filename;
            $location   = public_path('uploads/thumbnail');
            $image->move($location, $filename);
            $food->thumbnail_image = $fullName;
        }

        if($request->file('list_image')){
            $image      = $request->file('list_image');
            $filename   = time().'.'.$image->getClientOriginalExtension();
            $fullName   = asset('uploads/list').'/'.$filename;
            $location   = public_path('uploads/list');
            $image->move($location, $filename);
            $food->list_image = $fullName;
        }
            $food->food_stock       = $request->food_stock;
            $food->price            = $request->price;
            $food->discount_price   = $request->discount_price;
            $food->boutique_id      = $request->boutique_id;
            $food->pickup_date_from = $request->pickup_date_from;
            $food->pickup_date_to   = $request->pickup_date_to;
            $food->pickup_time_from = $request->pickup_time_from;
            $food->pickup_time_to   = $request->pickup_time_to;
            $food->allergy_ids      = $request->allergy_ids;
            $food->hide_show        = $request->hide_show;
            $food->save();
            return response()->json([
            $food,
            'status'=>"Updated"
        ]);

    }

    public function delete($id){
        $food = FoodsOffer::findOrFail($id);
        $food->update([
            'is_delete' => 1
        ]);
        return response()->json([
            'status'=>"Deleted Successfully"
        ]);
    }

    public function hideShow(Request $request, $id){
        $food = FoodsOffer::find($id);
        $food->hide_show = $request->hide_show;
        $food->save();
        return response()->json([
            $food,
            'status' => 'updated successfully'
        ]);
    }
}
