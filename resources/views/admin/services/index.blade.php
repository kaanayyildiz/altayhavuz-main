@extends('admin.layouts.app')

@section('title', 'Hizmetler - Admin')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Hizmetler</h1>
        <a href="{{ route('admin.services.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Yeni Hizmet</a>
    </div>

    <div class="bg-white border rounded-xl overflow-hidden overflow-x-auto">
        <div class="px-4 py-3 bg-gray-50 border-b flex items-center justify-between">
            <div class="text-sm text-gray-600">Sürükle-bırak ile sıralamayı değiştirebilirsiniz.</div>
            <button id="saveServiceOrder" class="hidden bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded">Sıralamayı Kaydet</button>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Taşı</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Başlık (TR)</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Başlık (EN)</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sıra</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durum</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anasayfa</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody id="sortableServiceBody" class="divide-y divide-gray-200">
                @forelse($services as $service)
                    <tr data-id="{{ $service->id }}" class="hover:bg-gray-50">
                        <td class="px-4 py-3 cursor-move select-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M4 14h16"/></svg>
                        </td>
                        <td class="px-4 py-3 text-gray-800 font-medium">{{ $service->title_tr ?: '—' }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $service->title_en ?: '—' }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $service->order }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded {{ $service->status === 'active' ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-700' }}">{{ $service->status }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded {{ $service->show_on_home ? 'bg-blue-50 text-blue-700' : 'bg-gray-100 text-gray-500' }}">{{ $service->show_on_home ? 'Evet' : 'Hayır' }}</span>
                        </td>
                        <td class="px-4 py-3 text-right space-x-2 whitespace-nowrap">
                            <a href="{{ route('admin.services.edit', $service) }}" class="text-blue-600 hover:underline">Düzenle</a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Sil</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">Henüz hizmet eklenmemiş.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        (function(){
            const tableBody = document.getElementById('sortableServiceBody');
            if(!tableBody) return;
            const saveBtn = document.getElementById('saveServiceOrder');

            new Sortable(tableBody, {
                handle: '.cursor-move',
                animation: 150,
                onUpdate: function(){ saveBtn.classList.remove('hidden'); }
            });

            saveBtn?.addEventListener('click', async function(){
                const ids = Array.from(tableBody.querySelectorAll('tr[data-id]')).map(tr => parseInt(tr.getAttribute('data-id')));
                const res = await fetch('{{ route('admin.services.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ ids })
                });
                if(res.ok){
                    saveBtn.classList.add('hidden');
                    location.reload();
                } else {
                    alert('Sıralama kaydedilemedi.');
                }
            });
        })();
    </script>
@endsection

