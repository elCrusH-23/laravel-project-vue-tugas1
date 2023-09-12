<?php

namespace App\Http\Controllers;

use App\Models\Daftardosen;
use Illuminate\Http\Request;

class DaftardosenController extends Controller
{
    public function index()
    {
        return view ('daftardosen/index');
    }

    public function get_product_paging()
    {
        $paging = request('paging');
        $search = request('search');
        $data = Daftardosen::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%$search%")
                ->orWhere('type', 'like', "%$search%");
        })
        ->select(['id','nama','email','phone','NIP','type'])->orderBy('nama')->paginate($paging);

    return response()->json($data);
    }
    public function store_daftardosen()
    {
        $id_edit = request('id_edit');
        if($id_edit !="null") {
            $data= Daftardosen::find($id_edit);
            $data->nama=request('nama');
            $data->email=request('email');
            $data->phone=request('phone');
            $data->NIP=request('NIP');
            $data->type=request('type');
            $data-> save();
        }else {
        $data= new Daftardosen;
        $data->nama=request('nama');
        $data->email=request('email');
        $data->phone=request('phone');
        $data->NIP=request('NIP');
        $data->type=request('type');
        $data-> save();
        }

        return response()-> json('sukses',200);
    }
    public function get_detail($id)
    {
        $dt = Daftardosen::find($id);
        return response()->json($dt,200);
    }
    public function hapus_daftardosen($id)
    {
        Daftardosen::where('id', $id) ->delete();

        return response()->json('sukses',200);
    }
}
