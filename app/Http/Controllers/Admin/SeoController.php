<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Menu;

class SeoController extends Controller
{
    public function edit()
    {
        $seoTitle = Setting::get('seo_title_default', '');
        $seoDescription = Setting::get('seo_description_default', '');
        $seoKeywords = Setting::get('seo_keywords_default', '');
        $ogImage = Setting::get('og_image_default', '');
        $ogTitle = Setting::get('og_title_default', '');
        $ogDescription = Setting::get('og_description_default', '');
        $ogType = Setting::get('og_type_default', 'website');
        $ogSiteName = Setting::get('og_site_name_default', '');

        $menus = Menu::orderBy('order')->orderByDesc('id')->paginate(20);

        return view('admin.seo.edit', compact('seoTitle', 'seoDescription', 'seoKeywords', 'ogImage', 'ogTitle', 'ogDescription', 'ogType', 'ogSiteName', 'menus'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'seo_title_default' => 'nullable|string|max:255',
            'seo_description_default' => 'nullable|string|max:500',
            'seo_keywords_default' => 'nullable|string|max:500',
            'og_image_default' => 'nullable|string|max:2048',
            'og_title_default' => 'nullable|string|max:255',
            'og_description_default' => 'nullable|string|max:500',
            'og_type_default' => 'nullable|string|max:50',
            'og_site_name_default' => 'nullable|string|max:255',
        ]);

        Setting::set('seo_title_default', $validated['seo_title_default'] ?? '');
        Setting::set('seo_description_default', $validated['seo_description_default'] ?? '');
        Setting::set('seo_keywords_default', $validated['seo_keywords_default'] ?? '');
        Setting::set('og_image_default', $validated['og_image_default'] ?? '');
        Setting::set('og_title_default', $validated['og_title_default'] ?? '');
        Setting::set('og_description_default', $validated['og_description_default'] ?? '');
        Setting::set('og_type_default', $validated['og_type_default'] ?? 'website');
        Setting::set('og_site_name_default', $validated['og_site_name_default'] ?? '');

        return redirect()->route('admin.seo.edit')->with('success', 'SEO ayarları güncellendi.');
    }
}


