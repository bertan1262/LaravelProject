<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    // Tüm ürünleri listele
    public function index()
    {
        $products = Product::with(['category.parent.parent.parent', 'user'])->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // Ürün ekleme formu — kategorileri üst kategorileriyle çek
    public function create()
    {
        $categories = Category::with('parent.parent.parent')->get();
        return view('admin.products.create', compact('categories'));
    }

    // Ürünü kaydet
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'keywords'    => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'detail'      => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'minstock'    => 'required|integer|min:0',
            'discount'    => 'required|integer|min:0|max:100',
            'status'      => 'required|in:0,1',
        ], [
            'category_id.required' => 'Kategori seçimi zorunludur.',
            'title.required'       => 'Ürün adı zorunludur.',
            'price.required'       => 'Fiyat zorunludur.',
            'price.numeric'        => 'Fiyat sayısal olmalıdır.',
            'stock.required'       => 'Stok miktarı zorunludur.',
            'image.image'          => 'Geçerli bir resim dosyası yükleyin.',
            'image.max'            => 'Resim en fazla 2MB olabilir.',
            'discount.max'         => 'İndirim en fazla %100 olabilir.',
        ]);

        $data = $request->except('image');

        // Resim yükleme
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Geçici olarak user_id = 1
        $data['user_id'] = 1;

        Product::create($data);

        return redirect()->route('admin.product.index')
                         ->with('success', 'Ürün başarıyla eklendi!');
    }

    // Ürün detayı — tam kategori yolunu eager loading ile yükle
    public function show(Product $product)
    {
        $product->load('category.parent.parent.parent', 'user');
        return view('admin.products.show', compact('product'));
    }

    // Düzenleme formu
    public function edit(Product $product)
    {
        $categories = Category::with('parent.parent.parent')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Güncelle
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'keywords'    => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'detail'      => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'minstock'    => 'required|integer|min:0',
            'discount'    => 'required|integer|min:0|max:100',
            'status'      => 'required|in:0,1',
        ]);

        $data = $request->except('image');

        // Yeni resim yüklendiyse eskisini sil ve değiştir
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.product.index')
                         ->with('success', 'Ürün başarıyla güncellendi!');
    }

    // Sil
    public function destroy(Product $product)
    {
        // Resmi de sil
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.product.index')
                         ->with('success', 'Ürün başarıyla silindi!');
    }
}
