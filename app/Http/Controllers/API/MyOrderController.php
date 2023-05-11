<?php

namespace App\Http\Controllers\API;

use Validator;
use Carbon\Carbon;
use App\Models\Food;
use App\Models\User;
use App\Models\MyOrder;
use App\Models\FoodsOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class MyOrderController extends Controller
{
    public function index(){
        $orders = MyOrder::all();
        return response()->json([
             $orders,
        ]);
    }

    public function store(Request $request){
       $validator = Validator::make($request->all(),[
                'food_id'  => 'required',
                'quantity' => 'required',
                'payment_status' => 'required'
       ]);

       if($validator->fails())
       {
        return response()->json([ 'Validation Error', $validator->errors() ]);
       }

       $food = FoodsOffer::find($request->food_id);
       if($food->food_stock >= $request->quantity)
       {
           $food->food_stock = $food->food_stock - $request->quantity;
           $food->save();

            $order = new MyOrder();
            $order->food_id        = $request->food_id;
            $order->quantity       = $request->quantity;
            $order->net_price      = $food->price;
            $order->total_price    = $request->quantity * $food->price;
            $order->customer_name  = Auth::user()->name;
            $order->user_id        = Auth::id();
            $order->payment_status = $request->payment_status;
            $order->pickup_time    = $food->pickup_time_from.' - '.$food->pickup_time_to;
            $order->order_date     = Carbon::now()->format('Y-m-d');
            $order->transaction_id = $request->transaction_id ?? null;
            $order->order_status   = 1;
            $order->order          = 1;
            $order->customer_pickup_time_from   = $request->customer_pickup_time_from ?? null;
            $order->customer_pickup_time_to     = $request->customer_pickup_time_to ?? null;
            $order->save();

            $payment_status = ['0'=>'Espèces', '1' => 'Payé', '2'=> 'Livré', '3' => 'Ticket Resto'];
            $admins = User::where('role', 'admin')->where('order_notification', 1)->get();
//            $body = $food->food_name .' Boutique: '.$food->getBoutique->boutique_name ?? ' '. ' Quantity: '.$order->quantity.' Total Price: '.$order->quantity*$food->price .' '. $payment_status[$order->payment_status];
           $body = $food->food_name . ' Boutique: ' . ($food->getBoutique->boutique_name ?? '') . ' Quantity: ' . $order->quantity . ' Total Price: ' . $order->quantity * $food->price . ' (' . $payment_status[$order->payment_status].')';

           $title = 'New Order Placed';
            foreach($admins as $admin){
                foreach($admin->getFcmid as $item){
                    self::notificationEvent($item->fcmid, $body, $title, $order->id, "order_details");
                }
            }

            if($food->food_stock == 0){
                $body = $food->food_name . ' Boutique: ' . ($food->getBoutique->boutique_name ?? '');

                $title = $food->food_name . ' stock has become zero';
                foreach($admins as $admin){
                    foreach($admin->getFcmid as $item){
                        self::notificationEvent($item->fcmid, $body, $title, $food->id, 'food_offers');
                    }
                }
            }



            return response()->json([
                'data' => $order,
                'status' => 'Order created successfully'
            ]);
       }
       else
       {
         return response()->json(['status' => 'Out of Stock. Available Stock : '. $food->food_stock]);
       }
    }

    // unpaid   = 0,
    // paid     = 1,
    // booked   = 2,
    // coupon   = 3,
    // species  = 4;
    public function updateStatus(Request $request, $id){
        $order = MyOrder::find($id);
        $old_status = $order->order_status;
        $order->payment_status = $request->payment_status ?? $order->payment_status;
        $order->order_status = $request->order_status ?? $order->order_status;
        $order->save();

        if($old_status != $request->order_status){
            $order_status = ['1'=>'new', '2'=> 'in process', '3' => 'ready to pickup', '4' => 'delivered'];
            $client = $order->getCustomer;
            if($client && ($client->push_notification == 1)){
                $title = "Your order is ".$order_status[$request->order_status];
                $body  = $order->food->food_name . ' Boutique: ' . ($order->food->getBoutique->boutique_name ?? '') . ' Pickup Date: '. Carbon::parse($order->food->pickup_date_from)->format('d M, Y'). ' ('.$order->food->pickup_time_from .'-'. $order->food->pickup_time_to .')';
                foreach($client->getFcmid as $item){
                    self::notificationEvent($item->fcmid, $body, $title, $order->id, 'order_status_change');
                }
            }
        }



        return response()->json([ $order, 'status'=>"Updated successfully"]);
    }

    public function delete($id){
        $order = MyOrder::findOrFail($id);
        $order->delete();
        return response()->json([ 'status' => "Deleted successfully"]);
    }

    public function getStock(Request $request){
        $food_stock = FoodsOffer::find($request->food_id);
        return response()->json([
            $food_stock
        ]);
    }

    public function history()
    {
        $orders = MyOrder::where('user_id', auth()->id())->latest()->get();

        return response()->json(['orders' => $orders, 'status' => 'success']);
    }

    public function userOrder($id){
        $order = MyOrder::find($id);
        return response()->json([
            $order
        ]);
    }
}
