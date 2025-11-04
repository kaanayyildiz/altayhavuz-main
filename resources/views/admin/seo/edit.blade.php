@extends('admin.layouts.app')

@section('title', 'SEO Yönetimi - Admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">SEO Yönetimi</h1>

    <form action="{{ route('admin.seo.update') }}" method="POST" class="bg-white border rounded-xl p-6 space-y-5 max-w-3xl mb-8">
        @csrf
        <div>
            <h2 class="text-lg font-semibold mb-3">Varsayılan SEO Ayarları</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Varsayılan Meta Title</label>
                    <input type="text" name="seo_title_default" value="{{ old('seo_title_default', $seoTitle) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('seo_title_default')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Varsayılan Meta Description</label>
                    <textarea name="seo_description_default" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('seo_description_default', $seoDescription) }}</textarea>
                    @error('seo_description_default')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Varsayılan Meta Keywords (virgülle)</label>
                    <input type="text" name="seo_keywords_default" value="{{ old('seo_keywords_default', $seoKeywords) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('seo_keywords_default')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <div class="pt-4 border-t">
            <h2 class="text-lg font-semibold mb-3">Open Graph (OG) Ayarları</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">OG Title</label>
                    <input type="text" name="og_title_default" value="{{ old('og_title_default', $ogTitle) }}" placeholder="Boş bırakılırsa meta title kullanılır" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('og_title_default')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">OG Description</label>
                    <textarea name="og_description_default" rows="3" placeholder="Boş bırakılırsa meta description kullanılır" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('og_description_default', $ogDescription) }}</textarea>
                    @error('og_description_default')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">OG Image URL</label>
                    <input type="url" name="og_image_default" value="{{ old('og_image_default', $ogImage) }}" placeholder="https://... (1200x630 önerilir)" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('og_image_default')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">OG Type</label>
                    <select name="og_type_default" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="website" {{ old('og_type_default', $ogType)==='website'?'selected':'' }}>Website</option>
                        <option value="article" {{ old('og_type_default', $ogType)==='article'?'selected':'' }}>Article</option>
                        <option value="product" {{ old('og_type_default', $ogType)==='product'?'selected':'' }}>Product</option>
                        <option value="profile" {{ old('og_type_default', $ogType)==='profile'?'selected':'' }}>Profile</option>
                    </select>
                    @error('og_type_default')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">OG Site Name</label>
                    <input type="text" name="og_site_name_default" value="{{ old('og_site_name_default', $ogSiteName) }}" placeholder="Site adı" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('og_site_name_default')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">Kaydet</button>
        </div>
    </form>

    <div class="bg-white border rounded-xl overflow-hidden overflow-x-auto">
        <div class="px-4 py-3 bg-gray-50 border-b flex items-center justify-between">
            <div class="text-sm font-semibold text-gray-700">Menü Öğeleri (SEO Kısayolları)</div>
            <a href="{{ route('admin.menus.create') }}" class="bg-blue-600 text-white px-3 py-1.5 rounded text-sm">Yeni Öğe</a>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Başlık</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meta Title</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durum</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($menus as $m)
                    <tr>
                        <td class="px-4 py-3">{{ app()->getLocale()==='tr' ? $m->title_tr : ($m->title_en ?? $m->title_tr) }}</td>
                        <td class="px-4 py-3">{{ $m->url }}</td>
                        <td class="px-4 py-3">{{ $m->seo_title ?: '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded {{ $m->status === 'active' ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-700' }}">{{ $m->status }}</span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.menus.edit', $m) }}" class="text-blue-600 hover:underline">SEO Düzenle</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">Henüz menü öğesi yok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $menus->links() }}</div>
    </div>
@endsection


