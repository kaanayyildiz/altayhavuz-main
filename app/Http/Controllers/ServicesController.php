<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 'active')->orderBy('order')->orderByDesc('id')->get();

        return view('services', compact('services'));
    }
}

