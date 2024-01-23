<?php

namespace App\Http\Controllers;

use App\Models\Produk_model;
use Illuminate\Http\Request;
// use DataTables;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) { 
            $data = Produk_model::latest()->get();
  
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';  
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('produk.index');
    }
       
    public function store(Request $request)
    {
        Produk_model::updateOrCreate([
                    'nama_produk' => $request->nama_produk, 
                    'satuan' => $request->satuan
                ]);        
     
        return response()->json(['success'=>'Record saved successfully.']);
    }

    public function edit($id)
    {
        $product = Produk_model::find($id);
        return response()->json($product);
    }
    
    public function destroy($id)
    {
        Produk_model::find($id)->delete();
      
        return response()->json(['success'=>'Record deleted successfully.']);
    }
}