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
                        <svg class="w-4 h-4 text-blue-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 0a4 4 0 10-8 0 4 4 0 008 0z"/>
                        </svg>
                        <span class="truncate sm:whitespace-nowrap">info@altayhavuz.com</span>
                    </div>

                    <!-- Instagram Icon -->
                    <a href="https://www.instagram.com/altayhavuz" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-6 h-6 text-gray-600 hover:text-pink-600 transition-colors" aria-label="Instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>

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
    <footer class="bg-gray-800 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('altayhavuzlogo.png') }}" alt="Altay Havuz" class="h-10 w-auto object-contain">
                        <span class="text-xl font-bold">{{ __('messages.app_name') }}</span>
                    </div>
                    <p class="text-gray-400 mb-4">{{ __('messages.footer_text') }}</p>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('messages.quick_links') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">{{ __('messages.home') }}</a></li>
                        <li><a href="{{ route('services') }}" class="text-gray-400 hover:text-white transition">{{ __('messages.services') }}</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition">{{ __('messages.about') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition">{{ __('messages.contact') }}</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ __('messages.contact') }}</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>{{ __('messages.address') }}: İstanbul, Türkiye</li>
                        <li>Email: info@altayhavuz.com</li>
                        <li>Phone: +90 507 311 24 10</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ __('messages.app_name') }}. {{ __('messages.all_rights_reserved') }}</p>
            </div>
        </div>
    </footer>

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

