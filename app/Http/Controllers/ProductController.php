<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view ('product/index');
    }

    public function get_product_paging()
    {
        $paging = request('paging');
        $search = request('search');
        $data = Product::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%$search%")
                ->orWhere('sku', 'like', "%$search%");
        })
        ->select(['id','nama', 'sku', 'type'])->orderBy('nama')->paginate($paging);

    return response()->json($data);
    }
    public function store_product()
    {
        $id_edit = request('id_edit');
        if($id_edit !="null") {
            $data= Product::find($id_edit);
            $data->nama=request('nama');
            $data->sku=request('sku');
            $data->type=request('type');
            $data-> save();
        }else {
        $data= new Product;
        $data->nama=request('nama');
        $data->sku=request('sku');
        $data->type=request('type');
        $data-> save();
        }

        return response()-> json('sukses',200);
    }
    public function get_detail($id)
    {
        $dt = Product::find($id);
        return response()->json($dt,200);
    }
    public function hapus_product($id)
    {
        Product::where('id', $id) ->delete();

        return response()->json('sukses',200);
    }

}
