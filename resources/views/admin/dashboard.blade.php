@extends('admin.layouts.app')

@section('title', 'Admin Dashboard - ' . __('messages.app_name'))

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl border p-6 shadow-sm hover:shadow-md transition">
            <div class="text-sm text-gray-500 mb-2">Sliderlar</div>
            <div class="text-3xl font-extrabold">{{ \App\Models\Slider::count() }}</div>
        </div>
        <div class="bg-white rounded-2xl border p-6 shadow-sm hover:shadow-md transition">
            <div class="text-sm text-gray-500 mb-2">Portfolio</div>
            <div class="text-3xl font-extrabold">{{ \App\Models\Portfolio::count() }}</div>
        </div>
        <div class="bg-white rounded-2xl border p-6 shadow-sm hover:shadow-md transition">
            <div class="text-sm text-gray-500 mb-2">Menüler</div>
            <div class="text-3xl font-extrabold">{{ \App\Models\Menu::count() }}</div>
        </div>
    </div>
@endsection


