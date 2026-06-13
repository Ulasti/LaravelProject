<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $data = Message::latest()->get();
        return view('admin.message.index', compact('data'));
    }

    public function show(Message $message)
    {
        return view('admin.message.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.message.index')->with('success', 'Message deleted successfully.');
    }
}
