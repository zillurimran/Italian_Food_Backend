<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\PickupAddress;
use Illuminate\Http\Request;
use Validator;

class PickupAddressController extends Controller
{
    public function index()
    {
        $boutique = PickupAddress::all();
        return response()->json([
            'data' => $boutique
        ]);
    }

    public function store(Request $request)
    {
     
       $validator = Validator::make($request->all(), [
            'boutique_name' => 'required|unique:pickup_addresses,boutique_name',
            'address' => 'required',
            'opened_at' => 'required',
            'closed_at' => 'required'
        ]);

        if($validator->fails())
        {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $boutique = PickupAddress::create([
            'boutique_name' => $request->boutique_name,
            'address' => $request->address
        ]);

        return $this->sendResponse($boutique, 'Boutique created successfully.');
    }

    public function update(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'boutique_name' => 'required',
            'address' => 'required',
            'opened_at' => 'required',
            'closed_at' => 'required',
        ]);

        if($validator->fails())
        {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $boutique = PickupAddress::find($request->id);
        $boutique->update($request->all());
        $boutique->save();
        
        return $this->sendResponse($boutique, 'Boutique updated successfully.');
    }

    public function destroy($id)
    {
        $boutique = PickupAddress::findOrFail($id);
        $boutique->delete();
        return $this->sendResponse($boutique, 'Boutique deleted successfully.');
    }
}
