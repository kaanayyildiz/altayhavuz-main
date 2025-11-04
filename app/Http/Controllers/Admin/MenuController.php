<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('order')->orderByDesc('id')->paginate(20);
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required|in:active,passive',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|string|max:500',
            'og_image' => 'nullable|string|max:2048',
        ]);

        Menu::create([
            'title_tr' => $validated['title_tr'],
            'title_en' => $validated['title_en'] ?? null,
            'url' => $validated['url'],
            'status' => $validated['status'],
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
            'seo_keywords' => $validated['seo_keywords'] ?? null,
            'og_image' => $validated['og_image'] ?? null,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menü öğesi oluşturuldu.');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'url' => 'required|string|max:255',
            'status' => 'required|in:active,passive',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'seo_keywords' => 'nullable|string|max:500',
            'og_image' => 'nullable|string|max:2048',
        ]);

        $menu->update([
            'title_tr' => $validated['title_tr'],
            'title_en' => $validated['title_en'] ?? null,
            'url' => $validated['url'],
            'status' => $validated['status'],
            'seo_title' => $validated['seo_title'] ?? null,
            'seo_description' => $validated['seo_description'] ?? null,
            'seo_keywords' => $validated['seo_keywords'] ?? null,
            'og_image' => $validated['og_image'] ?? null,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menü öğesi güncellendi.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menü öğesi silindi.');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:menus,id'
        ]);

        foreach ($validated['ids'] as $position => $id) {
            Menu::where('id', $id)->update(['order' => $position]);
        }

        return response()->json(['status' => 'ok']);
    }
}
