@extends('admin.layouts.app')

@section('title', 'Ayarlar - Admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Genel Ayarlar</h1>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="bg-white border rounded-xl p-6 space-y-5 max-w-xl">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Site Adı</label>
            <input type="text" name="app_name" value="{{ old('app_name', $appName) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('app_name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Varsayılan Dil</label>
            <select name="locale" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="tr" {{ old('locale', $locale)==='tr'?'selected':'' }}>Türkçe</option>
                <option value="en" {{ old('locale', $locale)==='en'?'selected':'' }}>English</option>
            </select>
            @error('locale')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        
        <div class="border-t pt-5">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Sosyal Medya</h2>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $instagramUrl) }}" placeholder="https://instagram.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('instagram_url')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Youtube URL</label>
                    <input type="url" name="youtube_url" value="{{ old('youtube_url', $youtubeUrl) }}" placeholder="https://youtube.com/..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('youtube_url')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        
        <div class="border-t pt-5">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Google Analytics</h2>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Google Analytics ID (G-XXXXXXXXXX)</label>
                <input type="text" name="google_analytics_id" value="{{ old('google_analytics_id', $googleAnalyticsId) }}" placeholder="G-XXXXXXXXXX" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="text-xs text-gray-500 mt-1">Google Analytics 4 (GA4) Measurement ID'nizi buraya girin.</p>
                @error('google_analytics_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
        
        <div class="flex items-center gap-3">
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Kaydet</button>
        </div>
    </form>
@endsection





