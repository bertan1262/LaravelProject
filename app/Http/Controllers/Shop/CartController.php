<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function($item) { 
            return $item['price'] * $item['quantity']; 
        }, $cart));
        
        return view('shop.cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->title,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Ürün sepete eklendi!');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Sepet güncellendi');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Ürün sepetten çıkarıldı');
        }
    }
}
