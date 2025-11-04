@extends('admin.layouts.app')

@section('title', 'Portfolyo - Admin')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Portfolyo</h1>
        <a href="{{ route('admin.portfolios.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Yeni Öğe</a>
    </div>

    <div class="bg-white border rounded-xl overflow-hidden overflow-x-auto">
        <div class="px-4 py-3 bg-gray-50 border-b flex items-center justify-between">
            <div class="text-sm text-gray-600">Sürükle-bırak ile sıralamayı değiştirebilirsiniz.</div>
            <button id="saveOrder" class="hidden bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded">Sıralamayı Kaydet</button>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Taşı</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Görsel</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tür</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durum</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody id="sortableBody" class="divide-y divide-gray-200">
                @forelse($portfolios as $portfolio)
                    <tr data-id="{{ $portfolio->id }}" class="hover:bg-gray-50">
                        <td class="px-4 py-3 cursor-move select-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M4 14h16"/></svg>
                        </td>
                        <td class="px-4 py-3">
                            <img src="{{ asset('storage/'.$portfolio->image_path) }}" class="h-12 w-20 object-cover rounded">
                        </td>
                        <td class="px-4 py-3">{{ $portfolio->type }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded {{ $portfolio->status === 'active' ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-700' }}">{{ $portfolio->status }}</span>
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="text-blue-600 hover:underline">Düzenle</a>
                            <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Sil</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Henüz öğe yok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $portfolios->links() }}</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        (function(){
            const el = document.getElementById('sortableBody');
            if(!el) return;
            const saveBtn = document.getElementById('saveOrder');
            let changed = false;
            new Sortable(el, {
                handle: '.cursor-move',
                animation: 150,
                onUpdate: function(){ changed = true; saveBtn.classList.remove('hidden'); }
            });
            saveBtn?.addEventListener('click', async function(){
                const ids = Array.from(el.querySelectorAll('tr[data-id]')).map(tr => parseInt(tr.getAttribute('data-id')));
                const res = await fetch('{{ route('admin.portfolios.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ ids })
                });
                if(res.ok){
                    changed = false; saveBtn.classList.add('hidden');
                } else {
                    alert('Sıralama kaydedilemedi.');
                }
            });
        })();
    </script>
@endsection


