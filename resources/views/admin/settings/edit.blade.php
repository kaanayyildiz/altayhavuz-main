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
        <div class="flex items-center gap-3">
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Kaydet</button>
        </div>
    </form>
@endsection





