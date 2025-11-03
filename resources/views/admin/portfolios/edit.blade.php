@extends('admin.layouts.app')

@section('title', 'Portfolyo Düzenle - Admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Portfolyo Düzenle</h1>

    <form action="{{ route('admin.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data" class="bg-white border rounded-xl p-6 space-y-5 max-w-2xl">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Mevcut Görsel</label>
            <img src="{{ asset('storage/'.$portfolio->image_path) }}" class="h-24 w-40 object-cover rounded mb-2">
            <input type="file" name="image" accept="image/*" class="w-full">
            @error('image')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tür</label>
                <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="open" {{ old('type', $portfolio->type)==='open'?'selected':'' }}>Açık Havuz</option>
                    <option value="closed" {{ old('type', $portfolio->type)==='closed'?'selected':'' }}>Kapalı Havuz</option>
                </select>
                @error('type')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="active" {{ old('status', $portfolio->status)==='active'?'selected':'' }}>Aktif</option>
                    <option value="passive" {{ old('status', $portfolio->status)==='passive'?'selected':'' }}>Pasif</option>
                </select>
                @error('status')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.portfolios.index') }}" class="px-4 py-2 rounded-lg border">İptal</a>
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Güncelle</button>
        </div>
    </form>
@endsection


