<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(25);
        ContactMessage::where('is_read', false)->update(['is_read' => true]);
        return view('admin.messages.index', compact('messages'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return back()->with('success', 'Xabar o\'chirildi.');
    }
}
