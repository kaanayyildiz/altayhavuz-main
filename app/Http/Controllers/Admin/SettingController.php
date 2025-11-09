<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $appName = Setting::get('app_name', config('app.name'));
        $locale = Setting::get('locale', config('app.locale'));
        $instagramUrl = Setting::get('instagram_url', '');
        $youtubeUrl = Setting::get('youtube_url', '');
        $googleAnalyticsId = Setting::get('google_analytics_id', '');
        return view('admin.settings.edit', compact('appName', 'locale', 'instagramUrl', 'youtubeUrl', 'googleAnalyticsId'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'locale' => 'required|in:tr,en',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'google_analytics_id' => 'nullable|string|max:255',
        ]);

        Setting::set('app_name', $validated['app_name']);
        Setting::set('locale', $validated['locale']);
        Setting::set('instagram_url', $validated['instagram_url'] ?? '');
        Setting::set('youtube_url', $validated['youtube_url'] ?? '');
        Setting::set('google_analytics_id', $validated['google_analytics_id'] ?? '');

        return redirect()->route('admin.settings.edit')->with('success', 'Ayarlar güncellendi.');
    }
}





