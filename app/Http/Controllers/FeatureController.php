<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\SingleFeature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class FeatureController extends Controller
{
    public function index(){
        return view('admin.features.index',[
            'feature'         => Feature::first(),
            'featureSpecs'    => SingleFeature::all(),
        ]);
    }

    public function store(Request $request){
    
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
            'image' => 'image',
           
        ],[
            'title' => 'Heading is required',
            'sub_title' => 'Sub Heading is required',
            'description' => 'Tag Line is required',
            'image' => 'Please put a button text to continue',
        ]);


        $data =  Feature::first();

        $feature = $data->update($request->except('_token')+['created_at'=>Carbon::now()]);

     if($request->hasFile('image'))
     {
        $image = $request->file('image');
        $filename = $data->id . '-' . time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('/uploads/features/');
        $image->move($location, $filename);

        $data->image = $filename;
        $data->save();
     }

        return back()->withSuccess('Feature has been added');
    }


    public function update(Request $request, $id){
            $feature = Feature::find($id);
            $request->validate([
                'title' => 'required',
                'sub_title' => 'required',
                'description' => 'required',
                'image' => 'image',
               
            ],[
                'title' => 'Heading is required',
                'sub_title' => 'Sub Heading is required',
                'description' => 'Tag Line is required',
                'image' => 'Insert image',
               
            ]);
            
            $feature->title = $request->title;
            $feature->sub_title = $request->sub_title;
            $feature->description = $request->description;
            if($request->file('image')){
                $image = $request->file('image');
                $filename = $feature->id . '-' . time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('/uploads/features/');
                $image->move($location, $filename);

                $feature->image = $filename;
            }

            $feature->save();
            return back()->withSuccess('Feature has been updated');
    }

    public function delete($id){
            $feature = Feature::find($id);
            $feature->delete();

            return back()->withSuccess('Feature has been deleted');
    }

    public function storeSingleFeature(Request $request){
        $request->validate([
            'feature' => 'required',
        ],[
            'feature' => 'Feature is required',
        ]);

        $feature = SingleFeature::create($request->except('_token')+['created_at'=>Carbon::now()]);
        $feature->save();

        return back();

    }

    public function storeSpecs(Request $request){
        
        $request->validate([
            'feature' => 'required'
        ],[
            'feature' => 'Specification required'
        ]);

        $specification = SingleFeature::create($request->except('_token')+['created_at'=>Carbon::now()]);
        $specification->save();

        return back()->withSuccess('Specification has been added');
    }


    public function updateSpecs(Request $request, $id){
        $specification = SingleFeature::find($id);
        $request->validate([
            'feature' => 'required'
        ],[
            'feature' => 'Specification required'
        ]);

        $specification->feature = $request->feature;
        $specification->save();

        return back()->withSuccess('Specification has been updated');
    }


    public function deleteSpecs($id){
        $specification = SingleFeature::find($id);
        $specification->delete();

        return back()->withSuccess('Specification has been deleted');

    }
}
