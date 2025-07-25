<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use App\Models\Transaction;
use Carbon\Carbon;



class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function orders(){
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('user.orders', compact('orders'));
    }

    public function order_details($order_id){
        $order = Order::where('user_id', Auth::user()->id)->where('id', $order_id)->first();
        if($order){
            $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id', 'desc')->paginate(10);
            $transaction = Transaction::where('order_id', $order->id)->first();
        return view ('user.order_details', compact('order','orderItems', 'transaction'));
    }
        else{
            return redirect()->route('login');
        }
    }

    public function order_cancel(Request $request){
        $order = Order::find($request->order_id);
        $order->status = 'cancelled';
        $order->cancelled_date = Carbon::now();
        $order->save();
        return back()->with('success', 'Order cancelled successfully');
    }
}
