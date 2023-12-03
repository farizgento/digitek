<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\JenisBuku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if (auth()->check()) {
            $currentUserSekolahId = auth()->user()->sekolah_id;
            $jenisbukus = JenisBuku::where('sekolah_id', $currentUserSekolahId)->get();
            $bukus = Buku::where('sekolah_id', $currentUserSekolahId)->get();
            $ebooks = Buku::where('sekolah_id', $currentUserSekolahId)
                ->where('jenis_buku_id', 1)->get();
            return view('index', compact('jenisbukus', 'bukus', 'ebooks'));
        } else {
            $bukus = Buku::whereNull('sekolah_id')->get();
    
            return view('index', compact('bukus'));
        }
    }
    
    public function buku(Request $request, JenisBuku $jenisbuku){
        $currentUserSekolahId = auth()->user()->sekolah_id;
        $jenisbukus = JenisBuku::where('sekolah_id', $currentUserSekolahId)->get();

        $bukuIds = $request->session()->get('cart', []);
        $bukucarts = Buku::whereIn('id', $bukuIds)->get();
        // Ambil buku berdasarkan jenis buku yang dipilih
        $bukus = Buku::where('sekolah_id', $currentUserSekolahId)
        ->where('jenis_buku_id', $jenisbuku->id)
        ->get();
        return view('buku',compact('jenisbukus','bukus','bukucarts'));
    }
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
        toast('Berhasil di tambahkan di keranjang','success');
        return back();
    }
    public function removeFromCart(Request $request, Buku $buku)
    {
        $cart = $request->session()->get('cart', []);

        // Filter id buku dari array keranjang
        $cart = array_filter($cart, function ($item) use ($buku) {
            return $item !== $buku->id;
        });
    
        $request->session()->put('cart', $cart);

        return back()->with('toast_success', 'Berhasil dihapus dari keranjang');
    }
    public function checkout(Request $request)
    {
        $bukuIds = $request->session()->get('cart', []);
    
        // Validasi apakah keranjang tidak kosong
        if (empty($bukuIds)) {
            return back()->with('toast_error', 'Keranjang belanja kosong. Tambahkan buku ke keranjang terlebih dahulu.');
        }
    
        $currentUserSekolahId = auth()->user()->sekolah_id;
    
        // Attach buku-buku ke peminjaman dengan melakukan validasi stok terlebih dahulu
        $bukus = Buku::whereIn('id', $bukuIds)->get();
        dd($bukus);
        foreach ($bukus as $buku) {
            // Validasi stok sebelum membuat peminjaman
            if ($buku->stok > 0) {
                $buku->stok--; // Kurangi stok
                $buku->save(); // Simpan perubahan stok
            } else {
                // Jika stok sudah habis, batalkan peminjaman dan beri pesan ke pengguna
                return back()->with('toast_error', 'Buku ' . $buku->judul . ' tidak dapat dipinjam karena stok habis.');
            }
        }
    
        // Simpan data peminjaman setelah validasi stok
        $peminjaman = new Peminjaman();
        $peminjaman->denda = 0; // Atur denda sesuai kebutuhan
        $peminjaman->kondisi_buku = 'belum di isi';
        $peminjaman->user_id = auth()->user()->id;
        $peminjaman->sekolah_id = $currentUserSekolahId;
        $peminjaman->konfirmasi_pinjam = 'ditunda';
        $peminjaman->konfirmasi_kembali = 'ditunda';
        $peminjaman->save();
    
        foreach ($bukus as $buku) {
            $peminjaman->buku()->save($buku);
        }
    
        // Hapus keranjang setelah checkout
        $request->session()->forget('cart');
        toast('Pemesanan berhasil! Terima kasih.','toast_success');
        return back();
    }
    
}
