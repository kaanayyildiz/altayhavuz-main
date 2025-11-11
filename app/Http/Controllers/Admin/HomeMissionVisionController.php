<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeMissionVision;
use Illuminate\Http\Request;

class HomeMissionVisionController extends Controller
{
    public function edit()
    {
        $content = HomeMissionVision::singleton();

        return view('admin.home.mission_vision.edit', compact('content'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'tagline_tr' => 'nullable|string|max:255',
            'tagline_en' => 'nullable|string|max:255',
            'mission_title_tr' => 'nullable|string|max:255',
            'mission_title_en' => 'nullable|string|max:255',
            'mission_description_tr' => 'nullable|string',
            'mission_description_en' => 'nullable|string',
            'vision_title_tr' => 'nullable|string|max:255',
            'vision_title_en' => 'nullable|string|max:255',
            'vision_description_tr' => 'nullable|string',
            'vision_description_en' => 'nullable|string',
        ]);

        HomeMissionVision::singleton()->update($validated);

        return redirect()->route('admin.home.mission.edit')->with('success', 'Misyon & vizyon içerikleri güncellendi.');
    }
}

