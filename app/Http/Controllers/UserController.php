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

            $bukuIds = $request->session()->get('cart', []);
            $bukucarts = Buku::whereIn('id', $bukuIds)->get();

            $bukus = Buku::where('sekolah_id', $currentUserSekolahId)->get();
            $ebooks = Buku::where('sekolah_id', $currentUserSekolahId)
                ->where('jenis_buku_id', 2)->get();
            return view('index', compact('jenisbukus', 'bukus', 'ebooks', 'bukucarts'));
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
        return view('buku',compact('jenisbukus','bukus','bukucarts','jenisbuku'));
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
    
        // Validasi stok dan ambil buku-buku dari keranjang
        $bukus = Buku::whereIn('id', $bukuIds)->where('stok', '>', 0)->get();
    
        if ($bukus->count() === 0) {
            return back()->with('toast_error', 'Semua buku dalam keranjang sudah habis stoknya.');
        }
    
        // Simpan data peminjaman
        $peminjaman = new Peminjaman([
            'denda' => 0,
            'kondisi_buku' => 'belum di isi',
            'user_id' => auth()->user()->id,
            'sekolah_id' => $currentUserSekolahId,
            'konfirmasi_pinjam' => 'tertunda',
            'konfirmasi_kembali' => 'tertunda',
        ]);
        $peminjaman->save();
    
        // Synchronize buku-buku ke peminjaman
        $peminjaman->bukus()->sync($bukus->pluck('id'));
    
        // Kurangi stok buku
        $bukus->each(function ($buku) {
            $buku->stok--;
            $buku->save();
        });
    
        // Hapus keranjang setelah checkout
        $request->session()->forget('cart');
    
        toast('Pemesanan berhasil! Terima kasih.','toast_success');
        return back();
    }
    
    
}
