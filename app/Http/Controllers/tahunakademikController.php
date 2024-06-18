<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tahunakademik;
use App\Models\kurikulum;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
class tahunakademikController extends Controller
{


    public function index(Request $request)
    {
        // $kurs = kurikulum::all();
        $kurs = kurikulum::where('Status_Aktif', 'Aktif')->get();

        if ($request->ajax()) {
            $data = tahunakademik::with(['kurikulum'])
                ->select(
                    'tahunakademik_id',
                    'tahunakademik',
                    'kurikulum_id',
                    'semester',
                    'tahun1',
                    'tahun2',
                    'statusaktif',
                    'keterangan'
                )->get();
    
            foreach ($data as $tahun) {
                $now = Carbon::now();
         $tahun1 = Carbon::parse($tahun->tahun1);
                $tahun2 = Carbon::parse($tahun->tahun2)->endOfDay(); // Akhiri hari
    
                // Jika tanggal dan waktu sekarang di antara tahun1 dan tahun2, set statusaktif menjadi Aktif
                if ($now->between($tahun1, $tahun2)) {
                    $tahun->statusaktif = 'Aktif';
                    $tahun->save();
                } else {
                    $tahun->statusaktif = 'Tidak Aktif';
                    $tahun->save();
                }
            }
    
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->tahunakademik_id . ');" class="btn btn-primary">Edit</button>';
    
                    return $button;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$tahunakademik_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
    
        return view('tahunakademik.index', compact('kurs'));
    }
    
// public function index(Request $request)
// {
//     $kurs = kurikulum::all();

//     if ($request->ajax()) {
//         $data = tahunakademik::with(['kurikulum'])
//             ->select(
//                 'tahunakademik_id',
//                 'tahunakademik',
//                 'kurikulum_id',
//                 'semester',
//                 'tahun1',
//                 'tahun2',
//                 'statusaktif',
//                 'keterangan'
//             )->get();

//         // Iterasi setiap tahun akademik
//         foreach ($data as $tahun) {
//             // Ambil tanggal sekarang
//             $now = Carbon::now();

//             // Konversi tahun1 dan tahun2 menjadi objek Carbon
//             $tahun1 = Carbon::parse($tahun->tahun1);
//             $tahun2 = Carbon::parse($tahun->tahun2);

//             // Jika tanggal sekarang di antara tahun1 dan tahun2, set statusaktif menjadi Aktif
//             if ($now->between($tahun1, $tahun2)) {
//                 $tahun->statusaktif = 'Aktif';
//                 $tahun->save();
//             } else {
//                 $tahun->statusaktif = 'Tidak Aktif';
//                 $tahun->save();
//             }
//         }

//         return Datatables::of($data)->addIndexColumn()
//             ->addColumn('action', function ($data) {
//                 $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->tahunakademik_id . ');" class="btn btn-primary">Edit</button>';

//                 return $button;
//             })
//             ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$tahunakademik_id}}" />')
//             ->rawColumns(['checkbox', 'action'])
//             ->make(true);
//     }

//     return view('tahunakademik.index', compact('kurs'));
// }

    // public function index(Request $request)
    // {
        
    //     $kurs =kurikulum::all();
    //     if ($request->ajax()) {
    //         $data = tahunakademik::with(['kurikulum'])
    //         ->select(
    //             'tahunakademik_id',
    //             'tahunakademik',
    //             'kurikulum_id',
    //             'semester',
    //             'tahun1', 
    //             'tahun2',
    //             'statusaktif',
    //             'keterangan' 
    //         )->get();
    //         return Datatables::of($data)->addIndexColumn()
    //             ->addColumn('action', function ($data) {
    //                 $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->tahunakademik_id . ');" class="btn btn-primary">Edit</button>';

    //                 return $button;
    //             })
    //             ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$tahunakademik_id}}" />')
    //             ->rawColumns(['checkbox', 'action'])
    //             ->make(true);
    //     }
    //     return view('tahunakademik.index', compact('kurs'));
    // }




    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
    
            // Continue with other validations
            $request->validate([
                'tahunakademik' => 'required|max:4',
                'tahun1' => 'required|date_format:Y-m-d',
                'tahun2' => 'required|date_format:Y-m-d',
                'semester' => 'required',
                'kurikulum_id' => 'required',
              
            ]);
    
            // Check if there are already two records with the same academic year
            $existingCount = tahunakademik::where('tahunakademik', $request->tahunakademik)
                ->where('tahunakademik_id', '!=', $request->txt_id)
                ->count();
    
            if ($existingCount >= 2) {
                return redirect('/tahunakademik')->with('error', 'Tidak dapat menambahkan tahun akademik ' . $request->tahunakademik . ' lagi. Batas maksimum sudah tercapai.');
            }
    
            $dateNow = Carbon::now()->toDateString(); // Ambil hanya tanggal hari ini tanpa waktu
    
            if ($request->txt_id != '0') {
                tahunakademik::where('tahunakademik_id', $request->txt_id)->update([
                    "tahunakademik" => $request->tahunakademik,
                    "kurikulum_id" => $request->kurikulum_id,
                    "semester" => $request->semester,
                    "tahun1" => $request->tahun1,
                    "tahun2" => $request->tahun2,
                   "keterangan" => $request->keterangan,
                ]);
            } else {
                $val["tahunakademik"] = $request->tahunakademik;
                $val["kurikulum_id"] = $request->kurikulum_id;
                $val["semester"] = $request->semester;
                $val["tahun1"] = $request->tahun1;
                $val["tahun2"] = $request->tahun2;
                $val["keterangan"] = $request->keterangan;
                tahunakademik::create($val);
            }
    
            DB::commit();
            return redirect('/tahunakademik')->with('success', 'Data Tahun Akademik berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/tahunakademik')->with('error', 'Terjadi kesalahan. Data Tahun Akademik tidak berhasil diperbarui. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    
    public function edit($id)
    {
        $data = tahunakademik::find($id);
        if ($data) {
            $tahunakademik = $data->tahunakademik;
            $kurikulum_id = $data->kurikulum_id;
            $semester = $data->semester;
            $tahun1 = $data->tahun1;
            $tahun2 = $data->tahun2;
            $statusaktif = $data->statusaktif;
            $keterangan = $data->keterangan;
            
            return response()->json([
                "tahunakademik" => $tahunakademik,
                "kurikulum_id" => $kurikulum_id,
                "semester" => $semester,
                "tahun1" => $tahun1,
                "tahun2" => $tahun2,
                "statusaktif" => $statusaktif,
                "keterangan" => $keterangan,
                
            ]);
        }
        return response()->json(null, 404);
    }
    function removeall(Request $request)
    {
        $tahunakademik_id_array = $request->input('tahunakademik_id');
        $data = tahunakademik::whereIn('tahunakademik_id', $tahunakademik_id_array);
    
    
        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
}
