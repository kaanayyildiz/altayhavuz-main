<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->orderByDesc('id')->get();

        return view('admin.home.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $faq = new Faq();

        return view('admin.home.faqs.create', compact('faq'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_tr' => 'required|string|max:255',
            'question_en' => 'nullable|string|max:255',
            'answer_tr' => 'nullable|string',
            'answer_en' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,passive',
        ]);

        $validated['order'] = $validated['order'] ?? (Faq::max('order') + 1);

        Faq::create($validated);

        return redirect()->route('admin.home.faqs.index')->with('success', 'Soru eklendi.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.home.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question_tr' => 'required|string|max:255',
            'question_en' => 'nullable|string|max:255',
            'answer_tr' => 'nullable|string',
            'answer_en' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,passive',
        ]);

        $validated['order'] = $validated['order'] ?? $faq->order;

        $faq->update($validated);

        return redirect()->route('admin.home.faqs.index')->with('success', 'Soru güncellendi.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.home.faqs.index')->with('success', 'Soru silindi.');
    }

    public function reorder(Request $request)
    {
        $data = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:faqs,id',
        ]);

        foreach ($data['ids'] as $index => $id) {
            Faq::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['status' => 'ok']);
    }
}

