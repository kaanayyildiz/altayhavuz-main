<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;

class OfferController extends Controller
{
    public function index()
    {
        Offer::where('is_read', false)->update(['is_read' => true]);

        $offers = Offer::latest()->paginate(20);
        return view('admin.offers.index', compact('offers'));
    }

    public function toggleRead(Offer $offer)
    {
        $offer->is_read = !$offer->is_read;
        $offer->save();
        return back()->with('success', $offer->is_read ? 'Teklif okundu olarak işaretlendi.' : 'Teklif okunmadı olarak işaretlendi.');
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        return back()->with('success', 'Teklif silindi.');
    }

    public function bulkMarkRead(\Illuminate\Http\Request $request)
    {
        $ids = $request->input('selected', []);
        if (!empty($ids)) {
            Offer::whereIn('id', $ids)->update(['is_read' => true]);
            return back()->with('success', 'Seçili teklifler okundu olarak işaretlendi.');
        }
        return back();
    }

    public function bulkDelete(\Illuminate\Http\Request $request)
    {
        $ids = $request->input('selected', []);
        if (!empty($ids)) {
            Offer::whereIn('id', $ids)->delete();
            return back()->with('success', 'Seçili teklifler silindi.');
        }
        return back();
    }
}


