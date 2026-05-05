<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('sort_order')->get();
        return view('admin.catalog.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_uz'    => 'required|string|max:100',
            'name_ru'    => 'nullable|string|max:100',
            'name_en'    => 'nullable|string|max:100',
            'sort_order' => 'integer|min:0',
            'is_active'  => 'boolean',
        ]);
        $data['slug']      = Str::slug($request->name_uz) . '-' . Str::random(4);
        $data['is_active'] = $request->boolean('is_active', true);
        Category::create($data);
        return back()->with('success', 'Kategoriya qo\'shildi.');
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name_uz'    => 'required|string|max:100',
            'name_ru'    => 'nullable|string|max:100',
            'name_en'    => 'nullable|string|max:100',
            'sort_order' => 'integer|min:0',
            'is_active'  => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $category->update($data);
        return back()->with('success', 'Yangilandi.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'O\'chirildi.');
    }
}
