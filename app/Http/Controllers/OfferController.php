<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:255'],
            'service' => ['nullable', 'string', 'max:100'],
        ]);

        Offer::create($validated);

        return back()->with('success', 'Talebiniz alındı. En kısa sürede sizinle iletişime geçeceğiz.');
    }
}


