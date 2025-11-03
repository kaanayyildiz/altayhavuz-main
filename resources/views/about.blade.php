@extends('layouts.app')

@section('title', __('messages.app_name') . ' - ' . __('messages.about'))

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ __('messages.about_title') }}</h1>
            <p class="text-xl text-blue-100">{{ __('messages.about_subtitle') }}</p>
        </div>
    </section>

    <!-- About Content Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ __('messages.about_title') }}</h2>
                    <p class="text-lg text-gray-600 mb-4">{{ __('messages.about_content') }}</p>
                    <p class="text-lg text-gray-600 mb-4">
                        {{ app()->getLocale() === 'tr' 
                            ? 'Müşterilerimizin memnuniyeti bizim için önceliktir. Her projede kalite, güvenlik ve zamanında teslimat prensiplerimizle çalışıyoruz.' 
                            : 'Customer satisfaction is our priority. We work with quality, safety and timely delivery principles in every project.' }}
                    </p>
                    <p class="text-lg text-gray-600">
                        {{ app()->getLocale() === 'tr' 
                            ? 'Modern teknolojiler ve deneyimli ekibimiz ile hayalinizdeki havuzu gerçeğe dönüştürüyoruz.' 
                            : 'We turn your dream pool into reality with modern technologies and our experienced team.' }}
                    </p>
                </div>
                <div class="bg-gray-50 p-8 rounded-lg">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600 mb-2">15+</div>
                            <div class="text-gray-600">{{ app()->getLocale() === 'tr' ? 'Yıl Deneyim' : 'Years Experience' }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600 mb-2">100+</div>
                            <div class="text-gray-600">{{ app()->getLocale() === 'tr' ? 'Tamamlanan Proje' : 'Completed Projects' }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600 mb-2">100%</div>
                            <div class="text-gray-600">{{ app()->getLocale() === 'tr' ? 'Müşteri Memnuniyeti' : 'Customer Satisfaction' }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-blue-600 mb-2">24/7</div>
                            <div class="text-gray-600">{{ app()->getLocale() === 'tr' ? 'Destek' : 'Support' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Team Section -->
            <div class="mt-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">{{ __('messages.our_team') }}</h2>
                <p class="text-lg text-gray-600 mb-12 text-center">{{ __('messages.our_team_desc') }}</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-gray-50 p-6 rounded-lg text-center">
                        <div class="w-24 h-24 bg-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ app()->getLocale() === 'tr' ? 'Ahmet Yılmaz' : 'Ahmet Yılmaz' }}</h3>
                        <p class="text-gray-600">{{ app()->getLocale() === 'tr' ? 'Genel Müdür' : 'General Manager' }}</p>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-lg text-center">
                        <div class="w-24 h-24 bg-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ app()->getLocale() === 'tr' ? 'Mehmet Demir' : 'Mehmet Demir' }}</h3>
                        <p class="text-gray-600">{{ app()->getLocale() === 'tr' ? 'Proje Müdürü' : 'Project Manager' }}</p>
                    </div>
                    
                    <div class="bg-gray-50 p-6 rounded-lg text-center">
                        <div class="w-24 h-24 bg-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ app()->getLocale() === 'tr' ? 'Fatma Kaya' : 'Fatma Kaya' }}</h3>
                        <p class="text-gray-600">{{ app()->getLocale() === 'tr' ? 'Tasarım Uzmanı' : 'Design Specialist' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

