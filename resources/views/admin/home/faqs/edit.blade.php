@extends('admin.layouts.app')

@section('title', 'SSS Düzenle - Admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Soru Düzenle</h1>
        <a href="{{ route('admin.home.faqs.index') }}" class="text-sm text-blue-600 hover:underline">← Listeye dön</a>
    </div>

    <form action="{{ route('admin.home.faqs.update', $faq) }}" method="POST" class="bg-white border rounded-xl p-6 space-y-6">
        @method('PUT')
        @include('admin.home.faqs._form')
    </form>
@endsection

