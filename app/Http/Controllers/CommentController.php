<?php

namespace App\Http\Controllers;


use App\Mail\ContactMessageMail;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;


class CommentController extends Controller
{
    public function index(){
        return view('admin.comments.index',[ 'comments'=>Comment::latest()->get() ]);
    }

    public function storeComment(Request $request){


        $validatior = Validator::make($request->all(),[
            'comment' => ['required', 'string'],
            'contact_name' => ['required', 'string'],
            'contact_email' => ['required', 'regex:/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,4}$/i', 'email']
        ]);

        $validatior->setAttributeNames([
            'contact_name' => 'name',
            'contact_email' => 'email'
        ]);

        if($validatior->fails()){
            $validatior->validate();
        }


        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->name = $request->contact_name;
        $comment->email = $request->contact_email;
        $comment->phone_number = $request->contact_phone;
        $comment->company_name = $request->contact_company;
        $comment->save();

        Mail::to(generalsettings()->email)->send(new ContactMessageMail($request->contact_name, $request->contact_email, $request->comment));
        return back()->withSuccess('Comment sent');
    }

    public function deleteComment($id){
        $comment = Comment::find($id);
        $comment->delete();
        return back()->withSuccess('Comment has been deleted');
    }
}
