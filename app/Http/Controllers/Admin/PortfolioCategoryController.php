<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;

class PortfolioCategoryController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::orderBy('order')->orderByDesc('id')->paginate(20);
        return view('admin.portfolio_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.portfolio_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_tr' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'status' => 'required|in:active,passive',
        ]);

        PortfolioCategory::create([
            'name_tr' => $validated['name_tr'],
            'name_en' => $validated['name_en'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Kategori oluşturuldu.');
    }

    public function edit(PortfolioCategory $portfolio_category)
    {
        return view('admin.portfolio_categories.edit', ['category' => $portfolio_category]);
    }

    public function update(Request $request, PortfolioCategory $portfolio_category)
    {
        $validated = $request->validate([
            'name_tr' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'status' => 'required|in:active,passive',
        ]);

        $portfolio_category->update([
            'name_tr' => $validated['name_tr'],
            'name_en' => $validated['name_en'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Kategori güncellendi.');
    }

    public function destroy(PortfolioCategory $portfolio_category)
    {
        $portfolio_category->delete();
        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Kategori silindi.');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:portfolio_categories,id'
        ]);

        foreach ($validated['ids'] as $position => $id) {
            PortfolioCategory::where('id', $id)->update(['order' => $position]);
        }

        return response()->json(['status' => 'ok']);
    }
}


