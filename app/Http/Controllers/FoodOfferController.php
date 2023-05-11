<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use App\Models\Food;
use App\Models\FoodOffer;
use App\Models\FoodsOffer;
use App\Models\FoodType;
use App\Models\MysteryType;
use App\Models\PickupAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class FoodOfferController extends Controller
{
    public function index(){    
        $foodOffers = DB::table('foods_offers')
                    ->join('food_types','foods_offers.food_type','food_types.id')
                    ->join('pickup_addresses','foods_offers.boutique_id','pickup_addresses.id')
                    ->select('foods_offers.*','food_types.food_type', 'food_types.id as food_type_id','pickup_addresses.boutique_name','pickup_addresses.id as boutique_id')
                    ->latest()
                    ->get();

                    // dd($foodOffers);
        return view('admin.foodOffer.index',[ 
            'foodTypes'=>FoodType::all(),  
            'boutiques' => PickupAddress::all(),
            'foodOffers'=> $foodOffers,
            'mystery_types' => MysteryType::all(),
            'allergies' => Allergy::all(),
        ]); 
    }

    public function create(){       
        return view('admin.foodOffer.create',[ 
            'foodTypes' =>FoodType::all(),
            'boutiques' => PickupAddress::all(),
            'allergies' => Allergy::all(),
            'mystery_types' => MysteryType::all()
            ]);
    }

    public function store(Request $request){
        
        $request->validate([
                'food_type'         => 'required',
                'food_name'         => 'required',
                'food_description'  => 'required',
                'food_image'        => 'required|image',
                'thumbnail_image'   => 'image',
                'list_image'        => 'image',
                'food_stock'        => 'required|numeric',
                'price'             => 'required|numeric',
                'discount_price'    => 'numeric',
                'prefix'            => 'required',
                'boutique_id'       => 'required',
                'pickup_date_from'  => 'required|after:yesterday',
                'pickup_date_to'    => 'required|after:yesterday',
                'pickup_time_from'  => 'required',
                'pickup_time_to'    => 'required',
                // 'allergy_ids'       => 'required',
        ]);

       if($request->allergy_ids){
        $allergy_ids = implode(',', $request->allergy_ids);
       }
        $food = new FoodsOffer();
       
        $food->food_type        = $request->food_type;
        $food->mystery_type_id  = $request->mystery_type_id ?? null;
        if($request->food_type == 2 && $request->mystery_type_id == ''){
            return back()->withWarning('Mystery type is required when your food type is Mystery');
        }
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
        $food->allergy_ids      = $allergy_ids ?? '' ;
        $food->save();
        return redirect()->route('foodOffers.index')->withSuccess('Food offer added');
    }

    public function update(Request $request, $id){
       
        $food = FoodsOffer::find($id);
        $request->validate([
            'food_type'         => 'required',
            'food_name'         => 'required',
            'food_description'  => 'required',
            'food_stock'        => 'required|numeric',
            'price'             => 'required|numeric',
            'discount_price'    => 'numeric',
            'prefix'            => 'required',
            'boutique_id'       => 'required',
            'pickup_date_from'  => 'required',
            'pickup_date_to'    => 'required',
            'pickup_time_from'  => 'required',
            'pickup_time_to'    => 'required',
            // 'allergy_ids'       => 'required'
            
    ]);     
           if($request->allergy_ids){
            $allergy_ids = implode(',', $request->allergy_ids);
           }
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
            $food->allergy_ids      = $allergy_ids ?? $food->allergy_ids;
            $food->save();
            return back()->withSuccess('Food offer updated');
    }

    public function delete($id){
        $food = FoodsOffer::find($id);
        $food->delete();
        return back()->withSuccess('Deleted successfully');
    }

    public function hideShow($id){
        $food = FoodsOffer::find($id);
        if($food->hide_show == 1){
            $food->hide_show = 0;
        }else{
            $food->hide_show = 1;
        }
        $food->save();
        return back();
    }

    public function deleteAll(Request $request){
        $ids = $request->ids;
        if(!empty($ids)){
        FoodsOffer::whereIn('id',explode(',',$ids))->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleted successfully'
        ]);
        }else{
            return response()->json([
                'message' => 'no data is selected'
            ]);
        }
    }

    public function flatFood(){
        $flatFoods = DB::table('foods_offers')->where('foods_offers.food_type', 1)
                    ->join('food_types','foods_offers.food_type','food_types.id')
                    ->join('pickup_addresses','foods_offers.boutique_id','pickup_addresses.id')
                    ->select('foods_offers.*','food_types.food_type','pickup_addresses.boutique_name')
                    ->get();
        // $flatFoods = Food::where('food_type', 1)->get();
       return view('admin.foodOffer.index',[
        'foodOffers' => $flatFoods,
        'foodTypes'=>FoodType::all(),  
        'boutiques' => PickupAddress::all(),
       ]);
    }
    public function mysteryFood(){
        $mysteryFoods = DB::table('foods_offers')->where('foods_offers.food_type', 2)
                    ->join('food_types','foods_offers.food_type','food_types.id')
                    ->join('pickup_addresses','foods_offers.boutique_id','pickup_addresses.id')
                    ->select('foods_offers.*','food_types.food_type','pickup_addresses.boutique_name')
                    ->get();
        
        // $mysteryFoods = Food::where('food_type', 2)->get();
       return view('admin.foodOffer.index',[
        'foodOffers' => $mysteryFoods,
        'foodTypes'=>FoodType::all(),  
        'boutiques' => PickupAddress::all(),
       ]);
    }
}
