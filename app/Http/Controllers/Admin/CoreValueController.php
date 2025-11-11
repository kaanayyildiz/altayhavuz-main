<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoreValue;
use Illuminate\Http\Request;

class CoreValueController extends Controller
{
    public function index()
    {
        $values = CoreValue::orderBy('order')->orderByDesc('id')->get();

        return view('admin.home.core_values.index', compact('values'));
    }

    public function create()
    {
        $value = new CoreValue();

        return view('admin.home.core_values.create', compact('value'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text_tr' => 'required|string',
            'text_en' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,passive',
        ]);

        $validated['order'] = $validated['order'] ?? (CoreValue::max('order') + 1);

        CoreValue::create($validated);

        return redirect()->route('admin.home.core-values.index')->with('success', 'Değer eklendi.');
    }

    public function edit(CoreValue $core_value)
    {
        return view('admin.home.core_values.edit', ['value' => $core_value]);
    }

    public function update(Request $request, CoreValue $core_value)
    {
        $validated = $request->validate([
            'text_tr' => 'required|string',
            'text_en' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,passive',
        ]);

        $validated['order'] = $validated['order'] ?? $core_value->order;

        $core_value->update($validated);

        return redirect()->route('admin.home.core-values.index')->with('success', 'Değer güncellendi.');
    }

    public function destroy(CoreValue $core_value)
    {
        $core_value->delete();

        return redirect()->route('admin.home.core-values.index')->with('success', 'Değer silindi.');
    }

    public function reorder(Request $request)
    {
        $data = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:core_values,id',
        ]);

        foreach ($data['ids'] as $index => $id) {
            CoreValue::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['status' => 'ok']);
    }
}

