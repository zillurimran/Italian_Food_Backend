<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AllergyController extends Controller
{
    public function index(){
        return view('admin.allergies.index',['allergies' => Allergy::all()]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
        $allergy = Allergy::create($request->except('_token') + ['created_at' => Carbon::now()]);
        return back()->withSuccess('Succesfully added');
    }

    public function update(Request $request){
        $allergy = Allergy::find($request->id);
        $allergy->update($request->all());
        $allergy->save();
        return back();
    }

    public function deleteChecked(Request $request){
        $ids = $request->ids;
        if(!empty($ids)){
            Allergy::whereIn('id',explode(',',$ids))->delete();
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

    
}
