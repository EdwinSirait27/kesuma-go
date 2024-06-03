<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\organisasi;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
class OrganisasiController extends Controller
{
    public function index(Request $request)
    {
       
        if ($request->ajax()) {
            $data = organisasi::select(
            
                'organisasi_id',
                'nama',
                'kapasitas',
                'status',
                'keterangan'
            )->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->organisasi_id . ');" class="btn btn-primary">Edit</button>';

                    return $button;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$organisasi_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('organisasi.index');
    }

    function removeall(Request $request)
    {
        $organisasi_id_array = $request->input('organisasi_id');
        $data = organisasi::whereIn('organisasi_id', $organisasi_id_array);
    

        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
    public function edit($id)
    {
        $data = organisasi::find($id);
        if ($data) {
            
            $nama = $data->nama;
          
            $kapasitas = $data->kapasitas;
            $status = $data->status;
          
            
            $keterangan = $data->keterangan;
 
            return response()->json([
            
                "nama" => $nama,
              
                "kapasitas" => $kapasitas,
                "status" => $status,
                "keterangan" => $keterangan

            ]);
        }
        return response()->json(null, 404);
    }
    public function update(Request $request)
    {
        // Validasi kapasitas tidak boleh 0
        $request->validate([
            'kapasitas' => 'required|numeric|min:1',
            'nama' => 'required',
        ]);
    
        DB::beginTransaction();
    
        if ($request->txt_id !== '0') {
            organisasi::where('organisasi_id', '=', $request->txt_id)->update([
                "nama" => $request->nama,
                "kapasitas" => $request->kapasitas,
                "status" => $request->status,
                "keterangan" => $request->keterangan,
            ]);
        } else {
            $val["nama"] = $request->nama;
            $val["kapasitas"] = $request->kapasitas;
            $val["status"] = $request->status;
            $val["keterangan"] = $request->keterangan;
    
            organisasi::create($val);
        }
    
        DB::commit();
        return redirect('/organisasi')->with('success', 'organisasi berhasil ditambahkan!');
    }
    
}

