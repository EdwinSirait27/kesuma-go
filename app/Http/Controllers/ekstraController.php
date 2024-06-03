<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ekstra;
use App\Models\tbguru;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Pagination\Paginator;

class ekstraController extends Controller
{
    
    
    public function index(Request $request)
    {
        $akunsiswa = auth::user()->akunsiswa;
        if ($request->ajax()) {
            $data = ekstra::select(
                'ekskul_id',
                'namaekskul',
                'status',
                'kapasitas',
                
                'keterangan'
            )->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {
                $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->ekskul_id . ');" class="btn btn-primary">Edit</button>';
              
                
                return $button;
            })
            
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$ekskul_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
                
        }

        return view('ekstra.index', compact('akunsiswa'));
    }

    public function edit($id)
    {
        $data = ekstra::find($id);

        if ($data) {
            $namaekskul = $data->namaekskul;
            $kapasitas = $data->kapasitas;
            $status = $data->status;
            $keterangan = $data->keterangan;

            return response()->json([
                "namaekskul" => $namaekskul,
                "kapasitas" => $kapasitas,
                "status" => $status,
                
                "keterangan" => $keterangan
            ]);
        }

        return response()->json(null, 404);
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'namaekskul' => 'required|max:50',
                'status' => 'required',
                'kapasitas' => 'required',
              
            ]);

            if ($request->txt_id != '0') {
                ekstra::where('ekskul_id', $request->txt_id)->update([
                    "namaekskul" => $request->namaekskul,
                    "kapasitas" => $request->kapasitas,
                    "status" => $request->status,
                
                    "keterangan" => $request->keterangan,
                ]);
            } else {
                $val["namaekskul"] = $request->namaekskul;
                $val["kapasitas"] = $request->kapasitas;
                $val["status"] = $request->status;
              
                $val["keterangan"] = $request->keterangan;
                ekstra::create($val);
            }

            DB::commit();
            return redirect('/ekstra')->with('success', 'Data ekstrakurikuler berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/ekstra')->with('error', 'Terjadi kesalahan. Data tidak berhasil diperbarui.');
        }
    }
    function removeall(Request $request)
    {
        $ekskul_id_array = $request->input('ekskul_id');
        $data = ekstra::whereIn('ekskul_id', $ekskul_id_array);
    

        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
}