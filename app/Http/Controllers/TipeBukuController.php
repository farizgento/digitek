<?php

namespace App\Http\Controllers;

use App\Models\JenisBuku;
use App\Models\Sekolah;
use App\Models\TipeBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipeBukuController extends Controller
{
    public function getAllSuper(){
        $sekolahs = Sekolah::all();
        $tipebukus = TipeBuku::paginate(10);
        return view('super-admin.tipe-buku',compact('tipebukus','sekolahs'));
    }

    public function getAllAdmin(){

        $currentUserSekolahId = auth()->user()->sekolah_id;
        $tipebukus = TipeBuku::where('sekolah_id', $currentUserSekolahId)->paginate(10);
        return view('admin.tipe-buku',compact('tipebukus'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'sekolah_id' => 'required|string',
        ]);
        if($validator->fails()){
            toast('Gagal menambah data','error');
            return back()->withErrors($validator)->withInput();
        } else {
            $data = new TipeBuku();
            $data -> nama = $request->input('nama');
            $data -> sekolah_id = $request->input('sekolah_id');
            $result = $data->save();
            if($result){
                toast('Berhasil menambah data','success');
                return back();
            }
        }
    }
    public function update(Request $request, TipeBuku $tipebuku){

        $validator = Validator::make($request->all(),[
            'nama' => 'required|string|max:255',
            'sekolah_id' => 'required|string',
        ]);
        if($validator->fails()){
            toast('Gagal mengubah data','error');
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $tipebuku->update([
            'nama' => $request->nama,
            'sekolah_id' => $request->sekolah_id,
        ]);
        toast('Berhasil mengubah data','success');
        return back();
    }

    public function delete(TipeBuku $tipebuku){
    
        if($tipebuku->delete()) {
            // Alert::success('Hore!', 'Berhasil menambah data jenisbuku');
            toast('Berhasil menghapus data','success');
            return back();
        }
        toast('Gagal menghapus data','error');
        return back();
    }
}
