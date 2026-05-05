<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'phone' => 'required|string',
        ]);

        ContactMessage::create([
            'name'         => $request->name,
            'phone'        => preg_replace('/\D/', '', $request->phone),
            'product_type' => $request->product_type,
            'message'      => $request->message,
        ]);

        return response()->json(['success' => true, 'message' => 'So\'rovingiz qabul qilindi! Tez orada aloqaga chiqamiz.']);
    }
}
