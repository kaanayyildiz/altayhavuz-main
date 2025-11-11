<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Service;
use App\Models\WhyChooseUsItem;
use App\Models\CoreValue;
use App\Models\Faq;
use App\Models\HomeMissionVision;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 'active')->orderBy('order')->orderByDesc('id')->get();
        $portfolios = Portfolio::where('status', 'active')->orderBy('order')->orderByDesc('id')->limit(12)->get();
        $portfolioCategories = PortfolioCategory::where('status','active')->orderBy('order')->orderByDesc('id')->get();
        $services = Service::where('status', 'active')->orderBy('order')->orderByDesc('id')->get();
        $whyChooseUsItems = WhyChooseUsItem::where('status', 'active')->orderBy('order')->orderByDesc('id')->get();
        $coreValues = CoreValue::where('status', 'active')->orderBy('order')->orderByDesc('id')->get();
        $faqs = Faq::where('status', 'active')->orderBy('order')->orderByDesc('id')->get();
        $missionVision = HomeMissionVision::singleton();

        return view('home', compact(
            'sliders',
            'portfolios',
            'portfolioCategories',
            'services',
            'whyChooseUsItems',
            'coreValues',
            'faqs',
            'missionVision'
        ));
    }
}

