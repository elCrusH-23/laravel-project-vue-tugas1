<?php

namespace App\Http\Controllers;

use App\Models\Daftarjurusan;
use Illuminate\Http\Request;

class DaftarjurusanController extends Controller
{
    public function index()
    {
        return view ('daftarjurusan/index');
    }

    public function get_product_paging()
    {
        $paging = request('paging');
        $search = request('search');
        $data = Daftarjurusan::when($search, function ($query, $search) {
            return $query->where('jurusan', 'like', "%$search%")
                ->orWhere('type', 'like', "%$search%");
        })
        ->select(['id','jurusan', 'type'])->orderBy('jurusan')->paginate($paging);

    return response()->json($data);
    }
    public function store_daftarjurusan()
    {
        $id_edit = request('id_edit');
        if($id_edit !="null") {
            $data= Daftarjurusan::find($id_edit);
            $data->jurusan=request('jurusan');
            $data->type=request('type');
            $data-> save();
        }else {
        $data= new Daftarjurusan;
        $data->jurusan=request('jurusan');
        $data->type=request('type');
        $data-> save();
        }

        return response()-> json('sukses',200);
    }
    public function get_detail($id)
    {
        $dt = Daftarjurusan::find($id);
        return response()->json($dt,200);
    }
    public function hapus_daftarjurusan($id)
    {
        Daftarjurusan::where('id', $id) ->delete();

        return response()->json('sukses',200);
    }
}
