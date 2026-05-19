<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Anasayfa
    public function index()
    {
        $featured   = Product::with('category')->where('status', 1)->latest()->take(8)->get();
        $categories = Category::whereNull('parent_id')->withCount('products')->get();
        return view('shop.index', compact('featured', 'categories'));
    }

    // Ürün listesi / Kategori filtresi
    public function products(Request $request = null)
    {
        $query = Product::with('category')->where('status', 1);

        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        if (request('q')) {
            $q = request('q');
            $query->where(function ($q2) use ($q) {
                $q2->where('title', 'like', "%$q%")
                   ->orWhere('description', 'like', "%$q%")
                   ->orWhere('keywords', 'like', "%$q%");
            });
        }

        $products   = $query->latest()->paginate(12);
        $categories = Category::whereNull('parent_id')->get();

        return view('shop.products', compact('products', 'categories'));
    }

    // Ürün detayı
    public function show(Product $product)
    {
        if (!$product->status) {
            abort(404);
        }
        $product->load('category.parent.parent');
        $related = Product::where('category_id', $product->category_id)
                          ->where('id', '!=', $product->id)
                          ->where('status', 1)
                          ->take(4)->get();
        return view('shop.show', compact('product', 'related'));
    }

    // Kategoriye göre ürünler
    public function category(Category $category)
    {
        $products = Product::with('category')
                           ->where('category_id', $category->id)
                           ->where('status', 1)
                           ->latest()->paginate(12);
        return view('shop.category', compact('category', 'products'));
    }
}
