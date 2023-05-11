<?php

namespace App\Http\Controllers;

use App\Models\TutorialStep;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TutorialStepController extends Controller
{
    public function index(){
        return view('admin.tutorials.index',['tutorialSteps' => TutorialStep::all()]);
    }

    public function create(){
        return view('admin.tutorials.create');
    }

    public function store(Request $request){
        $request->validate([
            'tutorial_title' => 'required',
            'tutorial_sub_title' => 'required',
            'image' => 'required|image'
        ]);
        $tutorialStep = new TutorialStep();
        // $tutorialStep = TutorialStep::create($request->except('_token') + ['created_at' => Carbon::now()]);
        $tutorialStep->tutorial_title = $request->tutorial_title;
        $tutorialStep->tutorial_sub_title = $request->tutorial_sub_title;
        if($request->file('image')){
            $image = $request->file('image');
            $filename = $tutorialStep->id.'-'.time().'.'.$image->getClientOriginalExtension();
            $location = public_path('/uploads/tutorials/');
            $image->move($location, $filename);
            $tutorialStep->image = $filename;
        }
        $tutorialStep->save();


        return back()->withSuccess('Tutorial Step added');
    }

    public function update(Request $request, $id){
        $tutorialStep = TutorialStep::find($id);
        $request->validate([
            'tutorial_title' => 'required',
            'tutorial_sub_title' => 'required',
            'image' => 'required|image'
        ]);
        
        $tutorialStep->tutorial_title = $request->tutorial_title;
        $tutorialStep->tutorial_sub_title = $request->tutorial_sub_title;
        if($request->file('image')){
            $image = $request->file('image');
            $filename = $tutorialStep->id . '-' . time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('/uploads/tutorials/');
            $image->move($location, $filename);
            $tutorialStep->image = $filename;
        }
        $tutorialStep->save();
        return back()->withSuccess('Tutorial Step updated');
        
    }

    public function delete($id){
        $tutorialStep = TutorialStep::find($id);
        $tutorialStep->delete();
        return back()->withSuccess('Tutorial deleted');
    }
}
