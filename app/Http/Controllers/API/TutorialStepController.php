<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TutorialStep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class TutorialStepController extends Controller
{
    public function index(){
        $tutorials = TutorialStep::all();
        return response()->json([
             $tutorials
        ]);
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'tutorial_title' => 'required',
            'tutorial_sub_title' => 'required',
            'image' => 'required|image'
        ]);

        if($validator->fails()){
            return response()->json(['Validation Error.', $validator->errors()]);
        }

        $tutorialStep = new TutorialStep();
        $tutorialStep->tutorial_title = $request->tutorial_title;
        $tutorialStep->tutorial_sub_title = $request->tutorial_sub_title;
        
        if($request->file('image')){
            $image      = $request->file('image');
            $filename   = time().'.'.$image->getClientOriginalExtension();
            $fullName   = asset('uploads/tutorials').'/'.$filename;
            $location   = public_path('uploads/tutorials');
            $image->move($location, $filename);
            $tutorialStep->image = $fullName;
        }
        $tutorialStep->save();
        return response()->json([
        $tutorialStep, 
        'status'=>'Tutorial created successfully.']);
    }

    public function update(Request $request, $id){
        $tutorialStep = TutorialStep::find($id);
        $validator = Validator::make($request->all(),[
            'tutorial_title' => 'required',
            'tutorial_sub_title' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        if($request->file('image')){
            $image      = $request->file('image');
            $filename   = time().'.'.$image->getClientOriginalExtension();
            $fullName   = asset('uploads/tutorials').'/'.$filename;
            $location   = public_path('uploads/tutorials');
            $image->move($location, $filename);
            $tutorialStep->image = $fullName;
        }
        $tutorialStep->tutorial_title = $request->tutorial_title;
        $tutorialStep->tutorial_sub_title = $request->tutorial_sub_title;
        $tutorialStep->save();

        return response()->json([
            $tutorialStep,
            'status'=>"Tutorial updated successfully."
        ]);
    }

    public function delete($id){
        $tutorialStep = TutorialStep::find($id);
        $tutorialStep->delete();

        return response()->json([
            'status' => 'Deleted'
        ]);
    }

    public function userInfo(){
        $user = User::find(Auth::id());
        $userType = $user->role;
        $tutorialstep = $user->tutorial_steps;
        return response()->json([
            'user_type' => $userType,
            'tutorial_steps' => $tutorialstep
        ]);
    }

    public function statusUpdate(Request $request){
        $user = User::find(Auth::id());
        $user->tutorial_steps = $request->tutorial_steps;
        $user->save();
        return response()->json([
            'user_type' => $user->role,
            'tutorial_steps' => $user->tutorial_steps,
            'status' => 'Updated'
        ]);

    }
}
