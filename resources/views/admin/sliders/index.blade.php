@extends('admin.layouts.app')

@section('title', 'Sliderlar - Admin')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Sliderlar</h1>
        <a href="{{ route('admin.sliders.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Yeni Slider</a>
    </div>

    <div class="bg-white border rounded-xl overflow-hidden">
        <div class="px-4 py-3 bg-gray-50 border-b flex items-center justify-between">
            <div class="text-sm text-gray-600">Sürükle-bırak ile sıralamayı değiştirebilirsiniz.</div>
            <button id="saveSliderOrder" class="hidden bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded">Sıralamayı Kaydet</button>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Taşı</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Başlık (TR)</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Görsel</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durum</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody id="sortableSliderBody" class="divide-y divide-gray-200">
                @forelse($sliders as $slider)
                    <tr data-id="{{ $slider->id }}" class="hover:bg-gray-50">
                        <td class="px-4 py-3 cursor-move select-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M4 14h16"/></svg>
                        </td>
                        <td class="px-4 py-3">{{ $slider->title_tr }}</td>
                        <td class="px-4 py-3">
                            @if($slider->image_path)
                                <img src="{{ asset('storage/'.$slider->image_path) }}" alt="" class="h-10 w-20 object-cover rounded">
                            @else
                                <span class="text-gray-400 text-sm">Yok</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded {{ $slider->status === 'active' ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-700' }}">{{ $slider->status }}</span>
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.sliders.edit', $slider) }}" class="text-blue-600 hover:underline">Düzenle</a>
                            <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Sil</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Henüz slider yok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">{{ $sliders->links() }}</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        (function(){
            const el = document.getElementById('sortableSliderBody');
            if(!el) return;
            const saveBtn = document.getElementById('saveSliderOrder');
            new Sortable(el, {
                handle: '.cursor-move',
                animation: 150,
                onUpdate: function(){ saveBtn.classList.remove('hidden'); }
            });
            saveBtn?.addEventListener('click', async function(){
                const ids = Array.from(el.querySelectorAll('tr[data-id]')).map(tr => parseInt(tr.getAttribute('data-id')));
                const res = await fetch('{{ route('admin.sliders.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ ids })
                });
                if(res.ok){
                    saveBtn.classList.add('hidden');
                } else {
                    alert('Sıralama kaydedilemedi.');
                }
            });
        })();
    </script>
@endsection


