<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\JenisBuku;
use App\Models\LokasiBuku;
use App\Models\Sekolah;
use App\Models\TipeBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function getAllSuper(){
        $bukus = Buku::with('sekolah','tipebuku','jenisbuku','lokasibuku')->paginate(10);
        $sekolahs = Sekolah::all();
        $tipebukus = TipeBuku::all();
        $jenisbukus = JenisBuku::all();
        $lokasibukus = LokasiBuku::all();

        return view('super-admin.buku',compact(
            'bukus',
            'sekolahs',
            'tipebukus',
            'jenisbukus',
            'lokasibukus',
        ));
    }

    public function getAllAdmin(){
        $bukus = Buku::paginate(10);
        return view('admin.-buku',compact('bukus'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'judul'=> 'string|max:100',
            'penulis'=> 'string|max:100',
            'penerbitan'=> 'string|max:100',
            'edisi'=> 'string|max:100',
            'bulan'=> 'string|max:100',
            'isbn'=> 'string|max:100',
            'subyek'=> 'string|max:100',
            'jenis'=> 'string|max:100',
            'path'=> 'string|max:100',
            'volume'=> 'string|max:100',
            'sampul_buku'=> 'string|max:100',
            'lokasi_buku_id'=> 'string|max:100',
            'tipe_buku_id'=> 'string|max:100',
            'jenis_buku_id'=> 'string|max:100',
            'sekolah_id'=> 'string|max:100',
        ]);
        if($validator->fails()){
            toast('Gagal menambah data','error');
            return back()->withErrors($validator)->withInput();
        } else {
            $data = new Buku();
            $data->judul = $request->input('judul');
            $data->penulis = $request->input('penulis');
            $data->penerbitan = $request->input('penerbitan');
            $data->edisi = $request->input('edisi');
            $data->bulan = $request->input('bulan');
            $data->isbn = $request->input('isbn');
            $data->subyek = $request->input('subyek');
            $data->jenis = $request->input('jenis');
            $data->path = $request->input('path');
            $data->volume = $request->input('volume');
            $data->sampul_buku = $request->input('sampul_buku');
            $data->lokasi_buku_id = $request->input('lokasi_buku_id');
            $data->tipe_buku_id = $request->input('tipe_buku_id');
            $data->jenis_buku_id = $request->input('jenis_buku_id');
            $data->sekolah_id = $request->input('sekolah_id');
            $result = $data->save();
            if($result){
                toast('Berhasil menambah data','success');
                return back();
            }
        }
    }
    public function update(Request $request, Buku $buku){

        $validator = Validator::make($request->all(),[
            'judul'=> 'string|max:100',
            'penulis'=> 'string|max:100',
            'penerbitan'=> 'string|max:100',
            'edisi'=> 'string|max:100',
            'bulan'=> 'string|max:100',
            'isbn'=> 'string|max:100',
            'subyek'=> 'string|max:100',
            'jenis'=> 'string|max:100',
            'path'=> 'string|max:100',
            'volume'=> 'string|max:100',
            'sampul_buku'=> 'string|max:100',
            'lokasi_buku_id'=> 'string|max:100',
            'tipe_buku_id'=> 'string|max:100',
            'jenis_buku_id'=> 'string|max:100',
            'sekolah_id'=> 'string|max:100',
        ]);
        if($validator->fails()){
            toast('Gagal mengubah data','error');
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $buku->update([
            'judul' => $request->input('judul'),
            'penulis' => $request->input('penulis'),
            'penerbitan' => $request->input('penerbitan'),
            'edisi' => $request->input('edisi'),
            'bulan' => $request->input('bulan'),
            'isbn' => $request->input('isbn'),
            'subyek' => $request->input('subyek'),
            'jenis' => $request->input('jenis'),
            'path' => $request->input('path'),
            'volume' => $request->input('volume'),
            'sampul_buku' => $request->input('sampul_buku'),
            'lokasi_buku_id' => $request->input('lokasi_buku_id'),
            'tipe_buku_id' => $request->input('tipe_buku_id'),
            'jenis_buku_id' => $request->input('jenis_buku_id'),
            'sekolah_id' => $request->input('sekolah_id'),
        ]);
        toast('Berhasil mengubah data','success');
        return back();
    }

    public function delete(Buku $buku){
    
        if($buku->delete()) {
            // Alert::success('Hore!', 'Berhasil menambah data jenisbuku');
            toast('Berhasil menghapus data','success');
            return back();
        }
        toast('Gagal menghapus data','error');
        return back();
    }
}
