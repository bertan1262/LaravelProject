<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products'  => Product::count(),
            'active_products' => Product::where('status', 1)->count(),
            'total_categories'=> Category::count(),
            'total_users'     => User::count(),
            'low_stock'       => Product::whereColumn('stock', '<=', 'minstock')
                                        ->where('minstock', '>', 0)->count(),
            'no_stock'        => Product::where('stock', 0)->count(),
        ];

        $latest_products  = Product::with('category')->latest()->take(5)->get();
        $low_stock_products = Product::with('category')
                                     ->whereColumn('stock', '<=', 'minstock')
                                     ->where('minstock', '>', 0)
                                     ->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latest_products', 'low_stock_products'));
    }
}
