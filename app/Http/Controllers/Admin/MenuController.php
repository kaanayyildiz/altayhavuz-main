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
        ]);

        Menu::create([
            'title_tr' => $validated['title_tr'],
            'title_en' => $validated['title_en'] ?? null,
            'url' => $validated['url'],
            'status' => $validated['status'],
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
        ]);

        $menu->update([
            'title_tr' => $validated['title_tr'],
            'title_en' => $validated['title_en'] ?? null,
            'url' => $validated['url'],
            'status' => $validated['status'],
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
