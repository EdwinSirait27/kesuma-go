<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kelas;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
class kelasController extends Controller
{
    public function index(Request $request)
    {
       
        if ($request->ajax()) {
            $data = kelas::select(
            
                'kelas_id',
                'namakelas',
                
                'kapasitas',
          
                'keterangan'
            )->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->kelas_id . ');" class="btn btn-primary">Edit</button>';

                    return $button;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$kelas_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('kelas.index');
    }

    function removeall(Request $request)
    {
        $kelas_id_array = $request->input('kelas_id');
        $data = kelas::whereIn('kelas_id', $kelas_id_array);
    

        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
    public function edit($id)
    {
        $data = kelas::find($id);
        if ($data) {
            
            $namakelas = $data->namakelas;
          
            $kapasitas = $data->kapasitas;
          
            
            $keterangan = $data->keterangan;
 
            return response()->json([
            
                "txt_namakelas" => $namakelas,
              
                "txt_kapasitas" => $kapasitas,
             
                "txt_keterangan" => $keterangan

            ]);
        }
        return response()->json(null, 404);
    }
    public function update(Request $request)
    {
        // Validasi kapasitas tidak boleh 0
        $request->validate([
            'txt_kapasitas' => 'required|numeric|min:1',
        ]);
    
        DB::beginTransaction();
    
        if ($request->txt_id !== '0') {
            kelas::where('kelas_id', '=', $request->txt_id)->update([
                "namakelas" => $request->txt_namakelas,
                "kapasitas" => $request->txt_kapasitas,
                "keterangan" => $request->txt_keterangan,
            ]);
        } else {
            $val["namakelas"] = $request->txt_namakelas;
            $val["kapasitas"] = $request->txt_kapasitas;
            $val["keterangan"] = $request->txt_keterangan;
    
            kelas::create($val);
        }
    
        DB::commit();
        return redirect('/kelas')->with('success', 'Kelas berhasil ditambahkan!');
    }
    
}

