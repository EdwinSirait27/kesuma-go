<?php

namespace App\Http\Controllers;

use App\Models\tahunakademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\datakelas;
use App\Models\kelas;
use App\Models\tbsiswa;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Str;
use App\Models\tbguru;
use App\Models\kurikulum;
use App\Models\DatakelasDatamengajar;
use App\Models\datamengajar;
use Yajra\DataTables\DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
class datakelassController extends Controller
{
    
 
public function removeall1(Request $request)
{
    $siswa_id_array = $request->input('siswa_id');
    datakelas::whereIn('siswa_id', $siswa_id_array)->update(['siswa_id' => null]);
    return response()->json(['message' => 'Siswa ID Deleted']);
}
public function edit($id)
{
    $data = DataKelas::find($id);
    if (!$data) {
        return response()->json(['message' => 'Data not found'], 404);
    }
    $kapasitas = $data->kelas->kapasitas;
    return response()->json([
        "kelas_id" => $data->kelas_id,
        "guru_id" => $data->guru_id,
        "keterangan" => $data->keterangan,
        "kapasitas" => $kapasitas,
        "tahunakademik_id" => $data->tahunakademik_id,
    ]);
}
public function edit1($id)
{
    $data = DataKelas::find($id);

    if (!$data) {
        return response()->json(['message' => 'Data not found'], 404);
    }
    $kapasitas = $data->kelas->kapasitas;
    return response()->json([
        "kelas_id" => $data->kelas_id,
        "kapasitas" => $kapasitas,
    ]);
} 
// $tahunAkademiks = tahunakademik::all();

// if ($request->ajax()) {
//     $data = siswamengajar::with(['tahunakademik', 'kurikulum', 'siswa', 'datakelas.kelas', 'datamengajar.matpel'])
//         ->when($request->tahunakademik_id, function ($query) use ($request) {
//             return $query->where('tahunakademik_id', $request->tahunakademik_id);
//         })
//         ->get();

    public function indexx(Request $request)
    {
       
        $hakakses = Auth::user()->hakakses;
        $kelass = kelas::all();
        $gurus = tbguru::all();
        $kurs = Kurikulum::where('Status_Aktif', 'Aktif')->get();
        $taon = tahunakademik::where('statusaktif', 'Aktif')->get();
        $tahuns = TahunAkademik::all();
        $kelas_id = $request->get('kelas_id');
        $siswas = tbsiswa::with('kelas')->get();
        $datakelas = null;
        $datakelass = datakelas::all();
        $kapasitas_kelas = kelas::first()->kapasitas;
        if ($request->ajax()) {
            $data = datakelas::with(['kelas', 'guru', 'tahun'])
                ->when($request->tahunakademik_id, function ($query) use ($request) {
                    return $query->where('tahunakademik_id', $request->tahunakademik_id);
                })
                ->get();
        // if ($request->ajax()) {
        //     $data = datakelas::with(['kelas' => function ($query) {
        //         $query->select('kelas_id','namakelas','kapasitas');
        //     }, 'guru', 'siswa', 'tahun.kurikulum'])
        //         ->select(
        //             'datakelas_id',
        //             'kelas_id',
        //             'guru_id',
        //             'keterangan',
        //             'tahunakademik_id'
        //         )
        //         ->get();
                foreach ($data as $item) {
                    $item->jumlah_siswa = tbsiswa::where('kelas_id', $item->kelas_id)->count();
                }
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) use ($kelas_id, $hakakses, $request) {
                    if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
                        $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->datakelas_id . ', ' . $kelas_id . ');" class="btn btn-primary">Edit</button>';
                    } else {
                        $button = '';
                    }
                    if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {                        
                        $token = Str::random(32);
                    $request->session()->put('listkelas_token', $token);
                    $redirectButton = '<a href="' . route('listkelas.index', ['datakelas_id' => $data->datakelas_id, 'token' => $token]) . '" class="btn btn-success">Lihat Detail</a>';
                } else {
                        $redirectButton = ''; 
                    }
                    if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
                        $token = Str::random(32);
                    
                        $request->session()->put('jadwaladmin_token', $token);
                        $redirectButton2 = '<a href="' . route('jadwaladmin.index', ['datakelas_id' => $data->datakelas_id, 'token' => $token]) . '" class="btn btn-dark">Jadwal </a>';
                    } else {
                        $redirectButton2 = '';
                    }
                    if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
                        $token = Str::random(32);
                    
