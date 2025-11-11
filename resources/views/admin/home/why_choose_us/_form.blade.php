@csrf
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Başlık (TR) *</label>
            <input type="text" name="title_tr" value="{{ old('title_tr', $item->title_tr) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('title_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Başlık (EN)</label>
            <input type="text" name="title_en" value="{{ old('title_en', $item->title_en) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('title_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Açıklama (TR)</label>
            <textarea name="description_tr" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description_tr', $item->description_tr) }}</textarea>
            @error('description_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Açıklama (EN)</label>
            <textarea name="description_en" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description_en', $item->description_en) }}</textarea>
            @error('description_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Simge *</label>
            @php($selectedIcon = old('icon', $item->icon ?? 'building'))
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                @foreach($iconOptions as $key => $config)
                    @php($isActive = $selectedIcon === $key)
                    <label class="border rounded-lg p-4 flex flex-col items-center justify-center gap-3 cursor-pointer transition {{ $isActive ? 'border-blue-500 ring-2 ring-blue-200 bg-blue-50/40' : 'border-gray-200 hover:border-blue-300' }}">
                        <input type="radio" name="icon" value="{{ $key }}" class="sr-only" {{ $isActive ? 'checked' : '' }}>
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @foreach($config['paths'] as $path)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}"></path>
                            @endforeach
                        </svg>
                        <span class="text-sm font-medium text-gray-700">{{ $config['label_tr'] ?? ucfirst($key) }}</span>
                    </label>
                @endforeach
            </div>
            @error('icon')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sıra</label>
                <input type="number" name="order" value="{{ old('order', $item->order ?? 0) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" min="0">
                @error('order')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Durum</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="active" {{ old('status', $item->status ?? 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="passive" {{ old('status', $item->status ?? 'active') === 'passive' ? 'selected' : '' }}>Pasif</option>
                </select>
                @error('status')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

<div class="mt-6">
    <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Kaydet</button>
</div>

