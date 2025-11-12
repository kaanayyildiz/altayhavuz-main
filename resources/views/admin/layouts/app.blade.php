<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - ' . config('app.name'))</title>
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
            <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/services*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <span>Hizmetler</span>
            </a>
            <div class="px-3 py-2 text-xs font-semibold text-slate-400 uppercase">Ana Sayfa İçeriği</div>
            <a href="{{ route('admin.home.why.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/home/why*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Neden Biz?</span>
            </a>
            <a href="{{ route('admin.home.core-values.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/home/core-values*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3zm0 2c2.21 0 4 1.343 4 3v3H8v-3c0-1.657 1.79-3 4-3zM6 19h12v2H6z"/></svg>
                <span>Temel Değerler</span>
            </a>
            <a href="{{ route('admin.home.mission.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/home/mission-vision') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m9 3V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2z"/></svg>
                <span>Misyon &amp; Vizyon</span>
            </a>
            <a href="{{ route('admin.home.faqs.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/home/faqs*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 16.5a2.5 2.5 0 01-2.5 2.5H7l-4 4V5.5A2.5 2.5 0 015.5 3h13A2.5 2.5 0 0121 5.5v11z"/></svg>
                <span>Popüler Sorular</span>
            </a>
            <div class="mx-3 my-3 border-t border-slate-200"></div>
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
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M3.66122 10.6392C4.13377 10.9361 4.43782 11.4419 4.43782 11.9999C4.43781 12.558 4.13376 13.0638 3.66122 13.3607C3.33966 13.5627 3.13248 13.7242 2.98508 13.9163C2.66217 14.3372 2.51966 14.869 2.5889 15.3949C2.64082 15.7893 2.87379 16.1928 3.33973 16.9999C3.80568 17.8069 4.03865 18.2104 4.35426 18.4526C4.77508 18.7755 5.30694 18.918 5.83284 18.8488C6.07287 18.8172 6.31628 18.7185 6.65196 18.5411C7.14544 18.2803 7.73558 18.2699 8.21895 18.549C8.70227 18.8281 8.98827 19.3443 9.00912 19.902C9.02332 20.2815 9.05958 20.5417 9.15224 20.7654C9.35523 21.2554 9.74458 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8478 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.9021C15.0117 19.3443 15.2977 18.8281 15.7811 18.549C16.2644 18.27 16.8545 18.2804 17.3479 18.5412C17.6837 18.7186 17.9271 18.8173 18.1671 18.8489C18.693 18.9182 19.2249 18.7756 19.6457 18.4527C19.9613 18.2106 20.1943 17.807 20.6603 17C20.8677 16.6407 21.029 16.3614 21.1486 16.1272M20.3387 13.3608C19.8662 13.0639 19.5622 12.5581 19.5621 12.0001C19.5621 11.442 19.8662 10.9361 20.3387 10.6392C20.6603 10.4372 20.8674 10.2757 21.0148 10.0836C21.3377 9.66278 21.4802 9.13092 21.411 8.60502C21.3591 8.2106 21.1261 7.80708 20.6601 7.00005C20.1942 6.19301 19.9612 5.7895 19.6456 5.54732C19.2248 5.22441 18.6929 5.0819 18.167 5.15113C17.927 5.18274 17.6836 5.2814 17.3479 5.45883C16.8544 5.71964 16.2643 5.73004 15.781 5.45096C15.2977 5.1719 15.0117 4.6557 14.9909 4.09803C14.9767 3.71852 14.9404 3.45835 14.8478 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74458 2.35523 9.35523 2.74458 9.15224 3.23463C9.05958 3.45833 9.02332 3.71848 9.00912 4.09794C8.98826 4.65566 8.70225 5.17191 8.21891 5.45096C7.73557 5.73002 7.14548 5.71959 6.65205 5.4588C6.31633 5.28136 6.0729 5.18269 5.83285 5.15108C5.30695 5.08185 4.77509 5.22436 4.35427 5.54727C4.03866 5.78945 3.80569 6.19297 3.33974 7C3.13231 7.35929 2.97105 7.63859 2.85138 7.87273"></path>
                </svg>
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
                <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/services*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span>Hizmetler</span>
                </a>
            <div class="px-3 py-2 text-xs font-semibold text-slate-400 uppercase">Ana Sayfa İçeriği</div>
            <a href="{{ route('admin.home.why.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/home/why*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Neden Biz?</span>
            </a>
            <a href="{{ route('admin.home.core-values.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/home/core-values*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3zm0 2c2.21 0 4 1.343 4 3v3H8v-3c0-1.657 1.79-3 4-3zM6 19h12v2H6z"/></svg>
                <span>Temel Değerler</span>
            </a>
            <a href="{{ route('admin.home.mission.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/home/mission-vision') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m9 3V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2z"/></svg>
                <span>Misyon &amp; Vizyon</span>
            </a>
            <a href="{{ route('admin.home.faqs.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-700 {{ request()->is('admin/home/faqs*') ? 'bg-blue-50 text-blue-700 font-semibold' : 'text-slate-700' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 16.5a2.5 2.5 0 01-2.5 2.5H7l-4 4V5.5A2.5 2.5 0 015.5 3h13A2.5 2.5 0 0121 5.5v11z"/></svg>
                <span>Popüler Sorular</span>
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
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M3.66122 10.6392C4.13377 10.9361 4.43782 11.4419 4.43782 11.9999C4.43781 12.558 4.13376 13.0638 3.66122 13.3607C3.33966 13.5627 3.13248 13.7242 2.98508 13.9163C2.66217 14.3372 2.51966 14.869 2.5889 15.3949C2.64082 15.7893 2.87379 16.1928 3.33973 16.9999C3.80568 17.8069 4.03865 18.2104 4.35426 18.4526C4.77508 18.7755 5.30694 18.918 5.83284 18.8488C6.07287 18.8172 6.31628 18.7185 6.65196 18.5411C7.14544 18.2803 7.73558 18.2699 8.21895 18.549C8.70227 18.8281 8.98827 19.3443 9.00912 19.902C9.02332 20.2815 9.05958 20.5417 9.15224 20.7654C9.35523 21.2554 9.74458 21.6448 10.2346 21.8478C10.6022 22 11.0681 22 12 22C12.9319 22 13.3978 22 13.7654 21.8478C14.2554 21.6448 14.6448 21.2554 14.8478 20.7654C14.9404 20.5417 14.9767 20.2815 14.9909 19.9021C15.0117 19.3443 15.2977 18.8281 15.7811 18.549C16.2644 18.27 16.8545 18.2804 17.3479 18.5412C17.6837 18.7186 17.9271 18.8173 18.1671 18.8489C18.693 18.9182 19.2249 18.7756 19.6457 18.4527C19.9613 18.2106 20.1943 17.807 20.6603 17C20.8677 16.6407 21.029 16.3614 21.1486 16.1272M20.3387 13.3608C19.8662 13.0639 19.5622 12.5581 19.5621 12.0001C19.5621 11.442 19.8662 10.9361 20.3387 10.6392C20.6603 10.4372 20.8674 10.2757 21.0148 10.0836C21.3377 9.66278 21.4802 9.13092 21.411 8.60502C21.3591 8.2106 21.1261 7.80708 20.6601 7.00005C20.1942 6.19301 19.9612 5.7895 19.6456 5.54732C19.2248 5.22441 18.6929 5.0819 18.167 5.15113C17.927 5.18274 17.6836 5.2814 17.3479 5.45883C16.8544 5.71964 16.2643 5.73004 15.781 5.45096C15.2977 5.1719 15.0117 4.6557 14.9909 4.09803C14.9767 3.71852 14.9404 3.45835 14.8478 3.23463C14.6448 2.74458 14.2554 2.35523 13.7654 2.15224C13.3978 2 12.9319 2 12 2C11.0681 2 10.6022 2 10.2346 2.15224C9.74458 2.35523 9.35523 2.74458 9.15224 3.23463C9.05958 3.45833 9.02332 3.71848 9.00912 4.09794C8.98826 4.65566 8.70225 5.17191 8.21891 5.45096C7.73557 5.73002 7.14548 5.71959 6.65205 5.4588C6.31633 5.28136 6.0729 5.18269 5.83285 5.15108C5.30695 5.08185 4.77509 5.22436 4.35427 5.54727C4.03866 5.78945 3.80569 6.19297 3.33974 7C3.13231 7.35929 2.97105 7.63859 2.85138 7.87273"></path>
                    </svg>
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
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-md transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    <span class="hidden sm:inline">Siteyi Görüntüle</span>
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


