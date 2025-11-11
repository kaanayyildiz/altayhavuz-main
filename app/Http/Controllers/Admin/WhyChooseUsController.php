<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseUsItem;
use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{
    public function index()
    {
        $items = WhyChooseUsItem::orderBy('order')->orderByDesc('id')->get();

        return view('admin.home.why_choose_us.index', compact('items'));
    }

    public function create()
    {
        $item = new WhyChooseUsItem();
        $iconOptions = WhyChooseUsItem::iconOptions();

        return view('admin.home.why_choose_us.create', compact('item', 'iconOptions'));
    }

    public function store(Request $request)
    {
        $iconKeys = implode(',', array_keys(WhyChooseUsItem::iconOptions()));

        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_tr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon' => "required|string|in:{$iconKeys}",
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,passive',
        ]);

        $validated['order'] = $validated['order'] ?? (WhyChooseUsItem::max('order') + 1);

        WhyChooseUsItem::create($validated);

        return redirect()->route('admin.home.why.index')->with('success', 'Öne çıkan özellik eklendi.');
    }

    public function edit(WhyChooseUsItem $why)
    {
        $iconOptions = WhyChooseUsItem::iconOptions();

        return view('admin.home.why_choose_us.edit', [
            'item' => $why,
            'iconOptions' => $iconOptions,
        ]);
    }

    public function update(Request $request, WhyChooseUsItem $why)
    {
        $iconKeys = implode(',', array_keys(WhyChooseUsItem::iconOptions()));

        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_tr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon' => "required|string|in:{$iconKeys}",
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,passive',
        ]);

        $validated['order'] = $validated['order'] ?? $why->order;

        $why->update($validated);

        return redirect()->route('admin.home.why.index')->with('success', 'Öne çıkan özellik güncellendi.');
    }

    public function destroy(WhyChooseUsItem $why)
    {
        $why->delete();

        return redirect()->route('admin.home.why.index')->with('success', 'Öne çıkan özellik silindi.');
    }

    public function reorder(Request $request)
    {
        $data = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:why_choose_us_items,id',
        ]);

        foreach ($data['ids'] as $index => $id) {
            WhyChooseUsItem::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['status' => 'ok']);
    }
}

