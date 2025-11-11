@extends('admin.layouts.app')

@section('title', 'Misyon & Vizyon - Admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Misyon & Vizyon İçeriği</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-sm text-blue-600 hover:underline">← Dashboard</a>
    </div>

    <form action="{{ route('admin.home.mission.update') }}" method="POST" class="bg-white border rounded-xl p-6 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Üst Başlık (TR)</label>
                <input type="text" name="tagline_tr" value="{{ old('tagline_tr', $content->tagline_tr) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('tagline_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Üst Başlık (EN)</label>
                <input type="text" name="tagline_en" value="{{ old('tagline_en', $content->tagline_en) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('tagline_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Misyon Başlığı (TR)</label>
                    <input type="text" name="mission_title_tr" value="{{ old('mission_title_tr', $content->mission_title_tr) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('mission_title_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Misyon Başlığı (EN)</label>
                    <input type="text" name="mission_title_en" value="{{ old('mission_title_en', $content->mission_title_en) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('mission_title_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Misyon Açıklaması (TR)</label>
                    <textarea name="mission_description_tr" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('mission_description_tr', $content->mission_description_tr) }}</textarea>
                    @error('mission_description_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Misyon Açıklaması (EN)</label>
                    <textarea name="mission_description_en" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('mission_description_en', $content->mission_description_en) }}</textarea>
                    @error('mission_description_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Vizyon Başlığı (TR)</label>
                    <input type="text" name="vision_title_tr" value="{{ old('vision_title_tr', $content->vision_title_tr) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('vision_title_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Vizyon Başlığı (EN)</label>
                    <input type="text" name="vision_title_en" value="{{ old('vision_title_en', $content->vision_title_en) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('vision_title_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Vizyon Açıklaması (TR)</label>
                    <textarea name="vision_description_tr" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('vision_description_tr', $content->vision_description_tr) }}</textarea>
                    @error('vision_description_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Vizyon Açıklaması (EN)</label>
                    <textarea name="vision_description_en" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('vision_description_en', $content->vision_description_en) }}</textarea>
                    @error('vision_description_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Kaydet</button>
        </div>
    </form>
@endsection

