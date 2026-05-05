<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::with(['colors', 'textures', 'categoryRel', 'unitRel'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedQuery = Product::with(['categoryRel', 'unitRel'])
            ->active()
            ->where('id', '!=', $product->id);

        // Match by category_id first, fall back to category string
        if ($product->category_id) {
            $related = (clone $relatedQuery)->where('category_id', $product->category_id)->take(4)->get();
        } elseif ($product->category) {
            $related = (clone $relatedQuery)->where('category', $product->category)->take(4)->get();
        } else {
            $related = collect();
        }

        if ($related->count() < 4) {
            $extra = $relatedQuery
                ->whereNotIn('id', $related->pluck('id'))
                ->take(4 - $related->count())
                ->get();
            $related = $related->merge($extra);
        }

        $reviews = Review::where('product_id', $product->id)
            ->approved()
            ->latest()
            ->get();

        return view('products.show', compact('product', 'related', 'reviews'));
    }
}
