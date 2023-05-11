<?php

namespace App\Http\Controllers;

use App\Models\MyOrder;
use App\Models\PickupAddress;
use Illuminate\Http\Request;
use App\Models\FoodsOffer;
use DB;

class MyOrderController extends Controller
{
    public function index(){
        
        $orders = MyOrder::all();
        $orders = DB::table('my_orders')
        ->join('foods_offers', 'my_orders.food_id', 'foods_offers.id')
        ->join('pickup_addresses', 'foods_offers.boutique_id', 'pickup_addresses.id')
        ->join('users','my_orders.user_id', 'users.id')
        ->select('my_orders.*', 'foods_offers.food_name', 'foods_offers.pickup_time_from', 'foods_offers.pickup_time_to', 'foods_offers.price', 'foods_offers.boutique_id', 'pickup_addresses.boutique_name','users.name','users.email')
        ->latest()
        ->get();

        return view('admin.myOrders.index',compact('orders'));
    }

    // 0 == unpaid
    // 1 == paid
    // 2 == book
    // 3 == coupon
    // 4 == species

    public function markAsUnpaid($id){
        $order = MyOrder::find($id);
        $order->payment_status = 0;
        $order->save();
        return back();
    }
    public function markAsPaid($id){
        $order = MyOrder::find($id);
        $order->payment_status = 1;
        $order->save();
        return back();
    }
    public function markAsBook($id){
        $order = MyOrder::find($id);
        $order->payment_status = 2;
        $order->save();
        return back();
    }
    public function markAsCoupon($id){
        $order = MyOrder::find($id);
        $order->payment_status = 3;
        $order->save();
        return back();
    }
    public function markAsSpecies($id){
        $order = MyOrder::find($id);
        $order->payment_status = 4;
        $order->save();
        return back();
    }
    

    public function delete($id){
         $order = MyOrder::find($id);
         $order->delete();
         return back()->withSuccess('Order deleted');
    }

    public function bulkDelete(Request $request){
        $ids = $request->ids;
        if(!empty($ids)){
            MyOrder::whereIn('id',$ids)->delete();
            return back()->withSuccess('Orders deleted');
        }else{
            return back()->withWarning('no data is selected');
        }
       
    }
}
