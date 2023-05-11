<?php

namespace App\Http\Controllers;

use App\Events\OrderEvent;
use App\Models\ChecklistItem;
use App\Models\ItemActivity;
use App\Models\ItemChecklist;
use App\Models\ItemLabel;
use App\Models\MyOrder;
use App\Models\OrderStatus;
use App\Models\Planning;
use App\Models\PlanningAssign;
use App\Models\Trello;
use App\Models\TrelloItem;
use App\Models\TrelloItemMember;
use App\Models\TrelloLabel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanningController extends Controller
{
    public function index(){
        // $users = User::all();

        // if(Auth::user()->role == 'admin'){
        //     $plannings = Planning::all();
        // }else{ 
        //     $plannings = Auth::user()->plannings->merge(Auth::user()->createdPlanning);
        // }

        // return view('admin.planning.index', compact('users', 'plannings'));

        $planning = Planning::first(); 
        if(!$planning){
            $planning = Planning::create([
                'name' => 'Default planning',
            ]); 
        }

        $id = $planning->id;

        if($planning->getTrello->count() == 0){
            Trello::create([
                'title' => 'Task List Title',
                'planning_id' => $id,
            ]);
        }

        // $trellos = Trello::where('planning_id', $id)->orderBy('order', 'asc')->get();
        $users = User::all();
        $order_status = OrderStatus::orderBy('order', 'asc')->get();
        $notifiable_users = User::where('role', 'user')->where('push_notification', 1)->get();
        return view('admin.planning.details', compact('users', 'id', 'planning', 'order_status', 'notifiable_users'));

    }

    public function create(Request $request){
        $request->validate([
            'image' => 'image',
        ]); 
 
        $planning = Planning::create($request->except(['_token', 'user_id']));

        if($request->file('image')){
            $image = $request->file('image');
            $image_name = $planning->id.rand(000,999).'image.'.$image->extension();
            $path = public_path('uploads/planning');
            $image->move($path, $image_name);
            $planning->image = $image_name;
        } 
        $planning->user_id = Auth::id();
        $planning->save();
        $planning->getAssignee()->sync($request->user_id);

        return back()->with('success', 'Added Successfully');
        
    }

    public function update(Request $request){
        $request->validate([
            'image' => 'image',
        ]);

        $planning = Planning::find($request->id);
        if($request->file('image')){
            $image = $request->file('image');
            $image_name = $planning->id.rand(000,999).'image.'.$image->extension();
            $path = public_path('uploads/planning');
            $image->move($path, $image_name);
            $planning->image = $image_name;
        }
        $planning->name = $request->name;
        $planning->color = $request->color; 
        $planning->save();
        $planning->getAssignee()->sync($request->user_id);

        return back()->with('success', 'Updated Successfully');
    }

    public function delete(Request $request){
        $planning = Planning::find($request->id);
        if($planning){
            $planning->delete();
        }

        return back()->with('success', 'Deleted Successfully');
    }

    public function planningItem($id){

        // $planning = Planning::find($id);
        // if($planning){
        //     if($planning->getTrello->count() == 0){
        //         Trello::create([
        //             'title' => 'Task List Title',
        //             'planning_id' => $id,
        //         ]);
        //     }

        //     $trellos = Trello::where('planning_id', $id)->orderBy('order', 'asc')->get();
        //     $users = User::all();

        //     return view('admin.planning.details', compact('trellos', 'users', 'id', 'planning'));

        // }else{
        //     return back();
        // }
        return back();
    }

     
    // Add new 
    public function trelloAddNew(Request $request){
        $data = Trello::create($request->except('_token'));
        return response($data);
    }

    // Remove Trello 
    public function trelloRemove(Request $request){
        $data = Trello::find($request->id)->delete();
        return response('success');
    }

    // update title 
    public function trelloTitleUpdate(Request $request){
        Trello::find($request->id)->update([
            'title'  => $request->title,
        ]);
        return response('success');     
    }

    // add New item 
    public function trelloAddItem(Request $request){ 
    $planning = Planning::find($request->planning_id);
    $item = TrelloItem::create([
            'title' => $request->title,
            'trello_id'  => $request->id,
        ]);
        if($request->members){
            foreach($request->members as $key => $value){
                TrelloItemMember::create([
                    'item_id'    => $item->id,
                    'trello_id'  => $request->id,
                    'member_id'  => $value,
                ]);
                $exit = PlanningAssign::where('planning_id', $planning->id)->where('user_id', $value)->exists();
                if(!$exit){
                    PlanningAssign::create([
                        'planning_id' => $planning->id,
                        'user_id' => $value,
                    ]); 
                } 
            }
        }
            
        $trello = Trello::find($request->id);

        $data = view('admin.planning.trello_item', compact('trello'))->render();

        return response($data);
    }

    // Item Modal Show 
    public function itemModalShow(Request $request){
        $item =MyOrder::find($request->id);
        // $item =TrelloItem::find($request->id);
        // $users = User::all();
        // $labels = TrelloLabel::all();
        $data = view('admin.planning.modal_body', compact('item'))->render();
        // $data = view('admin.planning.modal_body', compact('item','users', 'labels'))->render();
        return response()->json(['data' => $data]);
    }

    // Item Title update 
    public function itemTitleUpdate(Request $request){
        TrelloItem::find($request->id)->update([
            'title' => $request->title,
        ]);

        return response('success');
    }

    // Item Description update 
    public function itemDescriptionUpdate(Request $request){
        TrelloItem::find($request->id)->update([
            'description' => $request->description,
        ]);
        $item = TrelloItem::find($request->id);
        $item_icon = view('admin.planning.item_icon', compact('item'))->render();

        return response($item_icon);
    }

    // Item Member Update 
    public function trelloMemberUpdate(Request $request){
        $planning = Planning::find($request->planning_id); 
        $item_id = $request->id;
        $item = TrelloItem::find($item_id);
        $x_member = TrelloItemMember::where('item_id', $item_id)->get();
        $item_member_array =TrelloItemMember::where('item_id', $item_id)->pluck('member_id')->toArray(); 
        if($x_member){
            foreach($x_member as $member){
                $member->delete();
            }
        } 
        if($request->members){ 
            foreach($request->members as $id){
                TrelloItemMember::create([
                    'trello_id' => $request->trello_id,
                    'item_id'   => $item_id,
                    'member_id' => $id,
                ]);
                $exit = PlanningAssign::where('planning_id', $planning->id)->where('user_id', $id)->exists();
                if(!$exit){
                    PlanningAssign::create([
                        'planning_id' => $planning->id,
                        'user_id' => $id,
                    ]); 
                } 
            }
        } 
        $users = User::all();
        $data1 = view('admin.planning.item_member', compact('item'))->render();
        $data2 = view('admin.planning.item_member_block', compact('item'))->render();
        $data3 = view('admin.planning.item_user_list', compact('users', 'item'))->render();
        $data4 = view('admin.planning.item_user_list_2', compact('users', 'item'))->render();
        return response()->json(['data1' => $data1, 'data2' => $data2, 'users' => $data3, 'users2' => $data4]); 

    }

    // Label Create 
    public function trelloLabelCreate(Request $request){ 
        TrelloLabel::create($request->except('_token', 'id'));
        $labels = TrelloLabel::all();
        $item = TrelloItem::find($request->id);
        $data = view('admin.planning.item_label', compact('labels', 'item'))->render();
        // $data = view('admin.planning.item_labels', compact('labels', 'item'))->render();
        return response($data);
    }

    // Label  Remove 
    public function trelloLabelRemove(Request $request){
        $itemss = ItemLabel::where('label_id', $request->id)->get();
        if($itemss){
            foreach($itemss as $i){
                $i->delete();
            }
        }
        TrelloLabel::find($request->id)->delete();
        $labels = TrelloLabel::all();
        $item = TrelloItem::find($request->item);
        $data = view('admin.planning.item_label', compact('labels', 'item'))->render();  
        $data2 = view('admin.planning.item_select_label', compact('item'))->render(); 
        $data3 = view('admin.planning.item_labels', compact('item'))->render(); 
        return response()->json(['data1' => $data, 'data2' => $data2, 'data3' => $data3]); 
        return response($data);

    }

    // Label Update 
    public function trelloLabelUpdate(Request $request){

        $item_id = $request->id;
        $x_label = ItemLabel::where('item_id', $item_id)->get(); 
        if($x_label){
            foreach($x_label as $label){
                $label->delete();
            }
        }

        if($request->labels){ 
            foreach($request->labels as $id){
                ItemLabel::create([ 
                    'item_id'   => $item_id,
                    'label_id' => $id,
                ]);
            }
        }
        $item = TrelloItem::find($item_id);
        $labels = TrelloLabel::all();
        $data1 = view('admin.planning.item_label', compact('item', 'labels'))->render(); 
        $data2 = view('admin.planning.item_select_label', compact('item'))->render(); 
        $data3 = view('admin.planning.item_labels', compact('item'))->render(); 
        return response()->json(['data1' => $data1, 'data2' => $data2, 'data3' => $data3]); 

    }

    // update item cover 
    public function itemCoverUpdate(Request $request){
        $request->validate([
            'cover_image' => 'image',
        ]);
    $item = TrelloItem::find($request->item_id);
    $image = $request->file('cover_image');
    $image_name = $item->id. rand(0000,9999).$image->extension();
    $path = public_path('uploads/planning');
    $image->move($path, $image_name);
    $item->cover = $image_name;
    $item->save();
    return response('success');
    }

    // item  checklist store 
    public function itemChecklistStore(Request $request){
        ItemChecklist::create($request->except('_token'));
        $item = TrelloItem::find($request->item_id);
        $users = User::all();
        $data = view('admin.planning.item_checklist', compact('item','users'))->render(); 
        $item_icon = view('admin.planning.item_icon', compact('item'))->render();
        return response()->json(['data' => $data, 'item_icon' => $item_icon]);
    }

    // item checklist remove 
    public function itemChecklistRemove(Request $request)
    {
        ItemChecklist::find($request->id)->delete();
        $item = TrelloItem::find($request->item);
        $item_icon = view('admin.planning.item_icon', compact('item'))->render();
        return response($item_icon);
    }

    // checklist title update 
    public function checklistTitleUpdate(Request $request)
    {
        $data = ItemChecklist::find($request->id);
        $data->update([
            'title'  => $request->data,
        ]);
        return response('success');
    }

    // checklist item store 
    public function checklistItemStore(Request $request){
        $data = ChecklistItem::Create($request->except('_token','item'));
        $checklist = ItemChecklist::find($request->checklist_id);
        $users = User::all();
        $item = TrelloItem::find($request->item);
        $itemm = view('admin.planning.checklist_item' , compact('checklist','users'))->render();
        $view = view('admin.planning.progress_bar', compact('checklist'))->render(); 
        $item_icon = view('admin.planning.item_icon', compact('item'))->render();
        return response()->json(['data' => $itemm, 'view' => $view, 'item_icon' => $item_icon]);
    }

    // Checklist item title update 
    public function checklistItemTitleUpdate(Request $request)
    {
        $data = ChecklistItem::find($request->id);
        $data->update([
            'title' => $request->title
        ]); 

        return response('success');
    }

    // checklist item remove 
    public function checklistItemRemove(Request $request)   
    {
        ChecklistItem::find($request->id)->delete();
        $checklist = ItemChecklist::find($request->checklist);
        $item = TrelloItem::find($request->item);
        $view = view('admin.planning.progress_bar', compact('checklist'))->render(); 
        $item_icon = view('admin.planning.item_icon', compact('item'))->render();
        return response()->json(['data' => $view, 'item_icon' => $item_icon]);
    }

    // checklist item check 
    public function checklistItemCheck(Request $request)   
    {
        $data = ChecklistItem::find($request->id);
        $data->update([
            'status' => $request->status,
        ]);
        $checklist = ItemChecklist::find($request->checklist);
        $item = TrelloItem::find($request->item);

        $view = view('admin.planning.progress_bar', compact('checklist'))->render();
        $item_icon = view('admin.planning.item_icon', compact('item'))->render();
        return response()->json(['data' => $view, 'item_icon' => $item_icon]);
    }

    // checklist member update
    public function checklistItemMemberUpdate(Request $request)
    {
        $item_value = ChecklistItem::find($request->id);
        $item_value->update([ 'member' => $request->member ]);
        $view = view('admin.planning.checklist_member', compact('item_value'))->render();

        return response($view);
    }

    // checklist date update
    public function checklistItemDateUpdate(Request $request)
    {
        $item_value = ChecklistItem::find($request->id);
        $item_value->update([ 'due_date' => $request->date ]);
        $view = view('admin.planning.checklist_date', compact('item_value'))->render();
        return response($view);
    }

    // item date update 
    public function itemDateUpdate(Request $request){
        $items = explode('to', $request->dates);
        $item = TrelloItem::find($request->id);
        if(isset($items[1])){
            $item->update([
                'dates'    => $request->dates,
                'start_date' => $items[0],
                'due_date' => $items[1],
            ]);
        }else{
            $item->update([
                'dates'    => $request->dates,
                'start_date' => $items[0],
                'due_date'   => $items[0],
            ]);
        }
        
        $data = view('admin.planning.item_date', compact('item'))->render();
        $date = view('admin.planning.item_date_card', compact('item'))->render();
        return response()->json(['data' => $data, 'date' => $date]);
    }

    // item status update
    public function itemStatusUpdate(Request $request)
    {
        $item = TrelloItem::find($request->id);
        $item->status = $request->status;
        $item->save();  
        $item_icon = view('admin.planning.item_icon', compact('item'))->render();
        return response($item_icon);
    }

    // Item activity store 
    public function itemActivityStore(Request $request)
    {
        ItemActivity::create([
            'item_id'  => $request->id,
            'user_id'  => Auth::id(),
            'comment'  => $request->comment,
            'type'     => 'comment',
        ]);

        $item = TrelloItem::find($request->id);

        $view = view('admin.planning.item_activity', compact('item'))->render();
        $item_icon = view('admin.planning.item_icon', compact('item'))->render();
        return response()->json(['data' => $view, 'item_icon' => $item_icon]);
    }

    // Item Attachment upload 
    public function itemAttechmentUpdate(Request $request)
    {
        $path = public_path('uploads/planning');
        foreach($request->file('attachments_list') as $file){
            $extension = $file->extension();
            $file_name = rand(0000,9999).'-attechment.'.$extension;
            $file->move($path, $file_name);
            ItemActivity::create([
                'item_id'  => $request->item_id,
                'user_id'  => Auth::id(), 
                'file_name'=> $file_name,
                'file_type'=> $extension,
                'type'     => 'attachment',
            ]); 
        }

        $item = TrelloItem::find($request->item_id);
        $view = view('admin.planning.item_activity', compact('item'))->render();
        $view2 = view('admin.planning.item_attachment', compact('item'))->render();
        $item_icon = view('admin.planning.item_icon', compact('item'))->render(); 

        return response()->json(['activity' => $view, 'attachment' => $view2, 'item_icon' => $item_icon]);
    
    }

    // Item Attachment remove 
    public function itemAttachmentRemove(Request $request)
    {
        $data = ItemActivity::find($request->id)->delete();
        $item = TrelloItem::find($request->item);
        $view = view('admin.planning.item_activity', compact('item'))->render();
        $item_icon = view('admin.planning.item_icon', compact('item'))->render();
        return response()->json(['data' => $view, 'item_icon' => $item_icon]); 
    }

    // Item Activity Delete 
    public function itemActivityDelete(Request $request){
        $data = ItemActivity::find($request->id);
        $data->update([
            'deleted_status' => 1,
        ]);
        $item = TrelloItem::find($request->item);
        $view = view('admin.planning.item_activity', compact('item'))->render();
        $item_icon = view('admin.planning.item_icon', compact('item'))->render();
        return response()->json(['data' => $view, 'item_icon' => $item_icon]); 
    }

    // Trello Drag 
    public function trelloElementDrag(Request $request){
        foreach($request->order as $order)
        { 
            $data = OrderStatus::find($order['id']); 
            $data->update([ 
            'order'  => $order['position'],
            ]);  
        } 

        return response('success');
    }

    // Trello Item Drag 
    public function trelloItemDrag(Request $request){

        foreach($request->order as $order)
        { 
            $data = MyOrder::find($order['id']); 
            $old_status = $data->order_status;
            $data->update([ 
            'order'  => $order['position'],
            'order_status' => $request->item,
            ]);  
            if($old_status != $request->item){
                $order_status = ['1'=>'new', '2'=> 'in process', '3' => 'ready to pickup', '4' => 'delivered'];
                $client = $data->getCustomer;
                if($client && ($client->push_notification == 1)){
                    $title = "Your order is ".$order_status[$request->item];
                    $body  = $data->food->food_name . ' Boutique: ' . ($data->food->getBoutique->boutique_name ?? '') . ' Pickup Date: '. Carbon::parse($data->food->pickup_date_from)->format('d M, Y'). ' ('.$data->food->pickup_time_from .'-'. $data->food->pickup_time_to .')';
                    foreach($client->getFcmid as $item){
                        self::notificationEvent($item->fcmid, $body, $title, $data->id, 'order_status_change');
                    }
                }
            }
        } 
        $order_status = OrderStatus::orderBy('order', 'asc')->get();
        $users = User::all();
        $view = view('admin.planning.trello_main', compact('order_status', 'users'))->render();
        return response($view);

    }

    public function trelloItemDelete(Request $request){
        TrelloItem::find($request->id)->delete();
        return back()->with('success', __('Deleted Successfully'));
    }


    public function orderEvent(){
        $order_status = OrderStatus::orderBy('order', 'asc')->get();
        $users = User::all();
        $view = view('admin.planning.trello_main', compact('order_status', 'users'))->render();
        return response($view);
    }

    public function customNotification(Request $request){
        if($request->type == 'all'){
            $users = User::where('role', 'user')->where('push_notification', 1)->get();
        }else{
            $users = User::findMany($request->user_id);
        }

        foreach($users as $user){
            foreach($user->getFcmid as $item){
                self::notificationEvent($item->fcmid, $request->body, $request->title, '', '');
            }
        }

        return back()->with('success', 'Notification sent successfully');
    }

    // End 
}

