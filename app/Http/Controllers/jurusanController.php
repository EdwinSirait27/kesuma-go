<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jurusan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class jurusanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = jurusan::select(
                'jurusan_id',
                
                'namajurusan',
                'status',
                'keterangan' 
                 
            )->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->jurusan_id . ');" class="btn btn-primary">Edit</button>';

                    return $button;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$jurusan_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('jurusan.index');
    }

    function removeall(Request $request)
    {
        $jurusan_id_array = $request->input('jurusan_id');
        $data = jurusan::whereIn('jurusan_id', $jurusan_id_array);
    

        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
    public function edit($id)
    {
        $data = jurusan::find($id);
        if ($data) {
            
            $namajurusan = $data->namajurusan;
            $status = $data->status;
            $keterangan = $data->keterangan;
            
            return response()->json([
            
                "txt_namajurusan" => $namajurusan,
                "txt_status" => $status,
                "txt_keterangan" => $keterangan
            ]);
        }
        return response()->json(null, 404);
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        if ($request->txt_id <> '0') {
            jurusan::where('jurusan_id', '=', $request->txt_id)->update([ // Ganti 'id' dengan 'jurusan_id'
            
                "namajurusan" => $request->txt_namajurusan,
                "status" => $request->txt_status,
                "keterangan" => $request->txt_keterangan,
                
            ]);
        } else {
            
            $val["namajurusan"] = $request->txt_namajurusan;
            $val["status"] = $request->txt_status;
            $val["keterangan"] = $request->txt_keterangan;
            
            jurusan::create($val);
        }
        DB::commit();
        return redirect('/jurusan')->with('success', 'jurusan Berhasil Ditambahkan!');
    }
}
