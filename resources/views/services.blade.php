@extends('layouts.app')

@section('title', config('app.name') . ' - ' . __('messages.services'))

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ __('messages.services_title') }}</h1>
            <p class="text-xl text-blue-100">{{ __('messages.services_subtitle') }}</p>
        </div>
    </section>

    <!-- Services Detail Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(isset($services) && $services->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    @foreach($services as $service)
                        @php($iconConfig = $service->icon_config)
                        <div class="bg-gray-50 p-8 rounded-lg shadow-sm hover:shadow-md transition">
                            <div class="w-16 h-16 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @foreach($iconConfig['paths'] as $path)
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}"></path>
                                    @endforeach
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $service->localized_title }}</h2>
                            <p class="text-gray-600 mb-4">{{ $service->localized_description }}</p>
                            @php($features = $service->localized_features)
                            @if(!empty($features))
                                <ul class="space-y-2 text-gray-600">
                                    @foreach($features as $feature)
                                        <li class="flex items-start gap-2">
                                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 p-10 rounded-lg text-center text-gray-500 shadow-sm">
                    {{ __('messages.no_services') }}
                </div>
            @endif

            <div class="text-center mt-12">
                <a href="{{ route('contact') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    {{ __('messages.get_quote') }}
                </a>
            </div>
        </div>
    </section>
@endsection

