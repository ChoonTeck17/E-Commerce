<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

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

}