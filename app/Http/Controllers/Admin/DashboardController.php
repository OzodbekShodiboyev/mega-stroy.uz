<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products'  => Product::count(),
            'orders'    => Order::count(),
            'new_orders'=> Order::where('status', 'new')->count(),
            'messages'  => ContactMessage::where('is_read', false)->count(),
            'users'     => User::where('role', 'user')->count(),
            'revenue'   => Order::where('status', 'completed')->sum('total_price'),
        ];
        $recent_orders   = Order::with('product')->latest()->take(8)->get();
        $recent_messages = ContactMessage::latest()->take(6)->get();
        return view('admin.dashboard', compact('stats', 'recent_orders', 'recent_messages'));
    }
}
