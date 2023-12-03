<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class ChartPeminjamanController extends Controller
{
    public function addToCart(Request $request, Buku $buku)
    {
        // Ambil buku dari database
        // $buku = Buku::find();

        // Cek apakah buku tersedia
        if (!$buku) {
            return back()->with('toast_error','buku tidak ditemukan');
        }

        // Cek apakah buku sudah ada di keranjang
        if ($request->session()->has('cart') && in_array($buku->id, $request->session()->get('cart'))) {
            return back()->with('toast_error','buku telah ada di keranjang');
        }

        // Tambahkan buku ke keranjang
        $request->session()->push('cart', $buku->id);

        return back()->with('toast_succes','Buku ditambah di keranjang');
    }

    public function viewCart(Request $request)
    {
        // Ambil data buku dari session cart
        $bukuIds = $request->session()->get('cart', []);
        $bukucarts = Buku::whereIn('id', $bukuIds)->get();

        return view('buku', compact('bukucarts'));
    }

    public function removeFromCart(Request $request, $bukuId)
    {
        // Hapus buku dari session cart
        $request->session()->forget('cart', $bukuId);

        return response()->json(['message' => 'Buku dihapus dari keranjang']);
    }
}
