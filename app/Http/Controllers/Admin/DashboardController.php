<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'today_unique_visitors' => Visitor::getTodayUniqueVisitors(),
            'today_total_visits' => Visitor::getTodayTotalVisits(),
            'total_unique_visitors' => Visitor::getTotalUniqueVisitors(),
            'total_visits' => Visitor::getTotalVisits(),
            'last_7_days_visitors' => Visitor::getLast7DaysVisitors(),
            'last_7_days_visits' => Visitor::getLast7DaysVisits(),
        ];

        // Son ziyaretçileri sayfalı olarak getir
        $recentVisitors = Visitor::orderBy('visited_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Google Analytics ID
        $googleAnalyticsId = Setting::get('google_analytics_id', '');

        return view('admin.dashboard', compact('stats', 'recentVisitors', 'googleAnalyticsId'));
    }
}





