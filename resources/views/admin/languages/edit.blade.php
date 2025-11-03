@extends('admin.layouts.app')

@section('title', 'Dil Düzenle - Admin')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Dil Düzenle: {{ strtoupper($locale) }}</h1>
        <a href="{{ route('admin.languages.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">
            Geri Dön
        </a>
    </div>

    @if(session('error'))
        <div class="mb-4 bg-red-50 text-red-800 border border-red-200 px-4 py-3 rounded-lg">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.languages.update', $locale) }}" method="POST" class="bg-white border rounded-xl p-6">
        @csrf
        @method('PUT')
        
        <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-blue-800">
                <strong>Not:</strong> Dil anahtarlarını düzenleyebilirsiniz. Boş bırakılan değerler otomatik olarak boş olarak kaydedilecektir.
            </p>
        </div>

        <div class="space-y-4 max-h-[70vh] overflow-y-auto pr-2">
            @foreach($messages as $key => $value)
                <div class="border-b border-gray-100 pb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <span class="text-gray-500 font-mono text-xs">{{ $key }}</span>
                    </label>
                    <textarea 
                        name="messages[{{ $key }}]" 
                        rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Değer...">{{ old("messages.{$key}", $value) }}</textarea>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex items-center gap-3 pt-4 border-t">
            <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                Kaydet
            </button>
            <a href="{{ route('admin.languages.index') }}" class="px-6 py-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                İptal
            </a>
        </div>
    </form>
@endsection

