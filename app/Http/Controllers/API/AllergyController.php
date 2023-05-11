<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Allergy;
use Illuminate\Http\Request;
use Validator;

class AllergyController extends Controller
{
    public function index()
    {
        $data = Allergy::all();
        return response()->json([
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);
        if($validator->fails())
        {
            return response()->json(['Validation Error.', $validator->errors()]);
        }
        $allergy = Allergy::create([
            'name' => $request->name
        ]);
        return response()->json([ $allergy, "Allergy added successfully"]);
    }

    public function update(Request $request)
    {   
        $allergy = Allergy::find($request->id);
        $allergy->update( $request->all());
        $allergy->save();
        return response()->json([ $allergy, "Updated successfully"]);
    }

    public function delete($id)
    {   
        $allergy = Allergy::findOrFail($id);
        $allergy->delete();
        return response()->json([ $allergy, "Deleted successfully"]);
    }
}
