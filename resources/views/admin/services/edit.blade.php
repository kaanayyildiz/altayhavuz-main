@extends('admin.layouts.app')

@section('title', 'Hizmet Düzenle - Admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Hizmet Düzenle</h1>
        <a href="{{ route('admin.services.index') }}" class="text-sm text-blue-600 hover:underline">← Listeye dön</a>
    </div>

    <form action="{{ route('admin.services.update', $service) }}" method="POST" class="bg-white border rounded-xl p-6 space-y-6">
        @method('PUT')
        @include('admin.services._form')
    </form>
@endsection

