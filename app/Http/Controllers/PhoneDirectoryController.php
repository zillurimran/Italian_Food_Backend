<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\PhoneDirectory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneDirectoryController extends Controller
{
   public function index() 
   {
         return view('admin.phone_directories.index', [
              'phone_directories' => Auth::user()->phoneDirectory,
              'groups' => Auth::user()->getGroups,
         ]);
   }

   public function create()
   {
         return view('admin.phone_directories.create');
   }

    public function store(Request $request)
    {
            $request->validate([
                  'group_id' => 'required',
                  'numbers' => 'required',
            ]);
    
            if(PhoneDirectory::where('group_id', $request->group_id)->exists())
            {
                  $data = PhoneDirectory::where('group_id', $request->group_id)->first(); 
                  $data->numbers = $data->numbers . ' ' . $request->numbers;
                  $data->save();
            }
            else 
            {
                  $phone_directory = new PhoneDirectory();
                  $phone_directory->group_id = $request->group_id;
                  $phone_directory->numbers = $request->numbers;
                  $phone_directory->user_id = Auth::id();
                  $phone_directory->save();
            }
    
            return redirect()->route('phone-directories.index')->with('success', 'Phone Directory created successfully.');
    }

    public function edit(PhoneDirectory $phone_directory)
    {
            return view('admin.phone_directories.edit', compact('phone_directory'));
    }

    public function update(Request $request, PhoneDirectory $phone_directory)
    {
            $request->validate([
                  'group_id' => 'required',
                  'numbers' => 'required',
            ]);

            

            $phone_directory = PhoneDirectory::find($request->id); 

            if($phone_directory->group_id == $request->group_id)
            {
                  $phone_directory = PhoneDirectory::find($request->id);
                  $phone_directory->group_id = $request->group_id;
                  $phone_directory->numbers = $request->numbers;
                  $phone_directory->save();
            }
            else 
            { 
                  if(PhoneDirectory::where('group_id', $request->group_id)->exists())
                  {
                        $data = PhoneDirectory::where('group_id', $request->group_id)->first(); 
                        $data->numbers = $data->numbers . ' ' . $request->numbers;
                        $data->save();
                        $phone_directory->delete();
                  }
                  else 
                  {
                        $data = new PhoneDirectory();
                        $data->group_id = $request->group_id;
                        $data->numbers = $request->numbers;
                        $data->user_id = Auth::id();
                        $data->save();
                        $phone_directory->delete();
                  }
            }


    
    
            return redirect()->route('phone-directories.index')->with('success', 'Phone Directory updated successfully.');
    }


    public function destroy(PhoneDirectory $phone_directory)
    {
            $phone_directory = PhoneDirectory::find(request()->id);
            $phone_directory->delete();
    
            return redirect()->route('phone_directories.index')->with('success', 'Phone Directory deleted successfully.');
    }

    


}
