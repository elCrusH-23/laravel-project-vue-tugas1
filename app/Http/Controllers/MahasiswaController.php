<?php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
class MahasiswaController extends Controller
{
    //
    public function index()
    {
        //
        return view('mahasiswa.index');
    }
    public function get_data() {
        $data_mahasiswa = Mahasiswa::orderBy('id','desc')->get();

        return response()-> json($data_mahasiswa);
    }
    public function store_mahasiswa() {
        $id_edit = request('id_edit');
        if($id_edit !="null") {
            $data_mahasiswa= Mahasiswa::find($id_edit);
            $data_mahasiswa->nama=request('nama');
            $data_mahasiswa->alamat=request('alamat');
            $data_mahasiswa-> save();
        }else {
        $data_mahasiswa= new Mahasiswa;
        $data_mahasiswa->nama=request('nama');
        $data_mahasiswa->alamat=request('alamat');
        $data_mahasiswa-> save();
        }

        return response()-> json('sukses',200);
    }
    public function get_detail($id){
        $dt = Mahasiswa::find($id);
        return response()->json($dt,200);
    }
    public function hapus_mahasiswa($id){
        Mahasiswa::where('id', $id) ->delete();

        return response()->json('sukses',200);
    }
}