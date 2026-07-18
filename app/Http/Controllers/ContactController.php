<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // TODO: Send email notification to admin
        // Mail::to('admin@twostryve.id')->send(new ContactFormMail($request->all()));

        return back()->with('success', 'Pesan berhasil dikirim! Kami akan segera merespons.');
    }
}
