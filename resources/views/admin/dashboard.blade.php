@extends('admin.layouts.app')

@section('title', 'Admin Dashboard - ' . config('app.name'))

@section('content')
    <!-- Google Analytics Bilgisi -->
    @if($googleAnalyticsId)
        <div class="mb-6 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <div>
                        <div class="text-sm font-semibold text-gray-800">Google Analytics Aktif</div>
                        <div class="text-xs text-gray-600">Measurement ID: {{ $googleAnalyticsId }}</div>
                    </div>
                </div>
                <a href="https://analytics.google.com/" target="_blank" rel="noopener noreferrer" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                    Google Analytics'e Git →
                </a>
            </div>
        </div>
    @else
        <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div class="flex-1">
                    <div class="text-sm font-semibold text-gray-800">Google Analytics Ayarlanmamış</div>
                    <div class="text-xs text-gray-600">Google Analytics ID'yi ayarlamak için <a href="{{ route('admin.settings.edit') }}" class="text-blue-600 hover:underline">Ayarlar</a> sayfasına gidin.</div>
                </div>
            </div>
        </div>
    @endif

    <!-- Site İstatistikleri -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Site Ziyaretçi İstatistikleri</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl border p-6 shadow-sm hover:shadow-md transition text-white">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-sm text-blue-100">Bugünkü Ziyaretçiler</div>
                    <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div class="text-3xl font-extrabold">{{ $stats['today_unique_visitors'] }}</div>
                <div class="text-xs text-blue-100 mt-1">Benzersiz ziyaretçi</div>
            </div>
            
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl border p-6 shadow-sm hover:shadow-md transition text-white">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-sm text-green-100">Bugünkü Ziyaretler</div>
                    <svg class="w-6 h-6 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <div class="text-3xl font-extrabold">{{ $stats['today_total_visits'] }}</div>
                <div class="text-xs text-green-100 mt-1">Toplam sayfa görüntüleme</div>
            </div>
            
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl border p-6 shadow-sm hover:shadow-md transition text-white">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-sm text-purple-100">Son 7 Gün Ziyaretçi</div>
                    <svg class="w-6 h-6 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <div class="text-3xl font-extrabold">{{ $stats['last_7_days_visitors'] }}</div>
                <div class="text-xs text-purple-100 mt-1">Benzersiz ziyaretçi</div>
            </div>
            
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl border p-6 shadow-sm hover:shadow-md transition text-white">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-sm text-orange-100">Son 7 Gün Ziyaret</div>
                    <svg class="w-6 h-6 text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <div class="text-3xl font-extrabold">{{ $stats['last_7_days_visits'] }}</div>
                <div class="text-xs text-orange-100 mt-1">Toplam sayfa görüntüleme</div>
            </div>
            
            <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl border p-6 shadow-sm hover:shadow-md transition text-white">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-sm text-indigo-100">Toplam Ziyaretçi</div>
                    <svg class="w-6 h-6 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div class="text-3xl font-extrabold">{{ $stats['total_unique_visitors'] }}</div>
                <div class="text-xs text-indigo-100 mt-1">Tüm zamanlar</div>
            </div>
            
            <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl border p-6 shadow-sm hover:shadow-md transition text-white">
                <div class="flex items-center justify-between mb-2">
                    <div class="text-sm text-pink-100">Toplam Ziyaret</div>
                    <svg class="w-6 h-6 text-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="text-3xl font-extrabold">{{ $stats['total_visits'] }}</div>
                <div class="text-xs text-pink-100 mt-1">Tüm zamanlar</div>
            </div>
        </div>
    </div>

    <!-- İçerik İstatistikleri -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">İçerik İstatistikleri</h2>
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
    </div>

    <!-- Son Ziyaretçiler -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Son Ziyaretçiler</h2>
        <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Adresi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Referer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Agent</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ziyaret Tarihi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Saat</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentVisitors as $visitor)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900">
                                    {{ $visitor->ip_address }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="max-w-xs truncate" title="{{ $visitor->url }}">
                                        {{ $visitor->url ?: '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="max-w-xs truncate" title="{{ $visitor->referer }}">
                                        {{ $visitor->referer ?: '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="max-w-xs truncate" title="{{ $visitor->user_agent }}">
                                        {{ $visitor->user_agent ?: '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $visitor->visited_at ? $visitor->visited_at->format('d.m.Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $visitor->created_at ? $visitor->created_at->format('H:i:s') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                    Henüz ziyaretçi kaydı bulunmamaktadır.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($recentVisitors instanceof \Illuminate\Contracts\Pagination\Paginator && $recentVisitors->hasPages())
                <div class="px-6 py-4 border-t bg-gray-50">
                    {{ $recentVisitors->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection


