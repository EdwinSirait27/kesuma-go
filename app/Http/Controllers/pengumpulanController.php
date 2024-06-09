<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\pengumpulantugas;
use App\Models\tugas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;


class pengumpulanController extends Controller
{
    public function index(Request $request)
    {
        $worldTimeAPIResponse = file_get_contents('http://worldtimeapi.org/api/ip');
        $worldTimeAPIResult = json_decode($worldTimeAPIResponse);
        $currentDateTime = $worldTimeAPIResult->datetime;
        $now = Carbon::parse($currentDateTime);
        $formattedDateTime = $now->format('Y-m-d H:i:s');
        $siswa = auth()->user()->siswa; 
        if ($request->ajax()) {
            $data = pengumpulantugas::with(['siswa','tugas.datakelasdatamengajar.datamengajar.matpel','tugas.datakelasdatamengajar.datamengajar.guru'])
                ->where('siswa_id', $siswa->siswa_id)
                ->select(
                    'pengumpulan_id',
                    'siswa_id',
                    'tugas_id',
                    'dokumen',
                    'tanggal',
                    'status'
                )->get();
                
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                   $button = '';
                    if ($data->status != 'Sudah Diperiksa') {
                        $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->pengumpulan_id . ');" class="btn btn-primary">Edit</button>';
                    }
                    $redirectButton = '<a href="' . route('downloadd.tugas',['pengumpulan_id' => $data->pengumpulan_id]) . '" class="btn btn-success">Download File Tugas</a>';
                    return $button . ' ' . $redirectButton;
                })
              
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$pengumpulan_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        $tugas = tugas::where('tipe','Tugas')->whereHas('datakelasdatamengajar', function ($query) use ($siswa) {
            $query->whereHas('datakelas', function ($subquery) use ($siswa) {
                $subquery->where('kelas_id', $siswa->kelas_id);
            });
        })->with(['datakelasdatamengajar.datamengajar.matpel','datakelasdatamengajar.datakelas.kelas'])->get();
        foreach ($tugas as $data) {
            $data->dokumen = basename($data->dokumen);
        }
        return view('pengumpulantugas.index', compact('tugas','formattedDateTime'));
    }
    // public function index(Request $request)
    // {
    //     $worldTimeAPIResponse = file_get_contents('http://worldtimeapi.org/api/ip');
    //     $worldTimeAPIResult = json_decode($worldTimeAPIResponse);
    //     $currentDateTime = $worldTimeAPIResult->datetime;
    //     $now = Carbon::parse($currentDateTime);
    //     $formattedDateTime = $now->format('Y-m-d H:i:s');
    //     $siswa = auth()->user()->siswa; 
    //     if ($request->ajax()) {
    //         $data = pengumpulantugas::with(['siswa','tugas.datakelasdatamengajar.datamengajar.matpel','tugas.datakelasdatamengajar.datamengajar.guru'])
    //             ->where('siswa_id', $siswa->siswa_id)
    //             ->select(
    //                 'pengumpulan_id',
    //                 'siswa_id',
    //                 'tugas_id',
    //                 'dokumen',
    //                 'tanggal',
    //                 'status'
    //             )->get();
                
    //         return Datatables::of($data)->addIndexColumn()
    //             ->addColumn('action', function ($data) {
    //                $button = '';
    //                 if ($data->status != 'Sudah Diperiksa') {
    //                     $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->pengumpulan_id . ');" class="btn btn-primary">Edit</button>';
    //                 }
    //                 $redirectButton = '<a href="' . route('downloadd.tugas',['pengumpulan_id' => $data->pengumpulan_id]) . '" class="btn btn-success">Download File Tugas</a>';
    //                 return $button . ' ' . $redirectButton;
    //             })
    //             ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$pengumpulan_id}}" />')
    //             ->rawColumns(['checkbox', 'action'])
    //             ->make(true);
    //     }
    //     $tugas = Tugas::whereHas('datakelasdatamengajar', function ($query) use ($siswa) {
    //         $query->whereHas('datakelas', function ($subquery) use ($siswa) {
    //             $subquery->where('kelas_id', $siswa->kelas_id);
    //         });
    //     })->with(['datakelasdatamengajar.datamengajar.matpel','datakelasdatamengajar.datakelas.kelas'])->get();
    //     return view('pengumpulantugas.index', compact('tugas','formattedDateTime'));
    // }

    public function index2(Request $request)
{   
 
    if ($request->ajax()) {
        $guru_id = auth()->user()->guru_id;
$data = pengumpulantugas::with(['tugas.datakelasdatamengajar.datamengajar.matpel', 'siswa','siswa.kelas'])
            ->whereHas('tugas.datakelasdatamengajar.datamengajar.guru', function($query) use ($guru_id) {
                $query->where('guru_id', $guru_id);
            })
            ->select(
                'pengumpulan_id',
                'tugas_id',
                'siswa_id',
                'dokumen',
                'tanggal',
                'status'
            )
            ->get();

        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {
                $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->pengumpulan_id . ');" class="btn btn-primary">Edit</button>';
                 
                $redirectButton = '<a href="' . route('downloadd.tugas',['pengumpulan_id' => $data->pengumpulan_id]) . '" class="btn btn-success">Download File</a>';
                return $button . ' ' . $redirectButton;
            })
            ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$pengumpulan_id}}" />')
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }    
    return view('cektugas.index');
}
public function unduh($pengumpulan_id)
{
    $pengumpulan = pengumpulantugas::findOrFail($pengumpulan_id);
    if ($pengumpulan && $pengumpulan->dokumen) {
        
        $pathToFile = storage_path('app/public/tugassiswa/' . $pengumpulan->dokumen);
   
            return response()->download($pathToFile);
   
}
}



    // public function index2(Request $request)
    // {   
    //     if ($request->ajax()) {
    //         $data = pengumpulantugas::with(['tugas.datakelasdatamengajar.datamengajar.guru','siswa'])
    //             ->select(
    //             'pengumpulan_id',
    //             'tugas_id',
    //             'siswa_id'
    //         )->get();
    //         return Datatables::of($data)->addIndexColumn()
    //             ->addColumn('action', function ($data) {
    //                 $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->pengumpulan_id . ');" class="btn btn-primary">Edit</button>';
    //                 return $button;
    //             })
    //             ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$pengumpulan_id}}" />')
    //             ->rawColumns(['checkbox', 'action'])
    //             ->make(true);
    //     }    
    //     return view('cektugas.index');
    // }
    
