<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <?php
        $currentPath = request()->getPathInfo();
        $currentUrl = url()->current();
        $pathVariants = array_values(array_unique([
            $currentPath,
            rtrim($currentPath, '/').'/',$currentPath === '/' ? '/' : '/'.ltrim($currentPath,'/'),
        ]));
        $menuSeo = \App\Models\Menu::whereIn('url', $pathVariants)->first();
        if (!$menuSeo) {
            $menuSeo = \App\Models\Menu::where('url', $currentUrl)->first();
        }
        if (!$menuSeo && ($currentPath === '' || $currentPath === '/')) {
            $menuSeo = \App\Models\Menu::where('url', '/')->first();
        }
        $defaultTitle = \App\Models\Setting::get('seo_title_default', config('app.name'));
        $defaultDescription = \App\Models\Setting::get('seo_description_default', '');
        $defaultKeywords = \App\Models\Setting::get('seo_keywords_default', '');
        $metaTitle = trim($menuSeo->seo_title ?? '') ?: $defaultTitle;
        $metaDescription = trim($menuSeo->seo_description ?? '') ?: $defaultDescription;
        $metaKeywords = trim($menuSeo->seo_keywords ?? '') ?: $defaultKeywords;
    ?>
    <title>@yield('title', $metaTitle)</title>
    @if(!empty($metaDescription))
        <meta name="description" content="{{ $metaDescription }}">
    @endif
    @if(!empty($metaKeywords))
        <meta name="keywords" content="{{ $metaKeywords }}">
    @endif
    <?php
        $ogTitleDefault = \App\Models\Setting::get('og_title_default', '');
        $ogDescriptionDefault = \App\Models\Setting::get('og_description_default', '');
        $ogTypeDefault = \App\Models\Setting::get('og_type_default', 'website');
        $ogSiteNameDefault = \App\Models\Setting::get('og_site_name_default', '');
        $ogImageDefault = \App\Models\Setting::get('og_image_default', '');

        $ogTitle = trim($ogTitleDefault) ?: $metaTitle;
        $ogDescription = trim($ogDescriptionDefault) ?: $metaDescription;
        $ogImage = ($menuSeo && trim($menuSeo->og_image ?? '') !== '') ? $menuSeo->og_image : ($ogImageDefault ?: asset('altayhavuzlogo.png'));
    ?>
    <meta property="og:title" content="{{ $ogTitle }}">
    @if(!empty($ogDescription))
        <meta property="og:description" content="{{ $ogDescription }}">
    @endif
    <meta property="og:type" content="{{ $ogTypeDefault }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage }}">
    @if(!empty($ogSiteNameDefault))
        <meta property="og:site_name" content="{{ $ogSiteNameDefault }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Analytics -->
    @php
        $gaId = \App\Models\Setting::get('google_analytics_id', '');
    @endphp
    @if($gaId)
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $gaId }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $gaId }}');
        </script>
    @endif

    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* Parıltı efekti için animasyon */
        @keyframes shimmer {
            0% {
                transform: translateX(-100%) skewX(-15deg);
            }
            100% {
                transform: translateX(200%) skewX(-15deg);
            }
        }

        .shimmer-button {
            position: relative;
            overflow: hidden;
        }

        .shimmer-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transform: translateX(-100%) skewX(-15deg);
            transition: transform 0.6s;
        }

        .shimmer-button:hover::before {
            animation: shimmer 0.8s ease-in-out;
        }
        .pool-footer {
            position: relative;
            border-top-left-radius: 140px;
            border-top-right-radius: 140px;
            background: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.15), transparent 55%),
                        radial-gradient(circle at 80% 0%, rgba(255,255,255,0.2), transparent 45%),
                        linear-gradient(135deg, #2193ff 0%, #0f75ff 50%, #0a5cd9 100%);
        }

        .pool-footer::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 20% 10%, rgba(255,255,255,0.18) 0%, transparent 55%),
                radial-gradient(circle at 80% 15%, rgba(255,255,255,0.15) 0%, transparent 50%),
                url("data:image/svg+xml,%3Csvg width='600' height='400' xmlns='http://www.w3.org/2000/svg'%3E%3Cdefs%3E%3ClinearGradient id='a' x1='0' x2='0' y1='0' y2='1'%3E%3Cstop stop-color='%23ffffff' stop-opacity='0.24' offset='0'/%3E%3Cstop stop-color='%23ffffff' stop-opacity='0' offset='1'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cpath d='M0 60c40 10 80-10 120 0s80 10 120 0 80-10 120 0 80 10 120 0 80-10 120 0v340H0z' fill='url(%23a)' opacity='.45'/%3E%3C/svg%3E");
            background-size: 100% 100%, 100% 100%, 120% 120%;
            background-position: center;
            background-repeat: no-repeat;
            mix-blend-mode: screen;
            opacity: 0.85;
        }

        .pool-footer::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 50% 120%, rgba(12, 60, 150, 0.55), transparent 65%);
            pointer-events: none;
        }

        .pool-footer-visual {
            position: absolute;
            bottom: 0;
            right: 0;
            width: clamp(160px, 18vw, 260px);
            pointer-events: none;
            filter: drop-shadow(0 20px 35px rgba(0, 35, 120, 0.35));
        }

        @media (max-width: 1024px) {
            .pool-footer-visual {
                right: 0;
            }
        }

        @media (max-width: 768px) {
            .pool-footer {
                border-top-left-radius: 90px;
                border-top-right-radius: 90px;
            }

            .pool-footer-visual {
                display: none;
            }
        }
    </style>
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
</head>
<body class="bg-gray-50 antialiased">
    <!-- Top Info Bar -->
    <div class="hidden md:block bg-gray-100 text-xs sm:text-sm text-gray-600 overflow-hidden sticky top-0 z-[100]">
        <div class="w-full mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 py-2 sm:py-3">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 sm:gap-0">
                <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 lg:space-x-8 w-full sm:w-auto">
                    <div class="flex items-center space-x-2 min-w-0">
                        <svg class="w-4 h-4 text-blue-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="truncate">İhlas Marmara Evleri 1.Kısım, Beylikdüzü, İstanbul</span>
                    </div>
                    <div class="hidden md:flex items-center space-x-2">
                        <svg class="w-4 h-4 text-blue-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="whitespace-nowrap">{{ __('messages.working_time') }}: {{ __('messages.twenty_four_service') }}</span>
                    </div>
                </div>
                <div class="flex items-center space-x-3 sm:space-x-4 flex-shrink-0">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-blue-700 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.75 5.25L3 6V18L3.75 18.75H20.25L21 18V6L20.25 5.25H3.75ZM4.5 7.6955V17.25H19.5V7.69525L11.9999 14.5136L4.5 7.6955ZM18.3099 6.75H5.68986L11.9999 12.4864L18.3099 6.75Z"/>
                        </svg>
                        <span class="truncate sm:whitespace-nowrap">info@altayhavuz.com</span>
                    </div>

                    <!-- Language Switcher -->
                    <div class="flex-shrink-0">
                        @if(app()->getLocale() === 'tr')
                            <a href="{{ route('language.switch', 'en') }}" class="flex items-center space-x-1 text-gray-600 hover:text-blue-700 transition whitespace-nowrap px-2 py-1 rounded hover:bg-gray-200">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                </svg>
                                <span class="uppercase font-medium">EN</span>
                            </a>
                        @else
                            <a href="{{ route('language.switch', 'tr') }}" class="flex items-center space-x-1 text-gray-600 hover:text-blue-700 transition whitespace-nowrap px-2 py-1 rounded hover:bg-gray-200">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                </svg>
                                <span class="uppercase font-medium">TR</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="bg-white sticky top-0 md:top-[44px] z-50 overflow-hidden" x-data="{ mobileMenuOpen: false }">
        <div class="w-full mx-auto px-4 sm:px-6 md:px-8 lg:px-12 xl:px-16 py-3 sm:py-4">
            <div class="flex justify-between items-center min-h-[60px] sm:min-h-[70px] lg:min-h-[80px] gap-4">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0 min-w-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('altayhavuzlogo.png') }}" alt="Altay Havuz" class="h-8 sm:h-10 lg:h-12 w-auto object-contain">
                    </a>
                </div>

                <!-- Desktop Navigation Menu -->
                <div class="hidden lg:flex items-center space-x-6 xl:space-x-10 mx-4 xl:mx-8 flex-1 justify-center min-w-0">
                    @if(isset($headerMenus) && $headerMenus->count())
                        @foreach($headerMenus as $m)
                            <a href="{{ $m->url }}" class="text-gray-700 hover:text-blue-600 px-3 xl:px-4 py-2 rounded-md text-sm xl:text-base font-medium transition whitespace-nowrap">
                                {{ app()->getLocale()==='tr' ? $m->title_tr : ($m->title_en ?? $m->title_tr) }}
                            </a>
                        @endforeach
                    @endif


                </div>

                <!-- Desktop Right side: Phone + CTA -->
                <div class="hidden lg:flex items-center space-x-4 xl:space-x-8 flex-shrink-0">
                    <div class="hidden xl:flex flex-col items-start">
                        <a href="tel:05073112410" class="flex items-center space-x-3 mb-1 hover:opacity-80 transition-opacity">
                            <div class="w-12 h-12 rounded-full border-2 border-blue-200 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.69l1.2 3.6a1 1 0 01-.5 1.2l-2.1 1.05A11 11 0 0014.46 17l1.05-2.1a1 1 0 011.2-.5l3.6 1.2a1 1 0 01.69.95V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <div class="text-xs text-gray-500 leading-tight whitespace-nowrap">{{ __('messages.call_now') }}</div>
                                <div class="text-lg xl:text-xl font-bold text-blue-800 leading-tight whitespace-nowrap">0 (507) 311 24 10</div>
                            </div>
                        </a>
                    </div>
                    <a href="{{ route('home') }}#quote" class="shimmer-button bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md px-4 xl:px-8 py-3 xl:py-4 shadow-md transition whitespace-nowrap text-sm xl:text-base relative z-10">
                        <span class="relative z-10">{{ __('messages.request_service') }}</span>
                        <span class="relative z-10 ml-1 xl:ml-2">&rarr;</span>
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden flex-shrink-0">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-700 hover:text-blue-600 p-2">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu: slide-in panel -->
        <div class="lg:hidden" x-cloak>
            <!-- Overlay -->
            <div x-show="mobileMenuOpen" x-transition.opacity class="fixed inset-0 bg-black/40 z-50" @click="mobileMenuOpen=false"></div>
            <!-- Panel -->
            <div x-show="mobileMenuOpen"
                 x-transition:enter="transition transform ease-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition transform ease-in duration-200"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="fixed right-0 top-0 h-full w-80 max-w-[85%] bg-white z-[60] shadow-2xl border-l border-gray-200 flex flex-col">
                <div class="px-4 py-4 flex items-center justify-between border-b">
                    <span class="font-semibold text-gray-800">Menü</span>
                    <button class="p-2" @click="mobileMenuOpen=false">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto px-4 pt-3 pb-4 space-y-2">
                    @if(isset($headerMenus) && $headerMenus->count())
                        @foreach($headerMenus as $m)
                            <a href="{{ $m->url }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50" @click="mobileMenuOpen = false">
                                {{ app()->getLocale()==='tr' ? $m->title_tr : ($m->title_en ?? $m->title_tr) }}
                            </a>
                        @endforeach
                    @endif

                    <div class="border-t border-gray-200 pt-3 mt-3">
                        <a href="tel:05073112410" class="flex items-center space-x-3 px-3 py-2 mb-3 hover:bg-gray-50 rounded-md transition-colors">
                            <div class="w-10 h-10 rounded-full border-2 border-blue-200 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.69l1.2 3.6a1 1 0 01-.5 1.2l-2.1 1.05A11 11 0 0014.46 17l1.05-2.1a1 1 0 011.2-.5l3.6 1.2a1 1 0 01.69.95V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="text-xs text-gray-500">{{ __('messages.call_now') }}</div>
                                <div class="text-base font-semibold text-blue-800 truncate">0 (507) 311 24 10</div>
                            </div>
                        </a>
                        <a href="{{ route('home') }}#quote" class="shimmer-button block text-center bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-md px-4 py-3 shadow-md transition mb-3 relative z-10" @click="mobileMenuOpen = false">
                            <span class="relative z-10">{{ __('messages.request_service') }} →</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(()=> show=false, 3000)" x-show="show" x-transition
             class="fixed top-4 left-1/2 -translate-x-1/2 bg-green-600 text-white px-4 py-2 rounded-md shadow-lg z-[9999]">
            {{ session('success') }}
        </div>
    @endif

    <!-- Footer -->
    @php
        $instagramUrl = \App\Models\Setting::get('instagram_url', '');
        $youtubeUrl = \App\Models\Setting::get('youtube_url', '');
    @endphp
    <section class="relative mt-32">
        <footer class="pool-footer text-white pt-32 pb-12">
            <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
                <div class="flex flex-col lg:flex-row items-center lg:items-start gap-10 lg:gap-16">
                    <div class="flex-1 text-center lg:text-left">
                        <div class="flex justify-center lg:justify-start">
                            <img src="{{ asset('altayhavuzlogo.png') }}" alt="Altay Havuz" class="h-16 w-auto object-contain drop-shadow-lg">
                        </div>
                        <p class="mt-6 text-sm sm:text-base text-blue-50/80 max-w-md mx-auto lg:mx-0">
                            Müşterilerimizin memnuniyeti için titizlikle çalışıyor, havuz hayallerini gerçeğe dönüştürüyoruz.
                        </p>
                        <div class="mt-6 flex justify-center lg:justify-start gap-3">
                            @if($instagramUrl)
                                <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M7 2C4.243 2 2 4.243 2 7v10c0 2.757 2.243 5 5 5h10c2.757 0 5-2.243 5-5V7c0-2.757-2.243-5-5-5H7zm0 2h10c1.654 0 3 1.346 3 3v10c0 1.654-1.346 3-3 3H7c-1.654 0-3-1.346-3-3V7c0-1.654 1.346-3 3-3zm10 1a1 1 0 100 2 1 1 0 000-2zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6z"/>
                                    </svg>
                                </a>
                            @endif
                            @if($youtubeUrl)
                                <a href="{{ $youtubeUrl }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.002 3.002 0 0 0-2.118-2.127C19.502 3.55 12 3.55 12 3.55s-7.502 0-9.38.509A3.002 3.002 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.003 3.003 0 0 0 2.118 2.127c1.878.508 9.38.508 9.38.508s7.502 0 9.38-.508a3.003 3.003 0 0 0 2.118-2.127C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.75 15.5v-7L15.5 12l-5.75 3.5z"/>
                                    </svg>
                                </a>
                            @endif
                            @if(!$instagramUrl && !$youtubeUrl)
                                <span class="text-blue-50/80 text-sm">Sosyal medya hesaplarımız yakında.</span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 flex-[1.3] w-full">
                        <div>
                            <h4 class="text-lg font-semibold tracking-wide">Hızlı Bağlantılar</h4>
                            <ul class="mt-4 space-y-3 text-blue-50/80">
                                <li><a href="{{ route('home') }}" class="hover:text-white transition">Anasayfa</a></li>
                                <li><a href="{{ route('services') }}" class="hover:text-white transition">Hizmetler</a></li>
                                <li><a href="{{ route('about') }}" class="hover:text-white transition">Hakkımızda</a></li>
                                <li><a href="{{ route('contact') }}" class="hover:text-white transition">İletişim</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold tracking-wide">İletişim</h4>
                            <ul class="mt-4 space-y-3 text-blue-50/80">
                                <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 11c1.657 0 3-1.567 3-3.5S13.657 4 12 4 9 5.567 9 7.5 10.343 11 12 11zm0 0c-3.314 0-6 2.91-6 6.5V19h12v-1.5c0-3.59-2.686-6.5-6-6.5z"/>
                                    </svg>
                                    <span>İhlas Marmara Evleri 1.Kısım, Beylikdüzü, İstanbul</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.95.69l1.2 3.6a1 1 0 01-.5 1.2L8.93 9.11A11.05 11.05 0 0014.89 15.07l1.62-1.52a1 1 0 011.2-.5l3.6 1.2a1 1 0 01.69.95V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <a href="tel:05073112410" class="hover:text-white transition">0 (507) 311 24 10</a>
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.75 5.25L3 6V18L3.75 18.75H20.25L21 18V6L20.25 5.25H3.75ZM4.5 7.6955V17.25H19.5V7.69525L11.9999 14.5136L4.5 7.6955ZM18.3099 6.75H5.68986L11.9999 12.4864L18.3099 6.75Z"/>
                                    </svg>
                                    <a href="mailto:info@altayhavuz.com" class="hover:text-white transition">info@altayhavuz.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mt-12 border-t border-white/15 pt-6 text-center text-sm text-blue-50/80">
                    <p>&copy; {{ date('Y') }} {{ __('messages.app_name') }} · Tüm hakları saklıdır.</p>
                </div>
            </div>
            <img src="{{ asset('footer02.png') }}" alt="Havuz merdiveni" class="pool-footer-visual">
        </footer>
    </section>

    <!-- Alpine.js for dropdown menus -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Fancybox JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        (function(){
            function initFancybox(){
                if (window.Fancybox && typeof window.Fancybox.bind === 'function') {
                    window.Fancybox.bind('[data-fancybox]', {});
                }
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initFancybox);
            } else {
                initFancybox();
            }
        })();
    </script>
    <script>
        (function(){
            function disableAutocomplete(){
                document.querySelectorAll('form').forEach(function(f){ f.setAttribute('autocomplete','off'); });
                document.querySelectorAll('input, textarea').forEach(function(el){
                    el.setAttribute('autocomplete','off');
                    el.setAttribute('autocorrect','off');
                    el.setAttribute('autocapitalize','off');
                    el.setAttribute('spellcheck','false');
                });
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', disableAutocomplete);
            } else {
                disableAutocomplete();
            }
        })();
    </script>
</body>
</html>

