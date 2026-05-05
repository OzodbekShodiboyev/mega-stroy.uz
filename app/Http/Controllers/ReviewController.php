<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, string $slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $request->validate([
            'reviewer_name' => 'required|string|max:100',
            'rating'        => 'required|integer|min:1|max:5',
            'body'          => 'required|string|min:10|max:1000',
        ]);

        Review::create([
            'product_id'    => $product->id,
            'reviewer_name' => $request->reviewer_name,
            'rating'        => $request->rating,
            'body'          => $request->body,
            'status'        => 'pending',
        ]);

        return back()->with('review_sent', true)->withFragment('tab-reviews');
    }
}
