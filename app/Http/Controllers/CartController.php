<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::instance('cart')->content();
        return view('cart', compact('items'));
    }

    public function add_to_cart(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'id' => 'required|integer|exists:products,id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Add the product to the cart
        Cart::instance('cart')->add(
            $validated['id'],
            $validated['name'],
            $validated['quantity'],
            $validated['price']
        )->associate('App\Models\Product');
        // Flash a success message
        // $cartItems = Cart::instance('cart')->content()->map(function ($item) {
        //     return [
        //         'id' => $item->id,
        //         'name' => $item->name,
        //         'quantity' => $item->qty,
        //         'price' => $item->price,
        //     ];
        // })->values();
        // dd($cartItems);
        session()->flash('success', 'Product added to cart successfully!');

        // Redirect back to the product details page
        return redirect()->back();
    }
    public function clear_session()
{
    // Clear the cart
    Cart::instance('cart')->destroy();

    // Clear the entire session (optional)
    session()->flush();

    session()->flash('success', 'Session and cart cleared successfully!');
    return redirect()->route('cart.index');
}

    public function increase_cart_quantity($rowid)
    {
        $product = Cart::instance('cart')->get($rowid);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowid, $qty);
        return redirect()->back();
    }
    public function decrease_cart_quantity($rowid)
    {
        $product = Cart::instance('cart')->get($rowid);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowid, $qty);
        return redirect()->back();
    }

    public function remove_item($rowid)
    {
        // Remove the item from the cart
        Cart::instance('cart')->remove($rowid);
        return redirect()->back();
    }

    public function empty_cart()
    {
        // Clear the cart
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    public function apply_coupon(Request $request){
        $coupon_code = $request->coupon_code;
        if(isset($coupon_code)){
            $coupon = Coupon::where('code', $coupon_code)->where('expiry_date', '>=', Carbon::today())
            ->where('cart_value', '<=', Cart::instance('cart')->subtotal())->first(); 
            if(!$coupon){
                return redirect()->back()->with('error', 'Coupon code is invalid or expired.');
            }else{
                Session()->put('coupon', [
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => $coupon->value,
                    'cart_value' => $coupon->cart_value,
                ]);

                $this->calculate_discount();
                return redirect()->back()->with('success', 'Coupon code applied successfully.');
            }
        }else{
            return redirect()->back()->with('error', 'Please enter a coupon code.');
        }
    }

    public function calculate_discount(){
        $discount = 0;
        if(Session()->has('coupon'))
        {
            if (Session::get('coupon')['type']=='fixed') {
                $discount = Session::get('coupon')['value'];
        }else{
            $discount = (Cart::instance('cart')->subtotal() * Session::get('coupon')['value']) / 100;
        }
        $totalAfterDiscount = Cart::instance('cart')->subtotal() - $discount;
        $taxAfterDiscount = ($totalAfterDiscount * config('cart.tax')) / 100;
        $total = $totalAfterDiscount + $taxAfterDiscount;

        Session::put('discounts', [
            'discount' => number_format(floatval($discount),2,'.', ''),
            'subtotal' =>number_format(floatval($totalAfterDiscount),2,'.', ''),
            'tax' => number_format(floatval($taxAfterDiscount),2,'.', ''),
            'total' => number_format(floatval($total),2,'.', ''),

        ]);
    }
    }

    public function remove_coupon(){
        Session::forget('coupon');
        Session::forget('discounts');
        return back()->with('success', 'Coupon removed successfully.');
    }

    public function checkout(){
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $address = Address::where('user_id', Auth::user()->id)->where('is_default', 1)->first();
        return view('checkout', compact('address'));
    }

    public function place_order(Request $request){
        $user_id = Auth::user()->id;
        $address = Address::where('user_id', $user_id)->where('is_default', true)->first();

        if(!$address)
        {   
            $request->validate ([
            'name' => 'required|max:100',
            'phone' => 'required|numeric|digits:10',
            'zip' => 'required|numeric|digits:6',
            'state' => 'required|',
            'city' => 'required|',
            'address' => 'required',
            'locality' => 'required',
            'landmark' => 'required',

        ]);
        
        $address = new Address();
        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->zip = $request->zip;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->locality = $request->locality;
        $address->landmark = $request->landmark;
        $address->country = 'Malaysia';
        $address->user_id = $user_id;
        $address->is_default = true;
        $address->save();
        }

        $this->setCheckoutAmount();

        $order = new Order();
        $order->user_id = $user_id;
        $order->subtotal = Session::get('checkout')['subtotal'];
        $order->discount = Session::get('checkout')['discount'];
        $order->tax = Session::get('checkout')['tax'];
        $order->total = Session::get('checkout')['total'];
        $order->name = $address->name;
        $order->phone = $address->phone;
        $order->locality = $address->locality;
        $order->address = $address->address;
        $order->city = $address->city;
        $order->state  = $address->state;
        $order->country = $address->country;
        $order->landmark = $address->landmark;
        $order->zip = $address->zip;
        $order->save();

        foreach(Cart::instance('cart')->content() as $item){
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->quantity = $item->qty;
            $orderItem->price = $item->price;
            $orderItem->save();
        }

        if($request->mode == "card")
        {
            //
        }elseif($request->mode == "paypal")
        {
            //
        }elseif($request->mode == "cod")
        {
            $transaction = new Transaction();
            $transaction->user_id = $user_id;
            $transaction->order_id = $order->id;
            $transaction->mode = $request->mode;
            $transaction->status = 'pending';
            $transaction->save();

        }

        Cart::instance('cart')->destroy();
        Session::forget('checkout');
        Session::forget('coupon');
        Session::forget('discounts');
        Session::put('order_id', $order->id);
        return view('order-success', compact('order'));
        // return redirect()->route('cart.order_success')->with('success', 'Order placed successfully.');
    }

    public function setCheckoutAmount(){
        if(!Cart::instance('cart')->content()->count() > 0){
            Session::forget('checkout');
            return;
        }
        if(Session::has('coupon')){
            Session::put('checkout', [
                'subtotal' => Session::get('discounts')['subtotal'],
                'discount' => Session::get('discounts')['discount'],
                'tax' => Session::get('discounts')['tax'],
                'total' => Session::get('discounts')['total'],
            ]);
        }else{
            Session::put('checkout', [
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total(),
            ]);
        }
    }

    public function order_success(){
        if(Session::has('order_id')){
            $order = Order::find(Session::get('order_id'));
            return view('order-success', compact('order'));
        }
        return redirect()->route('cart.index')->with('error', 'No order found.');
    }
}