<?php

namespace App\Http\Controllers;

use App\Models\LokasiBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LokasiBukuController extends Controller
{
    public function getAllSuper(){
        $lokasibukus = LokasiBuku::paginate(10);
        return view('super-admin.lokasi-buku',compact('lokasibukus'));
    }

    public function getAllAdmin(){
        $lokasibukus = LokasiBuku::paginate(10);
        return view('admin.lokasi-buku',compact('lokasi-bukus'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'lokasi' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            toast('Gagal menambah data','error');
            return back()->withErrors($validator)->withInput();
        } else {
            $data = new LokasiBuku();
            $data -> lokasi = $request->input('lokasi');
            $result = $data->save();
            if($result){
                toast('Berhasil menambah data','success');
                return back();
            }
        }
    }
    public function update(Request $request, LokasiBuku $lokasibuku){

        $validator = Validator::make($request->all(),[
            'lokasi' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            toast('Gagal mengubah data','error');
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $lokasibuku->update([
            'lokasi' => $request->lokasi,
        ]);
        toast('Berhasil mengubah data','success');
        return back();
    }

    public function delete(LokasiBuku $lokasibuku){
    
        if($lokasibuku->delete()) {
            // Alert::success('Hore!', 'Berhasil menambah data jenisbuku');
            toast('Berhasil menghapus data','success');
            return back();
        }
        toast('Berhasil menghapus data','error');
        return back();
    }
}
