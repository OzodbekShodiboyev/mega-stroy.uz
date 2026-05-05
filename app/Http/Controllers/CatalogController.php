<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->with(['categoryRel', 'unitRel'])
            ->withCount(['reviews' => fn($q) => $q->where('status', 'approved')]);

        if ($request->filled('cat')) {
            $query->where('category', $request->cat);
        }
        if ($request->filled('min')) {
            $query->where('price', '>=', (int) $request->min);
        }
        if ($request->filled('max')) {
            $query->where('price', '<=', (int) $request->max);
        }
        if ($request->filled('color')) {
            $query->whereHas('colors', fn($q) => $q->where('colors.id', (int) $request->color));
        }

        $products   = $query->paginate(16)->withQueryString();
        $categories = Category::orderBy('sort_order')->orderBy('name_uz')->get();
        $colors     = Color::active()->whereHas('products', fn($q) => $q->where('is_active', true))->get();
        $minPrice   = Product::active()->min('price') ?? 0;
        $maxPrice   = Product::active()->max('price') ?? 9999999;

        return view('catalog.index', compact('products', 'categories', 'colors', 'minPrice', 'maxPrice'));
    }
}
