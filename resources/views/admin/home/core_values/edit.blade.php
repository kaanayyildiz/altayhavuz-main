@extends('admin.layouts.app')

@section('title', 'Değer Düzenle - Admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Temel Değer Düzenle</h1>
        <a href="{{ route('admin.home.core-values.index') }}" class="text-sm text-blue-600 hover:underline">← Listeye dön</a>
    </div>

    <form action="{{ route('admin.home.core-values.update', $value) }}" method="POST" class="bg-white border rounded-xl p-6 space-y-6">
        @method('PUT')
        @include('admin.home.core_values._form')
    </form>
@endsection

