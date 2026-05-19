<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')->orderBy('name')->get();
        return view('admin.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ], [
            'name.required' => 'Kategori adı zorunludur.',
        ]);

        Category::create($request->only('name', 'parent_id'));

        return redirect()->route('admin.category.index')
                         ->with('success', 'Kategori başarıyla eklendi!');
    }

    public function edit(Category $category)
    {
        $parents = Category::whereNull('parent_id')
                           ->where('id', '!=', $category->id)
                           ->orderBy('name')->get();
        return view('admin.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        // Kendisini üst kategori olarak seçemez
        if ($request->parent_id == $category->id) {
            return back()->withErrors(['parent_id' => 'Kategori kendisinin üst kategorisi olamaz.']);
        }

        $category->update($request->only('name', 'parent_id'));

        return redirect()->route('admin.category.index')
                         ->with('success', 'Kategori güncellendi!');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Bu kategoriye ait ürünler var. Önce ürünleri silin veya taşıyın.');
        }

        $category->delete();

        return redirect()->route('admin.category.index')
                         ->with('success', 'Kategori silindi!');
    }
}
