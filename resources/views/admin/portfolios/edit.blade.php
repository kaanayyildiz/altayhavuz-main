@extends('admin.layouts.app')

@section('title', 'Portfolyo Düzenle - Admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Portfolyo Düzenle</h1>

    <form action="{{ route('admin.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data" class="bg-white border rounded-xl p-6 space-y-5 max-w-2xl">
        @csrf
        @method('PUT')
        <div x-data="{fileName: '', preview: '', onChange(e){ const f=e.target.files[0]; if(!f) { this.fileName=''; this.preview=''; return;} this.fileName=f.name; if(f.type.startsWith('image/')) { this.preview = URL.createObjectURL(f); } } }">
            <label class="block text-sm font-medium text-gray-700 mb-2">Mevcut Görsel</label>
            <div class="flex items-start gap-4">
                <div class="w-[160px] h-[96px] bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                    <template x-if="preview">
                        <img :src="preview" alt="preview" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!preview">
                        <img src="{{ asset('storage/'.$portfolio->image_path) }}" class="w-full h-full object-cover">
                    </template>
                </div>
                <div class="flex-1">
                    <label class="relative flex flex-col items-center justify-center w-full border-2 border-dashed rounded-xl p-4 cursor-pointer transition bg-white hover:bg-slate-50 border-slate-300 hover:border-blue-400">
                        <div class="text-center">
                            <div class="mx-auto mb-2 w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </div>
                            <div class="text-sm text-gray-700"><span class="font-semibold text-blue-700">Yeni görsel seç</span> veya sürükleyip bırak</div>
                            <div class="text-xs text-gray-500 mt-1">PNG, JPG (max 4MB)</div>
                        </div>
                        <input type="file" name="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" @change="onChange($event)">
                    </label>
                    <template x-if="fileName">
                        <div class="mt-2 text-sm text-gray-700">Seçilen: <span class="font-medium" x-text="fileName"></span></div>
                    </template>
                </div>
            </div>
            @error('image')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (TR)</label>
                <input type="text" name="title_tr" value="{{ old('title_tr', $portfolio->title_tr) }}" placeholder="Örn: Villa Havuzu" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('title_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Başlık (EN)</label>
                <input type="text" name="title_en" value="{{ old('title_en', $portfolio->title_en) }}" placeholder="e.g., Villa Pool" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('title_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="portfolio_category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @php($cats = \App\Models\PortfolioCategory::where('status','active')->orderBy('order')->orderByDesc('id')->get())
                    @foreach($cats as $cat)
                        <option value="{{ $cat->id }}" {{ old('portfolio_category_id', $portfolio->portfolio_category_id)==$cat->id?'selected':'' }}>{{ app()->getLocale()==='tr' ? $cat->name_tr : ($cat->name_en ?? $cat->name_tr) }}</option>
                    @endforeach
                </select>
                @error('portfolio_category_id')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
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


