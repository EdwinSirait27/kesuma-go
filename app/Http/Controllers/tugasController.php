<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatakelasDatamengajar;
use App\Models\tugas;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon; 
class tugasController extends Controller
{
    public function showtugas()
{
    // Mengambil waktu saat ini dari API eksternal
    try {
        $worldTimeAPIResponse = file_get_contents('http://worldtimeapi.org/api/ip');
        $worldTimeAPIResult = json_decode($worldTimeAPIResponse);
        $currentDateTime = $worldTimeAPIResult->datetime;
    } catch (\Exception $e) {
        // Jika terjadi kesalahan saat mengambil waktu dari API, gunakan waktu lokal server sebagai fallback
        $currentDateTime = now();
    }
    
    // Parsing dan formatting waktu
    $now = Carbon::parse($currentDateTime);
    $formattedDateTime = $now->format('Y-m-d H:i:s');
    
    // Mendapatkan data guru yang sedang login
    $guru = auth()->user()->guru;
    $Nama = $guru->Nama;
    
    // Mengambil data kelas mengajar yang berhubungan dengan guru
    $datakelasdatamengajars = DatakelasDatamengajar::whereHas('datamengajar', function ($query) use ($guru) {
        $query->where('guru_id', $guru->guru_id);
    })->with(['datamengajar.matpel:matpel_id,MataPelajaran']) // Mengambil hanya kolom yang diperlukan
      ->get();
    
    // Mengembalikan view dengan data yang diperlukan
    return view('tugas.index', compact('Nama', 'datakelasdatamengajars', 'formattedDateTime'));
}

    // public function showtugas()
    // {
    //     $worldTimeAPIResponse = file_get_contents('http://worldtimeapi.org/api/ip');
    //     $worldTimeAPIResult = json_decode($worldTimeAPIResponse);
    //     $currentDateTime = $worldTimeAPIResult->datetime;
    //     $now = Carbon::parse($currentDateTime);
    //     $formattedDateTime = $now->format('Y-m-d H:i:s');
    //     $guru = auth()->user()->guru;
    //     $Nama = $guru->Nama;
    //     $datakelasdatamengajars = DatakelasDatamengajar::whereHas('datamengajar', function ($query) use ($guru) {
    //         $query->where('guru_id', $guru->guru_id);
    //     })->with(['datamengajar.matpel'])->get();   
    //     return view('tugas.index', compact('Nama', 'datakelasdatamengajars', 'formattedDateTime'));
    // }
    public function showtugassiswa()
    {
        $siswa = auth()->user()->siswa;
        $NamaLengkap = $siswa->NamaLengkap;
        // $tahunakademik = $siswa->datakelas->tahunakademik->tahunakademik;
        $datakelasdatamengajars = DatakelasDatamengajar::whereHas('datakelas', function ($query) use ($siswa) {
            $query->where('kelas_id', $siswa->kelas_id);
        })->with(['datakelas','datakelas.tahun','datakelas.tahun.kurikulum'])->get();
    
        return view('tugassiswa.index', compact('NamaLengkap', 'datakelasdatamengajars'));
    }
    
    
   

    public function index(Request $request)
    {
    
        $guru = auth()->user()->guru;
    
        if ($request->ajax()) {
            $data = tugas::whereHas('datakelasdatamengajar', function ($query) use ($guru) {
                $query->whereHas('datamengajar', function ($subquery) use ($guru) {
                    $subquery->where('guru_id', $guru->guru_id);
                });
            })->with(['datakelasdatamengajar.datamengajar.matpel','datakelasdatamengajar.datakelas.kelas'])->select(
                'tugas_id',
                'datakelas_datamengajar_id',
                'dokumen',
                'tipe',
                'keterangan',
                'created_at',
                'updated_at'
            )->get();
    
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->tugas_id . ');" class="btn btn-primary">Edit</button>';
                    $redirectButton = '<a href="' . route('download.tugas',['tugas_id' => $data->tugas_id]) . '" class="btn btn-success">Download File</a>';
                    return $button . ' ' . $redirectButton;
                    
                })
                ->addColumn('dokumen', function ($data) {
                    $path = $data->dokumen; // Ambil path lengkap dari database
                    $namaFile = basename($path); // Ambil hanya nama file dari path
                    return $namaFile; // Kembalikan hanya nama file
                })
                
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$tugas_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        $datakelasdatamengajars = DatakelasDatamengajar::whereHas('datamengajar', function ($query) use ($guru) {
            $query->where('guru_id', $guru->guru_id);
        })->with(['datamengajar.matpel'])->get();
    
        return view('tugasguru.index', compact('datakelasdatamengajars'));
    }


