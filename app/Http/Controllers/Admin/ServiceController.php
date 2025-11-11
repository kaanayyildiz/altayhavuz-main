<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->orderByDesc('id')->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $service = new Service();

        return view('admin.services.create', compact('service'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_tr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'features_tr' => 'nullable|string',
            'features_en' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,passive',
            'show_on_home' => 'nullable|boolean',
        ]);

        $validated['order'] = $validated['order'] ?? (Service::max('order') + 1);
        $validated['show_on_home'] = $request->has('show_on_home') ? $request->boolean('show_on_home') : true;

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Hizmet oluşturuldu.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title_tr' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_tr' => 'nullable|string',
            'description_en' => 'nullable|string',
            'features_tr' => 'nullable|string',
            'features_en' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,passive',
            'show_on_home' => 'nullable|boolean',
        ]);

        $validated['order'] = $validated['order'] ?? $service->order;
        $validated['show_on_home'] = $request->boolean('show_on_home');

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Hizmet güncellendi.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Hizmet silindi.');
    }

    public function reorder(Request $request)
    {
        $data = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:services,id',
        ]);

        foreach ($data['ids'] as $index => $id) {
            Service::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['status' => 'ok']);
    }
}

