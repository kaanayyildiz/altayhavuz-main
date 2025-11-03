<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:1000',
        ]);
        
        // Here you would typically save to database or send email
        // For now, we'll just redirect back with success message
        
        return redirect()->route('contact')->with('success', __('messages.form_success'));
    }
}

