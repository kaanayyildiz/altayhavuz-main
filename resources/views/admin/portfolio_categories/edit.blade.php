@extends('admin.layouts.app')

@section('title', 'Kategori Düzenle - Admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Kategori Düzenle</h1>

    <form action="{{ route('admin.portfolio-categories.update', $category) }}" method="POST" class="bg-white border rounded-xl p-6 space-y-5 max-w-2xl">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ad (TR)</label>
                <input type="text" name="name_tr" value="{{ old('name_tr', $category->name_tr) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('name_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ad (EN)</label>
                <input type="text" name="name_en" value="{{ old('name_en', $category->name_en) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('name_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="active" {{ old('status', $category->status)==='active'?'selected':'' }}>Aktif</option>
                <option value="passive" {{ old('status', $category->status)==='passive'?'selected':'' }}>Pasif</option>
            </select>
            @error('status')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.portfolio-categories.index') }}" class="px-4 py-2 rounded-lg border">İptal</a>
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Güncelle</button>
        </div>
    </form>
@endsection


