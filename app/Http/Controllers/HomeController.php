<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Portfolio;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 'active')->orderBy('order')->orderByDesc('id')->get();
        $portfolios = Portfolio::where('status', 'active')->orderBy('order')->orderByDesc('id')->limit(12)->get();
        return view('home', compact('sliders', 'portfolios'));
    }
}

