<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $pending  = Review::with('product')->where('status', 'pending')->latest()->get();
        $approved = Review::with('product')->where('status', 'approved')->latest()->paginate(20);
        return view('admin.reviews.index', compact('pending', 'approved'));
    }

    public function approve(Review $review)
    {
        $review->update(['status' => 'approved']);
        return back()->with('success', 'Sharh tasdiqlandi.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Sharh o\'chirildi.');
    }
}
