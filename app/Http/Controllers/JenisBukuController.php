<?php

namespace App\Http\Controllers;

use App\Models\JenisBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisBukuController extends Controller
{
    public function getAllSuper(){
        $jenisbukus = JenisBuku::paginate(10);
        return view('super-admin.jenis-buku',compact('jenisbukus'));
    }

    public function getAllAdmin(){
        $jenisbukus = JenisBuku::paginate(10);
        return view('admin.jenis-buku',compact('jenisbukus'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            toast('Gagal menambah data','error');
            return back()->withErrors($validator)->withInput();
        } else {
            $data = new JenisBuku();
            $data -> nama = $request->input('nama');
            $result = $data->save();
            if($result){
                toast('Berhasil menambah data','success');
                return back();
            }
        }
    }
    public function update(Request $request, JenisBuku $jenisbuku){

        $validator = Validator::make($request->all(),[
            'nama' => 'required|string|max:255',
        ]);
        if($validator->fails()){
            toast('Gagal menambah data','error');
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
        $jenisbuku->update([
            'nama' => $request->nama,
        ]);
        toast('Berhasil menambah data','success');
        return back();
    }

    public function delete(JenisBuku $jenisbuku){
    
        if($jenisbuku->delete()) {
            // Alert::success('Hore!', 'Berhasil menambah data jenisbuku');
            toast('Berhasil menghapus data','success');
            return back();
        }
        toast('Berhasil menghapus data','error');
        return back();
    }
}
