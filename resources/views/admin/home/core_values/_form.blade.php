@csrf
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Metin (TR) *</label>
        <textarea name="text_tr" rows="5" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('text_tr', $value->text_tr) }}</textarea>
        @error('text_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Metin (EN)</label>
        <textarea name="text_en" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('text_en', $value->text_en) }}</textarea>
        @error('text_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Sıra</label>
        <input type="number" name="order" value="{{ old('order', $value->order ?? 0) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" min="0">
        @error('order')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Durum</label>
        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="active" {{ old('status', $value->status ?? 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="passive" {{ old('status', $value->status ?? 'active') === 'passive' ? 'selected' : '' }}>Pasif</option>
        </select>
        @error('status')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
    </div>
</div>

<div class="mt-6">
    <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Kaydet</button>
</div>