//     public function index(Request $request)
// {
//     $url = env('TIMEZONEDB_API_GATEWAY');

//         // Membuat koneksi ke API TimezoneDB
//         $client = new Client();

//         // Mengirim permintaan HTTP GET ke API
//         $response = $client->get($url);

//         // Mendapatkan konten respons
//         $content = $response->getBody()->getContents();

//         // Mengonversi XML ke array
//         $data = simplexml_load_string($content);
//     $siswa = auth()->user()->siswa; 
//     if ($request->ajax()) {
//         $data = pengumpulantugas::with(['siswa','tugas.datakelasdatamengajar.datamengajar.matpel','tugas.datakelasdatamengajar.datamengajar.guru'])
//             ->where('siswa_id', $siswa->siswa_id)
//             ->select(
//                 'pengumpulan_id',
//                 'siswa_id',
//                 'tugas_id',
//                 'dokumen',
//                 'tanggal',
//                 'status'
//                 )->get();
//                 return Datatables::of($data)->addIndexColumn()
//                     ->addColumn('action', function ($data) {
//                         $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->pengumpulan_id . ');" class="btn btn-primary">Edit</button>';
//                     return $button;
//                     })
//                     ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$pengumpulan_id}}" />')
//                     ->rawColumns(['checkbox', 'action'])
//                     ->make(true);
//             }
//             $tugas = Tugas::whereHas('datakelasdatamengajar', function ($query) use ($siswa) {
//                 $query->whereHas('datakelas', function ($subquery) use ($siswa) {
//                     $subquery->where('kelas_id', $siswa->kelas_id);
//                 });
//             })->with(['datakelasdatamengajar.datamengajar.matpel','datakelasdatamengajar.datakelas.kelas'])->get();
//             return view('pengumpulantugas.index', compact('tugas', 'data'));
//         }

   
        public function removeall(Request $request)
        {
            $pengumpulan_id_array = $request->input('pengumpulan_id');
            
            // Memastikan ada pengumpulan_id yang diterima dari request
            if(!empty($pengumpulan_id_array)) {
                // Menghapus data pengumpulan tugas yang sesuai dengan pengumpulan_id yang diterima
                $deleted = pengumpulantugas::whereIn('pengumpulan_id', $pengumpulan_id_array)->delete();
                
                // Memeriksa apakah penghapusan berhasil
                if ($deleted) {
                    return response()->json(['message' => 'Data Deleted']);
                } else {
                    return response()->json(['message' => 'Failed to delete data']);
                }
            } else {
                // Menangani jika tidak ada pengumpulan_id yang diterima
                return response()->json(['message' => 'No pengumpulan_id provided']);
            }
        }
        
        
    
    public function edit($id)
    {
        $data = pengumpulantugas::find($id);
        if ($data) {
            $siswa_id = $data->siswa_id;
            $tugas_id = $data->tugas_id;
            $dokumen = $data->dokumen;
            $tanggal = $data->tanggal;
            return response()->json([
                "siswa_id" => $siswa_id,
                "tugas_id" => $tugas_id,
                "dokumen" => $dokumen,
                "tanggal" => $tanggal

            ]);
        }
        return response()->json(null, 404);
    }
    public function edit2($id)
    {
        $data = pengumpulantugas::find($id);
        if ($data) {
            $siswa_id = $data->siswa_id;
            $tugas_id = $data->tugas_id;
            $dokumen = $data->dokumen;
            $tanggal = $data->tanggal;
            return response()->json([
                "siswa_id" => $siswa_id,
                "tugas_id" => $tugas_id,
                "dokumen" => $dokumen,
                "tanggal" => $tanggal

            ]);
        }
        return response()->json(null, 404);
    }
    public function getCurrentDate() {
        // Ambil waktu dari WorldTimeAPI
        $worldTimeAPIResponse = Http::get('http://worldtimeapi.org/api/ip');
        $worldTimeAPIResult = $worldTimeAPIResponse->json();
        
        // Ambil tanggal dan waktu dari respons API
        $currentDateTime = $worldTimeAPIResult['datetime'];
        
        // Ubah waktu menjadi objek Carbon
        $now = Carbon::parse($currentDateTime);
        
        // Format tanggal dan waktu sesuai kebutuhan (contoh: 'Y-m-d H:i:s')
        $formattedDateTime = $now->format('Y-m-d H:i:s');
    
        return $formattedDateTime;
    }
    
