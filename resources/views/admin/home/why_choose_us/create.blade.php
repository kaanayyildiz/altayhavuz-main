@extends('admin.layouts.app')

@section('title', 'Yeni Öne Çıkan - Admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Yeni Öne Çıkan Özellik</h1>
        <a href="{{ route('admin.home.why.index') }}" class="text-sm text-blue-600 hover:underline">← Listeye dön</a>
    </div>

    <form action="{{ route('admin.home.why.store') }}" method="POST" class="bg-white border rounded-xl p-6 space-y-6">
        @include('admin.home.why_choose_us._form')
    </form>
@endsection

