<?php

namespace App\Http\Controllers;

use App\Models\Pegawai_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PegawaiAjaxController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Pegawai_model::select('*'))
            ->addColumn('action', 'pegawai/pegawai-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('pegawai.index');
    }
 
    public function store(Request $request)
    {  
        $employeeId = $request->id;
        $employee   =   Pegawai_model::updateOrCreate(
                    [
                     'id' => $employeeId
                    ],
                    [
                    'nama_pegawai' => $request->nama_pegawai, 
                    'email' => $request->email,
                    'alamat' => $request->alamat
                    ]);    
                          
        return Response()->json($employee);
    }
 
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $employee  = Pegawai_model::where($where)->first();
       
        return Response()->json($employee);
    }
 
    public function destroy(Request $request)
    {
        $employee = Pegawai_model::where('id',$request->id)->delete();
       
        return Response()->json($employee);
    }
}