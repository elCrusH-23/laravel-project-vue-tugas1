<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index() {

        return view ('jurusan.index');
    }
    public function get_jurusan(){
        $data_jurusan = Jurusan::orderBy('id','desc')-> get();

        return response()->json($data_jurusan);

    }
    public function store_jurusan(){
        $id_edit=request('id_edit');
        if ($id_edit !="null"){
            $data_jurusan=Jurusan::find($id_edit);
            $data_jurusan->jurusan=request('jurusan');
            $data_jurusan->save();
        }else {
            $data_jurusan=new Jurusan;
            $data_jurusan->jurusan=request('jurusan');
            $data_jurusan->save();
        }

        return response()->json('sukses',200);
    }
    public function get_detail($id){
        $dt=Jurusan::find($id);

        return response()->json($dt,200);
    }
    public function hapus_jurusan($id){
        Jurusan::where('id',$id)->delete();

        return response()->json('sukses',200);
    }
}
