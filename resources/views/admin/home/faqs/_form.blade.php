@csrf
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Soru (TR) *</label>
            <input type="text" name="question_tr" value="{{ old('question_tr', $faq->question_tr) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('question_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Soru (EN)</label>
            <input type="text" name="question_en" value="{{ old('question_en', $faq->question_en) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            @error('question_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Cevap (TR)</label>
            <textarea name="answer_tr" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('answer_tr', $faq->answer_tr) }}</textarea>
            @error('answer_tr')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Cevap (EN)</label>
            <textarea name="answer_en" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('answer_en', $faq->answer_en) }}</textarea>
            @error('answer_en')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Sıra</label>
        <input type="number" name="order" value="{{ old('order', $faq->order ?? 0) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" min="0">
        @error('order')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Durum</label>
        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="active" {{ old('status', $faq->status ?? 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="passive" {{ old('status', $faq->status ?? 'active') === 'passive' ? 'selected' : '' }}>Pasif</option>
        </select>
        @error('status')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
    </div>
</div>

<div class="mt-6">
    <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">Kaydet</button>
</div>

