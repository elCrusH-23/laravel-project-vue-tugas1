<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index() {

        return view('dosen.index');
    }
    public function get_dosen(){
        $data_dosen=Dosen::orderBy('id','desc')->get();

        return response()->json($data_dosen);
    }
    public function store_dosen(){
        $id_edit = request('id_edit');
        if ($id_edit !="null") {
            $data_dosen=Dosen::find($id_edit);
            $data_dosen->nama=request('nama');
            $data_dosen->email=request('email');
            $data_dosen->phone=request('phone');
            $data_dosen->save();
        }else {
            $data_dosen=new Dosen;
            $data_dosen->nama=request('nama');
            $data_dosen->email=request('email');
            $data_dosen->phone=request('phone');
            $data_dosen->save();
        }

        return response()->json('sukses',200);
    }
    public function get_detail($id){
        $dt=Dosen::find($id);

        return response()->json($dt,200);
    }
    public function hapus_dosen($id) {
        Dosen::where('id',$id)->delete();

        return response()->json('sukses',200);
    }
}
