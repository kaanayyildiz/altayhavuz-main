<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('order')->orderByDesc('id')->paginate(16);
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_tr' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'type' => 'required|in:open,closed',
            'status' => 'required|in:active,passive',
            'image' => 'required|image|max:4096',
        ]);

        $data = [
            'title_tr' => $validated['title_tr'] ?? null,
            'title_en' => $validated['title_en'] ?? null,
            'type' => $validated['type'],
            'status' => $validated['status'],
        ];

        $data['image_path'] = $request->file('image')->store('portfolios', 'public');

        Portfolio::create($data);
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio öğesi oluşturuldu.');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title_tr' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'type' => 'required|in:open,closed',
            'status' => 'required|in:active,passive',
            'image' => 'nullable|image|max:4096',
        ]);

        $data = [
            'title_tr' => $validated['title_tr'] ?? null,
            'title_en' => $validated['title_en'] ?? null,
            'type' => $validated['type'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('portfolios', 'public');
        }

        $portfolio->update($data);
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio öğesi güncellendi.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio öğesi silindi.');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:portfolios,id'
        ]);

        foreach ($validated['ids'] as $position => $id) {
            Portfolio::where('id', $id)->update(['order' => $position]);
        }

        return response()->json(['status' => 'ok']);
    }
}


