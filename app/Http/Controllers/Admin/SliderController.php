<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->orderByDesc('id')->paginate(12);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'status' => 'required|in:active,passive',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'title_tr' => $validated['title_tr'],
            'title_en' => $validated['title_en'] ?? null,
            'status' => $validated['status'],
        ];

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('sliders', 'public');
        }

        Slider::create($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider oluşturuldu.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'status' => 'required|in:active,passive',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = [
            'title_tr' => $validated['title_tr'],
            'title_en' => $validated['title_en'] ?? null,
            'status' => $validated['status'],
        ];

        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($slider->image_path && Storage::disk('public')->exists($slider->image_path)) {
                Storage::disk('public')->delete($slider->image_path);
            }
            // Yeni resmi kaydet
            $data['image_path'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider güncellendi.');
    }

    public function destroy(Slider $slider)
    {
        // Slider silinirken resmi de sil
        if ($slider->image_path && Storage::disk('public')->exists($slider->image_path)) {
            Storage::disk('public')->delete($slider->image_path);
        }
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider silindi.');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:sliders,id'
        ]);

        foreach ($validated['ids'] as $position => $id) {
            Slider::where('id', $id)->update(['order' => $position]);
        }

        return response()->json(['status' => 'ok']);
    }
}