public function update(Request $request)
{
    $request->validate([
        'dokumen' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    try {
        DB::beginTransaction();
        $user = Auth::user();

        // Mengambil siswa_id dari user yang sedang login
        $siswa_id = $user->siswa_id;
        $tanggal_sekarang = $this->getCurrentDate(); 
        $tugas = Tugas::findOrFail($request->tugas_id);
        $batas_waktu_start = Carbon::parse($tugas->created_at); 
        $batas_waktu_end = Carbon::parse($tugas->updated_at)->endOfDay(); // Set waktu menjadi pukul 23:59:59
        
        // Ubah string tanggal menjadi objek Carbon
        $tanggal_sekarang_obj = Carbon::parse($tanggal_sekarang);

        if ($tanggal_sekarang_obj->gt($batas_waktu_end)) { // Jika tanggal saat ini lebih besar dari updated_at
            return redirect()->back()->with('error', 'Anda melebihi batas tanggal!');
        }
        
        $val = [
            "tugas_id" => $request->tugas_id,
            "siswa_id" => $siswa_id,
            "tanggal" => $tanggal_sekarang, 
            "status" => "Belum Diperiksa",
        ];
        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('public/tugassiswa', $fileName);
            $val['dokumen'] = $fileName;
        }
        if ($request->txt_id !== '0') {
            pengumpulantugas::where('pengumpulan_id', '=', $request->txt_id)->update($val);
        } else {
            pengumpulantugas::create($val);
        }
        DB::commit();
        return redirect('/pengumpulantugas')->with('success', 'Tugas berhasil ditambahkan!');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
public function update2(Request $request)
{
    try {
        DB::beginTransaction();
        $val = [
            "status" => $request->status,
        ];
        
        if ($request->txt_id !== '0') {
            pengumpulantugas::where('pengumpulan_id', '=', $request->txt_id)->update($val);
        } else {
            pengumpulantugas::create($val);
        }
        DB::commit();
        return redirect('/cektugas')->with('success', 'Tugas berhasil ditambahkan! ');
    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'dokumen' => 'required|file|mimes:pdf,doc,docx|max:2048',
    //     ]);

    //     try {
    //         DB::beginTransaction();
    //         $siswa_id = Auth::id();
    //         $tanggal_sekarang = $this->getCurrentDate(); // Mendapatkan tanggal saja
    //         $tugas = Tugas::findOrFail($request->tugas_id);
    //         $batas_waktu_start = Carbon::parse($tugas->created_at); 
    //         $batas_waktu_end = Carbon::parse($tugas->updated_at); 
    //          $tanggal_sekarang_obj = Carbon::parse($tanggal_sekarang);
    //         if ($tanggal_sekarang_obj->isSameDay($batas_waktu_end)) {
    //             $batas_waktu_end->setTime(23, 59, 59);
    //         }
    //         $val = [
    //             "tugas_id" => $request->tugas_id,
    //             "siswa_id" => $siswa_id,
    //             "tanggal" => $tanggal_sekarang,
    //             "status" => "Belum Diperiksa",
    //         ];
    //         if ($request->hasFile('dokumen')) {
    //             $file = $request->file('dokumen');
    //             $fileName = $file->getClientOriginalName();
    //             $filePath = $file->storeAs('public/dokumen', $fileName);
    //             $val['dokumen'] = $fileName;
    //         }
    //         if ($request->txt_id !== '0') {
    //             pengumpulantugas::where('pengumpulan_id', '=', $request->txt_id)->update($val);
    //         } else {
    //             pengumpulantugas::create($val);
    //         }
    //         DB::commit();
    //         return redirect('/pengumpulantugas')->with('success', 'Tugas berhasil ditambahkan!');
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }
            }

//     public function update(Request $request)
// {
//     $request->validate([
//         'dokumen' => 'required|file|mimes:pdf,doc,docx|max:2048',
//     ]);

//     try {
//         DB::beginTransaction();
//         $siswa_id = Auth::id();
//         $tanggal_sekarang = $this->getCurrentDate();
//         $tugas = Tugas::findOrFail($request->tugas_id);
//         $batas_waktu_start = Carbon::parse($tugas->created_at); 
//         $batas_waktu_end = Carbon::parse($tugas->updated_at); 
//         if ($tanggal_sekarang->isSameDay($batas_waktu_end)) {
//             $batas_waktu_end->setTime(23, 59, 59);
//         }
//         if ($tanggal_sekarang->between($batas_waktu_start, $batas_waktu_end, true)) {
//             $val = [
//                 "tugas_id" => $request->tugas_id,
//                 "siswa_id" => $siswa_id,
//                 "tanggal" => $tanggal_sekarang,
//                 "status" => "Belum Diperiksa",
//             ];
//             if ($request->hasFile('dokumen')) {
//                 $file = $request->file('dokumen');
//                 $fileName = $file->getClientOriginalName();
//                 $filePath = $file->storeAs('public/dokumen', $fileName);
//                 $val['dokumen'] = $fileName;
//             }
//             if ($request->txt_id !== '0') {
//                 pengumpulantugas::where('pengumpulan_id', '=', $request->txt_id)->update($val);
//             } else {
//                 pengumpulantugas::create($val);
//             }
//             DB::commit();
//             return redirect('/pengumpulantugas')->with('success', 'Tugas berhasil ditambahkan!');
//         } else {
//             return redirect()->back()->with('error', 'Pengumpulan tugas diluar rentang waktu yang ditentukan.');
//         }
//     } catch (\Exception $e) {
//         DB::rollback();
//         return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
//     }
// }


    