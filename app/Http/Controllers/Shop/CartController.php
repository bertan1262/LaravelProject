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
            // İndirimli fiyat varsa onu kullan
            $price = $product->discount > 0 ? $product->discounted_price : $product->price;
            $cart[$product->id] = [
                'name'     => $product->title,
                'quantity' => 1,
                'price'    => $price,
                'image'    => $product->image ?? null,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Ürün sepete eklendi!');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        if ($request->id && isset($cart[$request->id])) {
            $qty = (int) $request->quantity;
            if ($qty < 1) {
                // 0 veya negatif adet girilirse ürünü sil
                unset($cart[$request->id]);
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Ürün sepetten çıkarıldı.');
            }
            $cart[$request->id]['quantity'] = $qty;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Sepet güncellendi.');
        }
        return redirect()->back();
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