                        $request->session()->put('jadwalcreateadmin_token', $token);
                    $redirectButton3 = '<a href="' . route('jadwal.create', ['datakelas_id' => $data->datakelas_id, 'token' => $token])  . '" class="btn btn-info">Tambah Jadwal </a>';
                } else {
                    $redirectButton3 = ''; 
                }
                    return $button . ' ' . $redirectButton . ' ' . $redirectButton2 . ' ' . $redirectButton3;
                })
                ->addColumn('checkbox', function ($data) {
                    return '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="' . $data->datakelas_id . '" />';
                })
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('datakelasadmin.index', compact('kelass', 'siswas', 'gurus', 'kelas_id', 'datakelas','datakelass', 'kapasitas_kelas','tahuns','kurs','taon'));
    }
    // public function indexx(Request $request)
    // {
    //     $hakakses = Auth::user()->hakakses;
    //     $kelass = kelas::all();
    //     $gurus = tbguru::all();
    //     $kurs = Kurikulum::where('Status_Aktif', 'Aktif')->get();
    //     $taon = tahunakademik::where('statusaktif', 'Aktif')->get();
    //     $tahuns = TahunAkademik::all();
    //     $kelas_id = $request->get('kelas_id');
    //     $siswas = tbsiswa::with('kelas')->get();
    //     $datakelas = null;
    //     $datakelass = datakelas::all();
    //     $kapasitas_kelas = kelas::first()->kapasitas;
    //     if ($request->ajax()) {
    //         $data = datakelas::with(['kelas' => function ($query) {
    //             $query->select('kelas_id','namakelas','kapasitas');
    //         }, 'guru', 'siswa', 'tahun.kurikulum'])
    //             ->select(
    //                 'datakelas_id',
    //                 'kelas_id',
    //                 'guru_id',
    //                 'keterangan',
    //                 'tahunakademik_id'
    //             )
    //             ->get();
    //             foreach ($data as $item) {
    //                 $item->jumlah_siswa = tbsiswa::where('kelas_id', $item->kelas_id)->count();
    //             }
    //         return Datatables::of($data)->addIndexColumn()
    //             ->addColumn('action', function ($data) use ($kelas_id, $hakakses, $request) {
    //                 if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
    //                     $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->datakelas_id . ', ' . $kelas_id . ');" class="btn btn-primary">Edit</button>';
    //                 } else {
    //                     $button = '';
    //                 }
    //                 if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {                        
    //                     $token = Str::random(32);
    //                 $request->session()->put('listkelas_token', $token);
    //                 $redirectButton = '<a href="' . route('listkelas.index', ['datakelas_id' => $data->datakelas_id, 'token' => $token]) . '" class="btn btn-success">Lihat Detail</a>';
    //             } else {
    //                     $redirectButton = ''; 
    //                 }
    //                 if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
    //                     $token = Str::random(32);
                    
    //                     $request->session()->put('jadwaladmin_token', $token);
    //                     $redirectButton2 = '<a href="' . route('jadwaladmin.index', ['datakelas_id' => $data->datakelas_id, 'token' => $token]) . '" class="btn btn-dark">Jadwal </a>';
    //                 } else {
    //                     $redirectButton2 = '';
    //                 }
    //                 if ($hakakses == 'Admin' || $hakakses == 'KepalaSekolah') {
    //                     $token = Str::random(32);
                    
    //                     $request->session()->put('jadwalcreateadmin_token', $token);
    //                 $redirectButton3 = '<a href="' . route('jadwal.create', ['datakelas_id' => $data->datakelas_id, 'token' => $token])  . '" class="btn btn-info">Tambah Jadwal </a>';
    //             } else {
    //                 $redirectButton3 = ''; 
    //             }
    //                 return $button . ' ' . $redirectButton . ' ' . $redirectButton2 . ' ' . $redirectButton3;
    //             })
    //             ->addColumn('checkbox', function ($data) {
    //                 return '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="' . $data->datakelas_id . '" />';
    //             })
    //             ->rawColumns(['checkbox', 'action'])
    //             ->make(true);
    //     }
    //     return view('datakelasadmin.index', compact('kelass', 'siswas', 'gurus', 'kelas_id', 'datakelas','datakelass', 'kapasitas_kelas','tahuns','kurs','taon'));
    // }
   
   
    public function removeKelasFromSiswa(Request $request)
    {
        $siswa_id_array = $request->input('siswa_id');
    
        foreach ($siswa_id_array as $siswa_id) {
            $siswa = Tbsiswa::find($siswa_id);
            
            if ($siswa) {
                $siswa->kelas_id = null;
                $siswa->save();
            }
        }
    
        return response()->json(['message' => 'Kelas ID Deleted']);
    }
   
}