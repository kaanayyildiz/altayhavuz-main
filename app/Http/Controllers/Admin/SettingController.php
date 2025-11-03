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
        return view('admin.settings.edit', compact('appName', 'locale'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'locale' => 'required|in:tr,en',
        ]);

        Setting::set('app_name', $validated['app_name']);
        Setting::set('locale', $validated['locale']);

        return redirect()->route('admin.settings.edit')->with('success', 'Ayarlar güncellendi.');
    }
}





