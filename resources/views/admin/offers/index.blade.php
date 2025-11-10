@extends('admin.layouts.app')

@section('title', 'Teklifler - ' . config('app.name'))

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Teklifler</h1>
    </div>

    <div class="bg-white rounded-lg border border-slate-200 overflow-hidden overflow-x-auto">
        <form method="POST" action="" x-data="{ all:false }" @change="if($event.target.id==='select_all'){ document.querySelectorAll('.offer-checkbox').forEach(cb=> cb.checked=$event.target.checked) }">
            @csrf
            <div class="flex items-center justify-between p-3 border-b bg-slate-50">
                <div class="space-x-2">
                    <button formaction="{{ route('admin.offers.bulkDelete') }}" onclick="return confirm('Seçili teklifleri silmek istediğinize emin misiniz?')" class="px-3 py-1 rounded border border-red-300 text-sm text-red-700 hover:bg-red-50">Seçilileri sil</button>
                </div>
            </div>
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-2"><input id="select_all" type="checkbox" class="rounded border-slate-300"></th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Ad Soyad</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">E-Posta</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Telefon</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Adres</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Hizmet</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tarih</th>
                    <th class="px-4 py-2 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">İşlemler</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @php
                    $serviceMapTr = [
                        'design' => 'Havuz Tasarım',
                        'construction' => 'Havuz Yapımı',
                        'maintenance' => 'Havuz Bakım',
                        'renovation' => 'Havuz Yenileme',
                        '' => '-',
                        null => '-',
                    ];
                @endphp
                @forelse($offers as $offer)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-2 align-top"><input name="selected[]" value="{{ $offer->id }}" type="checkbox" class="offer-checkbox rounded border-slate-300"></td>
                        <td class="px-4 py-2">{{ $offer->name }}</td>
                        <td class="px-4 py-2">{{ $offer->email }}</td>
                        <td class="px-4 py-2">{{ $offer->phone }}</td>
                        <td class="px-4 py-2">{{ $offer->address }}</td>
                        <td class="px-4 py-2">{{ $serviceMapTr[$offer->service] ?? $offer->service }}</td>
                        <td class="px-4 py-2 text-sm text-slate-500">{{ $offer->created_at->format('d.m.Y H:i') }}</td>
                        <td class="px-4 py-2 text-right">
                            <form action="{{ route('admin.offers.destroy', $offer) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button class="ml-2 px-3 py-1 rounded border border-red-300 text-xs text-red-700 hover:bg-red-50">Sil</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-slate-500">Henüz teklif bulunmuyor.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </form>
        <div class="p-4">{{ $offers->links() }}</div>
    </div>
@endsection


