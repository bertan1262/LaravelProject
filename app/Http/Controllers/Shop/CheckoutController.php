<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if(empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Sepetiniz boş.');
        }
        $total = array_sum(array_map(function($item) { 
            return $item['price'] * $item['quantity']; 
        }, $cart));
        
        return view('shop.checkout.index', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'shipping_address' => 'required',
            'card_name' => 'required',
            'card_number' => 'required',
            'card_expiry' => 'required',
            'card_cvc' => 'required'
        ]);

        $cart = session()->get('cart', []);
        if(empty($cart)) return redirect()->route('shop.index');

        $total = array_sum(array_map(function($item) { 
            return $item['price'] * $item['quantity']; 
        }, $cart));

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'shipping_address' => $request->shipping_address,
            'total_amount' => $total,
            'status' => 'Sipariş Alındı'
        ]);

        foreach($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'product_name' => $details['name'],
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);
        }

        session()->forget('cart');

        return redirect()->route('shop.checkout.success');
    }

    public function success()
    {
        return view('shop.checkout.success');
    }
}
