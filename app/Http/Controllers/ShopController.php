<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request){
        $size = $request->query('size') ? $request->query('size') : 12;
        $order = $request->query('order') ? $request->query('order') : -1;
        $o_column ="";
        $o_order = "";
        switch($order)
        {
            case 1;
                $o_column = "created_at";
                $o_order = "DESC";
                break;
            case 2;
                $o_column = "created_at";
                $o_order = "ASC";
                break;
            case 3;
                $o_column = "normal_price";
                $o_order = "ASC";
                break;
            case 4;
                $o_column = "normal_price";
                $o_order = "DESC";
                break;
            default:
                $o_column = "id";
                $o_order = "DESC";
        }
        $products = Product::orderBy($o_column, $o_order)->paginate(12);
        return view('shop', compact('products','size', 'order'));
    }

    public function product_details($product_slug){
        $product = Product::where('slug', $product_slug)->first();
        $rproducts = Product::where('slug','<>', $product_slug)->take(2)->get();
        return view('details', compact('product', 'rproducts'));
    }
}
