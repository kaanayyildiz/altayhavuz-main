@extends('admin.layouts.app')

@section('title', 'Menü Düzenle - Admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Menü Öğesi Düzenle</h1>

    <form action="{{ route('admin.menus.update', $menu) }}" method="POST" class="bg-white border rounded-xl p-6 space-y-5 max-w-2xl">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (TR)</label>
            <input type="text" name="title_tr" value="{{ old('title_tr', $menu->title_tr) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('title_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (EN)</label>
            <input type="text" name="title_en" value="{{ old('title_en', $menu->title_en) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('title_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">URL</label>
            <input type="text" name="url" value="{{ old('url', $menu->url) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('url')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="active" {{ old('status', $menu->status)==='active'?'selected':'' }}>Aktif</option>
                    <option value="passive" {{ old('status', $menu->status)==='passive'?'selected':'' }}>Pasif</option>
                </select>
                @error('status')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.menus.index') }}" class="px-4 py-2 rounded-lg border">İptal</a>
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Güncelle</button>
        </div>
    </form>
@endsection

@extends('admin.layouts.app')

@section('title', 'Menü Düzenle - Admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Menü Düzenle</h1>

    <form action="{{ route('admin.menus.update', $menu) }}" method="POST" class="bg-white border rounded-xl p-6 space-y-5 max-w-2xl">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (TR)</label>
            <input type="text" name="title_tr" value="{{ old('title_tr', $menu->title_tr) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('title_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (EN)</label>
            <input type="text" name="title_en" value="{{ old('title_en', $menu->title_en) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('title_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tip</label>
                <select name="type" x-data @change="document.getElementById('routeFields').classList.toggle('hidden', this.value!=='route');document.getElementById('urlField').classList.toggle('hidden', this.value!=='url');" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="route" {{ old('type', $menu->type)==='route'?'selected':'' }}>Route</option>
                    <option value="url" {{ old('type', $menu->type)==='url'?'selected':'' }}>URL</option>
                </select>
                @error('type')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sıra</label>
                <input type="number" name="order" value="{{ old('order', $menu->order) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('order')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
        <div id="routeFields" class="{{ old('type', $menu->type)==='route' ? '' : 'hidden' }}">
            <label class="block text-sm font-medium text-gray-700 mb-2">Route adı</label>
            <input type="text" name="route_name" value="{{ old('route_name', $menu->route_name) }}" placeholder="ör: home, services, about, contact" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('route_name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div id="urlField" class="{{ old('type', $menu->type)==='url' ? '' : 'hidden' }}">
            <label class="block text-sm font-medium text-gray-700 mb-2">URL</label>
            <input type="url" name="url" value="{{ old('url', $menu->url) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('url')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="active" {{ old('status', $menu->status)==='active'?'selected':'' }}>Aktif</option>
                    <option value="passive" {{ old('status', $menu->status)==='passive'?'selected':'' }}>Pasif</option>
                </select>
                @error('status')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Target</label>
                <select name="target" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="_self" {{ old('target', $menu->target)==='_self'?'selected':'' }}>Aynı sayfa</option>
                    <option value="_blank" {{ old('target', $menu->target)==='_blank'?'selected':'' }}>Yeni sekme</option>
                </select>
                @error('target')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.menus.index') }}" class="px-4 py-2 rounded-lg border">İptal</a>
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Güncelle</button>
        </div>
    </form>
@endsection
