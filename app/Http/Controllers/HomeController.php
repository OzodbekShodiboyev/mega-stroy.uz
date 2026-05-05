<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Work;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::active()
            ->with(['categoryRel'])
            ->withCount(['reviews' => fn($q) => $q->where('status', 'approved')])
            ->take(8)->get();
        $works = Work::orderBy('sort_order')->orderBy('id')->get();
        return view('welcome', compact('products', 'works'));
    }
}
