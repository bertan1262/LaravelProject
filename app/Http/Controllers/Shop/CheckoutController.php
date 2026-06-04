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
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email|max:255',
            'shipping_address' => 'required|string|max:1000',
            'card_name'        => 'required|string|max:255',
            'card_number'      => ['required', 'regex:/^\d{4}\s?\d{4}\s?\d{4}\s?\d{4}$/'],
            'card_expiry'      => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'card_cvc'         => ['required', 'regex:/^\d{3,4}$/'],
        ], [
            'card_number.regex'  => 'Kart numarası 16 haneli olmalıdır (örn: 4111 1111 1111 1111).',
            'card_expiry.regex'  => 'Son kullanma tarihi AA/YY formatında olmalıdır (örn: 12/26).',
            'card_cvc.regex'     => 'CVC 3 veya 4 haneli olmalıdır.',
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
