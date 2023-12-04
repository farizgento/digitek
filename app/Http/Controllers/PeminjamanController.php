<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\JenisBuku;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    public function getAllsuper(){
        $peminjamans = Peminjaman::with('users','bukus')->paginate(10);
        return view('super-admin.peminjaman',compact('peminjamans'));
    }

    public function AdmingetBySekolahID(Request $request){
        if(auth()->check()){
            $currentUserSekolahId = auth()->user()->sekolah_id;
            // Dapatkan peminjaman yang terkait dengan pengguna
            // Dapatkan peminjaman yang terkait dengan pengguna
            $peminjamans = Peminjaman::with('users', 'bukus')->where('sekolah_id', $currentUserSekolahId)->paginate(10);

            return view('/admin/peminjaman',compact('peminjamans'));
        }
    }
    public function getByUser(Request $request){

        $currentUserSekolahId = auth()->user()->sekolah_id;
        $jenisbukus = JenisBuku::where('sekolah_id', $currentUserSekolahId)->get();
        $bukuIds = $request->session()->get('cart', []);
        $bukucarts = Buku::whereIn('id', $bukuIds)->get();
        
        // Dapatkan ID pengguna yang sedang login
        $userId = auth()->user()->id;

        // Dapatkan peminjaman yang terkait dengan pengguna
        $peminjamans = Peminjaman::where('user_id', $userId)->paginate(10);
        $peminjamans->each(function ($peminjaman) {
        $peminjaman->judulbukus = $peminjaman->bukus->pluck('judul')->toArray();
        });

        // Jika peminjaman ditemukan, dapatkan buku-buku yang dipinjam
        if ($peminjamans) {
            // dd($bukusDipinjam);
            
            // Sekarang $bukusDipinjam berisi koleksi dari model Buku
            return view('peminjaman', compact('peminjamans','jenisbukus','bukucarts'));
        } else {
            // Jika tidak ada peminjaman, beri tahu pengguna bahwa belum ada buku yang dipinjam
            return view('peminjaman', ['bukusDipinjam' ]);
        }
    }
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validator = Validator::make($request->all(), [
            'denda' => 'numeric',
            'kondisi_buku' => 'string',
            'konfirmasi_pinjam' => 'string',
            'konfirmasi_kembali' => 'string',
            'tanggal_pengembalian' => 'date', // Tambahkan validasi untuk tanggal_pengembalian
        ]);
    
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->first())->withInput();
        }
    
        // Tangani tanggal_pengembalian terlebih dahulu
        if ($request->konfirmasi_pinjam === 'diterima' && !$peminjaman->tanggal_pengembalian) {
            // Setelah konfirmasi pinjam berubah menjadi "diterima", atur tanggal_pengembalian menjadi 14 hari ke depan
            $tanggalPengembalian = now()->addDays(14);
            $peminjaman->update([
                'tanggal_pengembalian' => $tanggalPengembalian,
            ]);
        } elseif ($request->konfirmasi_pinjam !== 'diterima') {
            // Jika konfirmasi pinjam tidak lagi "diterima", reset tanggal_pengembalian
            $peminjaman->update([
                'tanggal_pengembalian' => null,
            ]);
        }
    
        // Update field lain sesuai kebutuhan
        $peminjaman->update([
            'denda' => $request->input('denda'),
            'kondisi_buku' => $request->input('kondisi_buku'),
            'konfirmasi_pinjam' => $request->input('konfirmasi_pinjam'),
            'konfirmasi_kembali' => $request->input('konfirmasi_kembali'),
        ]);

        // terapkan kode nya disini
        $bukuIds = $peminjaman->bukus->pluck('id')->toArray();
        $bukus = Buku::whereIn('id', $bukuIds);
    
        // Tambah stok buku
        $bukus->each(function ($buku) {
            $buku->stok++;
            $buku->save();
        });
    
        toast('Berhasil Mengubah Data', 'success');
        return back();
    }
    public function destroy(Peminjaman $peminjaman)
    {
        // Mencegah penghapusan jika buku belum dikembalikan
        if ($peminjaman->konfirmasi_kembali !== 'diterima') {
            return back()->with('toast_error', 'Peminjaman belum dikembalikan, tidak dapat dihapus.');
        }

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Hapus relasi many-to-many antara Peminjaman dan Buku
            $peminjaman->bukus()->detach();

            // Hapus peminjaman dari database
            $peminjaman->delete();

            // Commit transaksi
            DB::commit();

            toast('Peminjaman berhasil dihapus', 'success');
            return back();
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            return back()->with('toast_error', 'Terjadi kesalahan saat menghapus peminjaman.');
        }
    }
    
}
