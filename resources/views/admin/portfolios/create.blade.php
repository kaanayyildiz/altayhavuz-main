@extends('admin.layouts.app')

@section('title', 'Yeni Portfolyo - Admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Yeni Portfolyo</h1>

    <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="bg-white border rounded-xl p-6 space-y-5 max-w-2xl">
        @csrf
        <div x-data="{fileName: '', preview: '', onChange(e){ const f=e.target.files[0]; if(!f) { this.fileName=''; this.preview=''; return;} this.fileName=f.name; if(f.type.startsWith('image/')) { this.preview = URL.createObjectURL(f); } } }">
            <label class="block text-sm font-medium text-gray-700 mb-2">Görsel</label>
            <label class="relative flex flex-col items-center justify-center w-full border-2 border-dashed rounded-xl p-6 cursor-pointer transition bg-white hover:bg-slate-50 border-slate-300 hover:border-blue-400">
                <div class="text-center">
                    <div class="mx-auto mb-3 w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <div class="text-sm text-gray-700"><span class="font-semibold text-blue-700">Yüklemek için tıkla</span> veya sürükleyip bırak</div>
                    <div class="text-xs text-gray-500 mt-1">PNG, JPG (max 4MB)</div>
                </div>
                <input type="file" name="image" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="onChange($event)">
            </label>
            <template x-if="fileName">
                <div class="mt-3 flex items-center gap-3">
                    <div class="w-20 h-14 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                        <template x-if="preview">
                            <img :src="preview" alt="preview" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!preview">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1-1a2 2 0 012.828 0L20 14M7 8h10M7 12h4"/></svg>
                        </template>
                    </div>
                    <div class="min-w-0">
                        <div class="text-sm font-medium text-gray-800 truncate" x-text="fileName"></div>
                        <div class="text-xs text-gray-500">Seçildi</div>
                    </div>
                </div>
            </template>
            @error('image')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (TR)</label>
                <input type="text" name="title_tr" value="{{ old('title_tr') }}" placeholder="Örn: Villa Havuzu" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('title_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (EN)</label>
                <input type="text" name="title_en" value="{{ old('title_en') }}" placeholder="e.g., Villa Pool" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('title_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="portfolio_category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @php($cats = \App\Models\PortfolioCategory::where('status','active')->orderBy('order')->orderByDesc('id')->get())
                    @foreach($cats as $cat)
                        <option value="{{ $cat->id }}" {{ old('portfolio_category_id')==$cat->id?'selected':'' }}>{{ app()->getLocale()==='tr' ? $cat->name_tr : ($cat->name_en ?? $cat->name_tr) }}</option>
                    @endforeach
                </select>
                @error('portfolio_category_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Durum</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="active">Aktif</option>
                    <option value="passive">Pasif</option>
                </select>
                @error('status')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.portfolios.index') }}" class="px-4 py-2 rounded-lg border">İptal</a>
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Kaydet</button>
        </div>
    </form>
@endsection


