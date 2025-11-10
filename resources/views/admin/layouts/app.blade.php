<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - ' . __('messages.app_name'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-slate-100 text-gray-900" x-data="{ sidebarOpen: false }">
<div class="min-h-screen">
    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 w-72 bg-white/90 backdrop-blur border-r border-slate-200 z-40 hidden md:flex md:flex-col">
        <div class="h-16 flex items-center px-6 border-b">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                <img src="{{ asset('altayhavuzlogo.png') }}" alt="Altay Havuz" class="h-10 object-contain">
            </a>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z"/></svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.sliders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/sliders*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h18M7 3v4M17 3v4M3 19h18M7 17v4M17 17v4M6 9h12l-2.5 6h-7L6 9z"/></svg>
                <span>Sliderlar</span>
            </a>
            <a href="{{ route('admin.portfolios.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/portfolios*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5h16a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V6a1 1 0 011-1zm3 3l3 3 2-2 5 5"/></svg>
                <span>Portfolyo</span>
            </a>
            <a href="{{ route('admin.portfolio-categories.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/portfolio-categories*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <span>Portfolyo Kategoriler</span>
            </a>
            <a href="{{ route('admin.menus.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/menus*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h13M3 6h1m-1 6h1m4 0h13M3 18h1m4 0h13"/></svg>
                <span>Menüler</span>
            </a>
            <a href="{{ route('admin.seo.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/seo') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 110-16 8 8 0 010 16z"/></svg>
                <span>SEO Yönetimi</span>
            </a>
            <a href="{{ route('admin.offers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/offers*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h8M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Teklifler</span>
            </a>
            <a href="{{ route('admin.languages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/languages*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                <span>Dil Dosyaları</span>
            </a>
            <a href="{{ route('admin.settings.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/settings') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317a1 1 0 011.35-.936l.862.287a2 2 0 001.962-.503l.61-.61a1 1 0 011.414 0l1.06 1.06a1 1 0 010 1.415l-.61.61a2 2 0 00-.503 1.962l.287.862a1 1 0 01-.936 1.35l-.905.151a2 2 0 00-1.664 1.664l-.151.905a1 1 0 01-1.35.936l-.862-.287a2 2 0 00-1.962.503l-.61.61a1 1 0 01-1.414 0l-1.06-1.06a1 1 0 010-1.415l.61-.61a2 2 0 00.503-1.962l-.287-.862a1 1 0 01.936-1.35l.905-.151a2 2 0 001.664-1.664l.151-.905zM12 8a4 4 0 110 8 4 4 0 010-8z"/></svg>
                <span>Ayarlar</span>
            </a>
        </nav>
        <form action="{{ route('admin.logout') }}" method="POST" class="px-3 pb-4 mt-auto">
            @csrf
            <button class="w-full bg-red-600/10 text-red-700 hover:bg-red-600/20 px-4 py-2 rounded-md">Çıkış Yap</button>
        </form>
    </aside>

    <!-- Mobile Sidebar -->
    <div class="md:hidden">
        <div x-show="sidebarOpen" x-cloak x-transition.opacity class="fixed inset-0 bg-black/40 z-30" @click="sidebarOpen=false"></div>
        <div x-show="sidebarOpen" x-cloak
             x-transition:enter="transition transform ease-out duration-300"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition transform ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 w-72 bg-white z-40 shadow-xl border-r border-slate-200">
            <div class="h-16 flex items-center justify-between px-4 border-b">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                    <img src="{{ asset('altayhavuzlogo.png') }}" alt="Altay Havuz" class="h-9 object-contain">
                </a>
                <button class="p-2" @click="sidebarOpen=false">
                    <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <nav class="px-3 py-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h7v7H3V3zm11 0h7v7h-7V3zM3 14h7v7H3v-7zm11 0h7v7h-7v-7z"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.sliders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/sliders*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h18M7 3v4M17 3v4M3 19h18M7 17v4M17 17v4M6 9h12l-2.5 6h-7L6 9z"/></svg>
                    <span>Sliderlar</span>
                </a>
                <a href="{{ route('admin.portfolios.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/portfolios*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5h16a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V6a1 1 0 011-1zm3 3l3 3 2-2 5 5"/></svg>
                    <span>Portfolyo</span>
                </a>
                <a href="{{ route('admin.portfolio-categories.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/portfolio-categories*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <span>Portfolio Kategoriler</span>
                </a>
                <a href="{{ route('admin.menus.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/menus*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h13M3 6h1m-1 6h1m4 0h13M3 18h1m4 0h13"/></svg>
                    <span>Menüler</span>
                </a>
                <a href="{{ route('admin.seo.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/seo') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 110-16 8 8 0 010 16z"/></svg>
                    <span>SEO Yönetimi</span>
                </a>
                <a href="{{ route('admin.offers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/offers*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h8M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Teklifler</span>
                </a>
                <a href="{{ route('admin.languages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/languages*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                    <span>Dil Dosyaları</span>
                </a>
                <a href="{{ route('admin.settings.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/settings') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317a1 1 0 011.35-.936l.862.287a2 2 0 001.962-.503l.61-.61a1 1 0 011.414 0l1.06 1.06a1 1 0 010 1.415l-.61.61a2 2 0 00-.503 1.962l.287.862a1 1 0 01-.936 1.35l-.905.151a2 2 0 00-1.664 1.664l-.151.905zM12 8a4 4 0 110 8 4 4 0 010-8z"/></svg>
                    <span>Ayarlar</span>
                </a>
            </nav>
            <form action="{{ route('admin.logout') }}" method="POST" class="px-3 pb-4 mt-auto">
                @csrf
                <button class="w-full bg-red-600/10 text-red-700 hover:bg-red-600/20 px-4 py-2 rounded-md">Çıkış Yap</button>
            </form>
        </div>
    </div>

    <!-- Main -->
    @php
        $unreadOffersCount = $unreadOffersCount ?? 0;
        $recentUnreadOffers = $recentUnreadOffers ?? collect();
    @endphp

    <div class="md:ml-72 flex flex-col min-h-screen">
        <header class="h-16 bg-white/80 backdrop-blur border-b flex items-center justify-between px-4 md:px-6 sticky top-0 z-10">
            <div class="flex items-center gap-3">
                <button class="md:hidden p-2 rounded hover:bg-slate-100" @click="sidebarOpen=true">
                    <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="md:hidden flex items-center">
                    <img src="{{ asset('altayhavuzlogo.png') }}" alt="Altay Havuz" class="h-8 object-contain">
                </a>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative" x-data="{ open:false }" @keydown.escape.window="open=false">
                    <button class="relative p-2 rounded-full hover:bg-slate-100 transition" @click="open=!open" @click.outside="open=false" aria-expanded="false" aria-haspopup="true">
                        <svg class="w-6 h-6 {{ $unreadOffersCount ? 'text-blue-600' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        @if($unreadOffersCount)
                            <span class="absolute -top-1 -right-1 inline-flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-red-500 px-1 text-[11px] font-semibold text-white">
                                {{ $unreadOffersCount > 9 ? '9+' : $unreadOffersCount }}
                            </span>
                        @endif
                    </button>
                    <div
                        x-cloak
                        x-show="open"
                        x-transition
                        class="absolute right-0 mt-2 w-72 origin-top-right rounded-xl border border-slate-200 bg-white shadow-lg"
                    >
                        <div class="flex items-center justify-between px-4 py-3 border-b">
                            <div class="text-sm font-semibold text-slate-700">Bildirimler</div>
                            @if($unreadOffersCount)
                                <span class="rounded-full bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-600">{{ $unreadOffersCount }} yeni</span>
                            @else
                                <span class="text-xs text-slate-400">Güncel</span>
                            @endif
                        </div>
                        <div class="max-h-80 overflow-y-auto">
                            @forelse($recentUnreadOffers as $offer)
                                <a href="{{ route('admin.offers.index') }}" class="block px-4 py-3 hover:bg-slate-50">
                                    <div class="text-sm font-semibold text-slate-700">{{ $offer->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $offer->email }} · {{ $offer->created_at->diffForHumans() }}</div>
                                    <div class="text-xs text-slate-500">
                                        {{ $offer->service ? ucfirst($offer->service) : 'Hizmet seçilmedi' }}
                                    </div>
                                </a>
                            @empty
                                <div class="px-4 py-6 text-center text-sm text-slate-500">
                                    Yeni teklif bildirimi yok.
                                </div>
                            @endforelse
                        </div>
                        <div class="border-t">
                            <a href="{{ route('admin.offers.index') }}" class="block px-4 py-3 text-center text-sm font-medium text-blue-600 hover:bg-blue-50">
                                Tüm teklifleri görüntüle
                            </a>
                        </div>
                    </div>
                </div>
                <div class="text-sm text-gray-500">{{ session('admin_name', session('admin_email')) }}</div>
            </div>
        </header>
        <main class="p-4 md:p-8">
            @if(session('success'))
                <div class="mb-4 bg-green-50 text-green-800 border border-green-200 px-4 py-3 rounded-lg">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>

</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
</html>


