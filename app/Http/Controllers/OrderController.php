<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name'       => 'required|string|max:100',
            'phone'      => 'required|string',
            'qty'        => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $qty     = (int) $request->qty;
        $total   = $product->price * $qty;

        $order = Order::create([
            'product_id'  => $product->id,
            'user_id'     => Auth::id(),
            'name'        => $request->name,
            'phone'       => preg_replace('/\D/', '', $request->phone),
            'color'       => $request->color,
            'texture'     => $request->texture,
            'qty'         => $qty,
            'unit_price'  => $product->price,
            'total_price' => $total,
            'notes'       => $request->notes,
            'status'      => 'new',
        ]);

        $order->load('product');

        // Telegram notification (non-blocking)
        try {
            app(TelegramService::class)->orderNotification($order);
        } catch (\Throwable) {}

        return response()->json([
            'success'  => true,
            'order_id' => $order->id,
            'message'  => "Buyurtmangiz qabul qilindi! Tez orada +998 99 433 00 47 raqamidan aloqaga chiqamiz.",
        ]);
    }
}