public function unduh($tugas_id)
{
    $tugas = tugas::findOrFail($tugas_id);
   if ($tugas && $tugas->dokumen) {
        $pathToFile = storage_path('app/' . $tugas->dokumen);
         
            return response()->download($pathToFile);       
}
}

    function removeall(Request $request)
    {
        $tugas_id_array = $request->input('tugas_id');
        $data = tugas::whereIn('tugas_id', $tugas_id_array);
    

        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
    public function edit($id)
    {
        $data = tugas::find($id);
        if ($data) {
            $datakelas_datamengajar_id = $data->datakelas_datamengajar_id;
            $dokumen = $data->dokumen;
            $tipe = $data->tipe;
            $keterangan = $data->keterangan;
            $created_at = $data->created_at;
            $updated_at = $data->updated_at;
            return response()->json([
                "datakelas_datamengajar_id" => $datakelas_datamengajar_id,
                "dokumen" => $dokumen,
                "tipe" => $tipe,
                "keterangan" => $keterangan,
                "created_at" => $created_at,
                "updated_at" => $updated_at
            ]);
        }
        return response()->json(null, 404);
    }

  

    public function update(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required',
            'tipe' => 'required',
            'dokumen' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);
        try {
            DB::beginTransaction();
            $val = [
                "datakelas_datamengajar_id" => $request->datakelas_datamengajar_id,
                "tipe" => $request->tipe,
                "keterangan" => $request->keterangan,
                "created_at" => $request->created_at,
                "updated_at" => $request->updated_at,
            ];
            if ($request->hasFile('dokumen')) {
                $file = $request->file('dokumen');
                $fileName = $file->getClientOriginalName();
                $fileName = $file->storeAs('public/prkesiswa', $fileName);
                $val['dokumen'] = $fileName;
            }
           
            if ($request->txt_id !== '0') {
                tugas::where('tugas_id', '=', $request->txt_id)->update($val);
            } else {
                tugas::create($val);
            }
            DB::commit();
            return redirect('/tugasguru')->with('success', 'Tugas berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
}
//     public function update(Request $request)
//     {
//         $request->validate([
//             'keterangan' => 'required',
//             'created_at' => 'required',
//             'updated_at' => 'required',
//             'dokumen' => 'required|file|mimes:pdf,doc,docx|max:2048',
//         ]);
//         try {
//             DB::beginTransaction();
//             $val = [
//                 "datakelas_datamengajar_id" => $request->datakelas_datamengajar_id,
//                 "keterangan" => $request->keterangan,
//                 "created_at" => $request->created_at,
//                 "updated_at" => $request->updated_at,
//             ];
//             if ($request->hasFile('dokumen')) {
//                 $file = $request->file('dokumen');
//                 $fileName = time() . '_' . $file->getClientOriginalName();                
//                 $val['dokumen'] = asset('public/dokumen/'. $fileName);
//             }
//             if ($request->txt_id !== '0') {
//                 tugas::where('tugas_id', '=', $request->txt_id)->update($val);
//             } else {
//                 tugas::create($val);
//             }
//             DB::commit();
//             return redirect('/tugasguru')->with('success', 'Tugas berhasil ditambahkan!');
//         } catch (\Exception $e) {
//             DB::rollback();
//             return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
//         }
//     }   
// }
    

//     public function update(Request $request)
//     {
//         $request->validate([
//             'keterangan' => 'required',
//             'created_at' => 'required',
//             'updated_at' => 'required',
//             'dokumen' => 'required|file|mimes:pdf,doc,docx|max:2048',
//         ]);
//         try {
//             DB::beginTransaction();
//             $val = [
//                 "datakelas_datamengajar_id" => $request->datakelas_datamengajar_id,
//                 "keterangan" => $request->keterangan,
//                 "created_at" => $request->created_at,
//                 "updated_at" => $request->updated_at,
//             ];
//             if ($request->hasFile('dokumen')) {
//                 $file = $request->file('dokumen');
//                 $fileName = time() . '_' . $file->getClientOriginalName();                
//                 $val['dokumen'] = asset('public/dokumen/'. $fileName);
//             }
//             if ($request->txt_id !== '0') {
//                 tugas::where('tugas_id', '=', $request->txt_id)->update($val);
//             } else {
//                 tugas::create($val);
//             }
//             DB::commit();
//             return redirect('/tugasguru')->with('success', 'Tugas berhasil ditambahkan!');
//         } catch (\Exception $e) {
//             DB::rollback();
//             return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
//         }
//     }   
// }
//     public function update(Request $request)
//     {
//         $request->validate([
           
//             'keterangan' => 'required',
//             'created_at' => 'required',
//             'updated_at' => 'required',
//         ]);
    
//         DB::beginTransaction();
    
//         if ($request->txt_id !== '0') {
//             tugas::where('tugas_id', '=', $request->txt_id)->update([
//                 "datakelas_datamengajar_id" => $request->datakelas_datamengajar_id,
//                 "keterangan" => $request->keterangan,
//                 "created_at" => $request->created_at,
//                 "updated_at" => $request->updated_at,
//             ]);
//         } else {
//             $val["datakelas_datamengajar_id"] = $request->datakelas_datamengajar_id;
//             $val["keterangan"] = $request->keterangan;
//             $val["created_at"] = $request->created_at;
//             $val["updated_at"] = $request->updated_at;
    
//             tugas::create($val);
//         }
    
//         DB::commit();
//         return redirect('/tugasguru')->with('success', 'tugas berhasil ditambahkan!');
//     }
    
// }
     
    
    