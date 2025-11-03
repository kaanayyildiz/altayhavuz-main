@extends('admin.layouts.app')

@section('title', 'Yeni Yazı - Admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Yeni Yazı</h1>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border rounded-xl p-6 space-y-5 max-w-3xl">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (TR)</label>
                <input type="text" name="title_tr" value="{{ old('title_tr') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('title_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (EN)</label>
                <input type="text" name="title_en" value="{{ old('title_en') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('title_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
            <input type="text" name="slug" value="{{ old('slug') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="otomatik üretilecek">
            @error('slug')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">İçerik (TR)</label>
            <textarea name="content_tr" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('content_tr') }}</textarea>
            @error('content_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">İçerik (EN)</label>
            <textarea name="content_en" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('content_en') }}</textarea>
            @error('content_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="draft" {{ old('status')==='draft'?'selected':'' }}>Taslak</option>
                    <option value="published" {{ old('status')==='published'?'selected':'' }}>Yayınlandı</option>
                </select>
                @error('status')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kapak Görseli</label>
                <input type="file" name="featured_image" accept="image/*" class="w-full">
                @error('featured_image')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 rounded-lg border">İptal</a>
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Kaydet</button>
        </div>
    </form>
@endsection





