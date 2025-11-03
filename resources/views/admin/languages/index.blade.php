@extends('admin.layouts.app')

@section('title', 'Dil Yönetimi - Admin')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Dil Yönetimi</h1>

    <div class="bg-white border rounded-xl p-6 space-y-4">
        <p class="text-gray-600 mb-4">Düzenlemek istediğiniz dili seçin:</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($locales as $locale)
                <a href="{{ route('admin.languages.edit', $locale) }}" class="block p-6 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">
                                @if($locale === 'tr')
                                    Türkçe
                                @else
                                    English
                                @endif
                            </h3>
                            <p class="text-sm text-gray-500">{{ strtoupper($locale) }} Dil Dosyası</p>
                        </div>
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection


