<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

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
}