<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\JenisBuku;
use App\Models\LokasiBuku;
use App\Models\Sekolah;
use App\Models\TipeBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function getAllSuper(){
        $bukus = Buku::with('sekolah','tipebuku','jenisbuku','lokasibuku')->paginate(10);
        $sekolahs = Sekolah::all();
        $tipebukus = TipeBuku::all();
        $jenisbukus = JenisBuku::all();
        $lokasibukus = LokasiBuku::all();
        // Menambahkan nama tipe buku untuk setiap buku
        $bukus->each(function ($buku) {
            $buku->namatipebukus = $buku->tipebuku->pluck('nama')->toArray();
        });

        return view('super-admin.buku',compact(
            'bukus',
            'sekolahs',
            'tipebukus',
            'jenisbukus',
            'lokasibukus',
        ));
    }
    public function viewEbookGuest($nama){
        if (!$nama) {
            // Handle jika path PDF tidak tersedia
            abort(404);
        }
    
        $filePath = public_path('storage/ebook/' . $nama . '.pdf');
    
        if (!file_exists($filePath)) {
            // Handle jika file PDF tidak ditemukan
            abort(404);
        }
    
        return Response::file($filePath, ['content-type' => 'application/pdf']);
    }

    public function viewEbook(Buku $buku){
        if (!$buku->path) {
            // Handle jika path PDF tidak tersedia
            abort(404);
        }
        $filePath = public_path('storage/' . $buku->path);
    
        if (!file_exists($filePath)) {
            // Handle jika file PDF tidak ditemukan
            abort(404);
        }

        if (auth()->check()) {
            return Response::file($filePath, ['content-type' => 'application/pdf']);
        } else{
            toast('Silahkan Login terlebih dahulu untuk membaca ebook','error');
            return back();
        }
    }


    public function getAllAdmin(){
        $currentUserSekolahId = auth()->user()->sekolah_id;

        $bukus = Buku::with('sekolah','tipebuku','jenisbuku','lokasibuku')->where('sekolah_id', $currentUserSekolahId)->paginate(10);
        $tipebukus = TipeBuku::where('sekolah_id', $currentUserSekolahId)->get();
        $jenisbukus = JenisBuku::where('sekolah_id', $currentUserSekolahId)->get();
        $lokasibukus = LokasiBuku::where('sekolah_id', $currentUserSekolahId)->get();

        // Menambahkan nama tipe buku untuk setiap buku
        $bukus->each(function ($buku) {
            $buku->namatipebukus = $buku->tipebuku->pluck('nama')->toArray();
        });
        return view('admin.buku',compact(
            'bukus',
            'tipebukus',
            'jenisbukus',
            'lokasibukus',
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:100',
            'penulis' => 'required|string|max:100',
            'penerbitan' => 'required|string|max:100',
            'edisi' => 'nullable|string|max:100',
            'bulan' => 'required|date',
            'isbn' => 'required|numeric',
            'subyek' => 'nullable|string|max:100',
            'path' => 'mimes:pdf|max:10000',
            'volume' => 'nullable|string|max:100',
            'sampul_buku' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tipe_buku_id' => 'required|array',
            'lokasi_buku_id' => 'required|string|max:100',
            'jenis_buku_id' => 'required|string|max:100',
            'sekolah_id' => 'required|string|max:100',
            'stok' => 'nullable|numeric|max:1000',
        ]);
    
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
    
        $data = new Buku();
        $data->judul = $request->input('judul');
        $data->penulis = $request->input('penulis');
        $data->penerbitan = $request->input('penerbitan');
        $data->edisi = $request->input('edisi');
        $data->bulan = $request->input('bulan');
        $data->isbn = $request->input('isbn');
        $data->subyek = $request->input('subyek');
    
        if ($request->hasFile('path')) {
            $fileEbook = $request->file('path');
            $pdfName = time() . '.' . $fileEbook->getClientOriginalName() . '.' . $fileEbook->getClientOriginalExtension();
            $pdf = $fileEbook->storeAs('ebook', $pdfName, 'public');
            $data->path = $pdf;
        }
    
        $data->volume = $request->input('volume');
    
        if ($request->hasFile('sampul_buku')) {
            $fileSampul = $request->file('sampul_buku');
            $fileName = time() . '.' .  $fileSampul->getClientOriginalName() . '.' . $fileSampul->getClientOriginalExtension();
            $img = $fileSampul->storeAs('sampul', $fileName, 'public');
            $data->sampul_buku = $img;
        }
    
        $data->lokasi_buku_id = $request->input('lokasi_buku_id');
        $data->jenis_buku_id = $request->input('jenis_buku_id');
        $data->sekolah_id = $request->input('sekolah_id');
        $data->stok = $request->input('stok');
    
        $result = $data->save();

        
        if ($result) {
            // Hubungan many-to-many
            $data->tipebuku()->sync($request->input('tipe_buku_id', []));
            toast('Berhasil menambah data', 'success');
            return back();
        } else {
            toast('Gagal menambah data file', 'error');
            return back();
        }
    }
    
    public function update(Request $request, Buku $buku)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:100',
            'penulis' => 'required|string|max:100',
            'penerbitan' => 'required|string|max:100',
            'edisi' => 'nullable|string|max:100',
            'bulan' => 'required|date',
            'isbn' => 'required|string',
            'subyek' => 'nullable|string|max:100',
            'path' => 'nullable|mimes:pdf|max:10000',
            'volume' => 'nullable|string|max:100',
            'sampul_buku' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tipe_buku_id' => 'required|array',
            'lokasi_buku_id' => 'required|string|max:100',
            'jenis_buku_id' => 'required|string|max:100',
            'sekolah_id' => 'required|string|max:100',
        ]);
    
        if ($validator->fails()) {
            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }
        }
    
        // Proses file sampul buku jika diunggah
        if ($request->hasFile('sampul_buku')) {
            // Hapus gambar lama jika ada
            if ($buku->sampul_buku) {
                Storage::disk('public')->delete($buku->sampul_buku);
            }
    
            // Simpan gambar baru
            $fileSampul = $request->file('sampul_buku');
            $fileName = time() . '.' . $fileSampul->getClientOriginalName() . '.' . $fileSampul->getClientOriginalExtension();
            $img = $fileSampul->storeAs('sampul', $fileName, 'public');
        }
    
        // Proses file PDF jika diunggah
        if ($request->hasFile('path')) {
            // Hapus file PDF lama jika ada
            if ($buku->path) {
                Storage::disk('public')->delete($buku->path);
            }
    
            // Simpan file PDF baru
            $filePdf = $request->file('path');
            $pdfName = time() . '.' . $filePdf->getClientOriginalName() . '.' . $filePdf->getClientOriginalExtension();
            $pdf = $filePdf->storeAs('ebook', $pdfName, 'public');
        }
    
        // Update data buku
        $buku->update([
            'judul' => $request->input('judul'),
            'penulis' => $request->input('penulis'),
            'penerbitan' => $request->input('penerbitan'),
            'edisi' => $request->input('edisi'),
            'bulan' => $request->input('bulan'),
            'isbn' => $request->input('isbn'),
            'subyek' => $request->input('subyek'),
            'path' => isset($pdf) ? $pdf : $buku->path, // Gunakan file PDF baru atau yang lama
            'volume' => $request->input('volume'),
            'sampul_buku' => isset($img) ? $img : $buku->sampul_buku, // Gunakan gambar baru atau yang lama
            'lokasi_buku_id' => $request->input('lokasi_buku_id'),
            'jenis_buku_id' => $request->input('jenis_buku_id'),
            'sekolah_id' => $request->input('sekolah_id'),
        ]);

        // Hubungan many-to-many
        $buku->tipebuku()->sync($request->input('tipe_buku_id', []));

        toast('Berhasil mengganti data','success');
        return back();
    }
    

    public function delete(Buku $buku)
    {
        try {
            // Delete the image file before deleting the book entry
            if ($buku->sampul_buku) {
                // Delete the image file from storage
                Storage::disk('public')->delete($buku->sampul_buku);
            }
    
            if ($buku->path) {
                // Delete the PDF file from storage
                Storage::disk('public')->delete($buku->path);
            }
    
            // Detach tipebuku relationships before deleting the book entry
            $buku->tipebuku()->detach();
    
            // Delete the book entry
            if ($buku->delete()) {
                toast('Berhasil menghapus data', 'success');
                return back();
            } else {
                toast('Gagal menghapus data', 'error');
                return back();
            }
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the deletion process
            toast('Gagal menghapus data: ' . $e->getMessage(), 'error');
            return back();
        }
    }
}
