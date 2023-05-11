<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\User;
use Carbon\Carbon;
use Shetabit\Visitor\Models\Visit;
use DB;
use App\Models\History;
use App\Models\MyOrder;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $sevenDay = MyOrder::where('created_at','>=', Carbon::today()->subDays(7))->get();
        //last 7 days order
        $orders = [];
        for($i=1; $i <= 7; $i++){
            $dailydata = MyOrder::whereDay('created_at', \Carbon\Carbon::today()->subDays($i))->count();
            array_push($orders, $dailydata);
        }
        
        //users per month
        for ($i=1; $i <=12 ; $i++) {
           
            $monthlyUsers[] = User::whereYear('created_at', date('Y'))->whereMonth('created_at', $i)->count();

        }

        //order_status wise orders of last seven days
        
        $newOrder = MyOrder::where('created_at','>=', Carbon::today()->subDays(7))->where('order_status',1)->count();
        $inProcessOrder = MyOrder::where('created_at','>=', Carbon::today()->subDays(7))->where('order_status',2)->count();
        $readyToPickOrder = MyOrder::where('created_at','>=', Carbon::today()->subDays(7))->where('order_status',3)->count();
        $deliveredOrder = MyOrder::where('created_at','>=', Carbon::today()->subDays(7))->where('order_status',4)->count();
        $orderStatus = [$newOrder, $inProcessOrder, $readyToPickOrder, $deliveredOrder ];
        

        //payment Status wise orders of last 7 years
        $totalYears = [];
        for ($i=1; $i <=10 ; $i++) {
           
            $years = Carbon::now()->subYear($i)->format('Y');
            array_push($totalYears, $years);
        }
        $cashPayment = [];
        foreach($totalYears as $year){
            $cash = MyOrder::whereYear('created_at', $year)->where('payment_status', 0)->count();
            array_push($cashPayment, $cash);
        }
        $cardPayment = [];
        foreach($totalYears as $year){
            $card = MyOrder::whereYear('created_at', $year)->where('payment_status', 1)->count();
            array_push($cardPayment, $card);
        }
        $ticketPayment = [];
        foreach($totalYears as $year){
            $ticket = MyOrder::whereYear('created_at', $year)->where('payment_status', 3)->count();
            array_push($ticketPayment, $ticket);
        }
        
        //last 12 months  payment data
        $months = [];
        for($i=1; $i<=12; $i++){
            $month = Carbon::now()->subMonths($i)->format('M');
            array_push($months, $month);
        };
        
        $keyMonths = [];
        for($i=1; $i<=12; $i++){
            $month = Carbon::now()->subMonths($i)->format('m');
            array_push($keyMonths, $month);
        };
        
        
        
        $cashperMonth = [];
        foreach($keyMonths as $keyMonth){
            $cash = MyOrder::whereMonth('created_at', $keyMonth)->where('payment_status', 0)->sum('total_price');
            array_push($cashperMonth, $cash);
        }

        $cardperMonth = [];
        foreach($keyMonths as $keyMonth){
            $card = MyOrder::whereMonth('created_at', $keyMonth)->where('payment_status', 1)->sum('total_price');
            array_push($cardperMonth, $card);
        }
        

        $ticketperMonth = [];
        foreach($keyMonths as $keyMonth){
            $ticket = MyOrder::whereMonth('created_at', $keyMonth)->where('payment_status', 3)->sum('total_price');
            array_push($ticketperMonth, $ticket);
        }
       

        $histories = Auth::user()->getHistory;
        $this_year_total = Auth::user()->getHistory()->whereYear('created_at',  \Carbon\Carbon::now()->format('Y'))->get()->count();
        $last_year_total = Auth::user()->getHistory()->whereYear('created_at',  \Carbon\Carbon::now()->subYear()->format('Y'))->get()->count();
        
        for($i = 6; $i >= 0; $i --){
            $last_week_send_messge[] = Auth::user()->getHistory()->whereDate('created_at', Carbon::now()->subDays($i))->get()->count();
            $days[] = Carbon::now()->subDays($i)->format('d-m-Y');
        } 
        for($i = 1; $i<=12;$i++){
            $this_year[] =Auth::user()->getHistory()->whereYear('created_at',  \Carbon\Carbon::now()->format('Y'))->whereMonth('created_at', $i)->get()->count();
            $last_year[] =Auth::user()->getHistory()->whereYear('created_at',  \Carbon\Carbon::now()->subYear()->format('Y'))->whereMonth('created_at', $i)->get()->count();
        }
        return view('admin.index', compact('histories', 'days', 'last_week_send_messge', 'this_year', 'last_year', 'this_year_total', 'last_year_total', 'orders', 'monthlyUsers', 'orderStatus', 'totalYears', 'cashPayment', 'cardPayment', 'ticketPayment', 'months', 'cashperMonth', 'cardperMonth', 'ticketperMonth'));

    // End
    }

    // User List
    public function userList(){

        $users = User::orderBy('name', 'asc')->get();

        return view('admin.users.index', compact('users'));
    }

    // User Create
    public function userCreate(){

        return view('admin.users.create');
    }



     // User Delete
    public function userDestroy($id){

        $user = User::find($id);

        $user->delete();

        return back()->withSuccess('User deleted');
    }

     // User Delete
    public function historyDestroy($id){

        $user = History::find($id);

        $user->delete();

        return back()->withSuccess('Log deleted');
    }

     // User Delete
    public function historyAllDestroy(){

        Auth::user()->getHistory->each->delete();

        return back()->withSuccess('Log Cleared');
    }

    // My Profile
    public function myProfile(){

        return view('admin.users.my-profile');
    }

}
