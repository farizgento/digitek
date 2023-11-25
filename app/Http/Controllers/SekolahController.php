<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SekolahController extends Controller
{
    public function getAllSuper(){
        $sekolahs = Sekolah::paginate(10);
        return view('super-admin.sekolah',compact('sekolahs'));
    }

    public function getAllAdmin(){
        $sekolahs = Sekolah::paginate(10);
        return view('admin.sekolah',compact('sekolahs'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            toast('Gagal menambah data','error');
            return back()->withErrors($validator)->withInput();
        } else {
            $data = new Sekolah();
            $data -> nama = $request->input('nama');
            $result = $data->save();
            if($result){
                toast('Berhasil menambah data','success');
                return back();
            }
        }
    }
    public function update(Request $request, sekolah $sekolah){

        $validator = Validator::make($request->all(),[
            'nama' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            toast('gagal mengubah data','error');
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $sekolah->update([
            'nama' => $request->nama,
        ]);
        toast('Berhasil mengubah data','success');
        return back();
    }

    public function delete(sekolah $sekolah){
    
        if($sekolah->delete()) {
            // Alert::success('Hore!', 'Berhasil menambah data sekolah');
            toast('Berhasil menghapus data','success');
            return redirect()->route('sekolah-superadmin');
        }
        toast('Berhasil menghapus data','error');
        return redirect()->route('sekolah-superadmin');
    }
}
