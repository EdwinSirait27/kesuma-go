<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kurikulum;

use Yajra\DataTables\DataTables;
use Carbon\Carbon;
// di bagian atas file Anda
use Illuminate\Support\Facades\DB;


class kurikulumController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = kurikulum::select(
                'kurikulum_id',
                'Nama_Kurikulum',
                'Status_Aktif',
                'keterangan',
                'created_at', 
                'updated_at' 
            )->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->kurikulum_id . ');" class="btn btn-primary">Edit</button>';

                    return $button;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$kurikulum_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('kurikulum.index');
    }

    function removeall(Request $request)
    {
        $kurikulum_id_array = $request->input('kurikulum_id');
        $data = kurikulum::whereIn('kurikulum_id', $kurikulum_id_array);
    

        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
    public function edit($id)
    {
        $data = kurikulum::find($id);
        if ($data) {
            $Nama_Kurikulum = $data->Nama_Kurikulum;
            $Status_Aktif = $data->Status_Aktif;
            $keterangan = $data->keterangan;
            
            return response()->json([
                "Nama_Kurikulum" => $Nama_Kurikulum,
                "Status_Aktif" => $Status_Aktif,
                "keterangan" => $keterangan
            ]);
        }
        return response()->json(null, 404);
    }
    
    public function update(Request $request)
    {
      
        try {
            DB::beginTransaction();
    
            // Manual unique validation
            $existingCount = kurikulum::where('Nama_Kurikulum', $request->Nama_Kurikulum)
                ->where('kurikulum_id', '<>', $request->txt_id)
                ->count();
    
            if ($existingCount > 0) {
                throw new \Exception('Kurikulum sudah ada. Silakan inputkan yang lain.');
            }
    
            // Continue with other validations
            $request->validate([
                'Nama_Kurikulum' => 'required|max:50',
                'Status_Aktif' => 'required',
            ]);
            $dateNow = Carbon::now()->toDateString(); // Ambil hanya tanggal hari ini tanpa waktu
            if ($request->txt_id != '0') {
                kurikulum::where('kurikulum_id', $request->txt_id)->update([
                    "Nama_Kurikulum" => $request->Nama_Kurikulum,
                    "Status_Aktif" => $request->Status_Aktif,
                    "keterangan" => $request->keterangan,
                    "updated_at" => $dateNow,
                ]);
            } else {
                $val["Nama_Kurikulum"] = $request->Nama_Kurikulum;
                $val["Status_Aktif"] = $request->Status_Aktif;
                $val["keterangan"] = $request->keterangan;
                $val["created_at"] = $dateNow; // Set created_at dan updated_at saat membuat
            $val["updated_at"] = $dateNow;
                kurikulum::create($val);
            }
    
            DB::commit();
            return redirect('/kurikulum')->with('success', 'Data Kurikulum berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/kurikulum')->with('error', 'Terjadi kesalahan. Data Kurikulum tidak berhasil diperbarui. Pesan Kesalahan: ' . $e->getMessage());
            
        }
    }
}
