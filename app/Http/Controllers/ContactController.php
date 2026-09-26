<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|max:20',
            'email' => 'nullable|email|max:255',
            'content' => 'required',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi lại trong thời gian sớm nhất.');
    }
}
