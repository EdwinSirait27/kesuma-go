<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\osis;
use App\Models\tbsiswa;
use App\Models\voting;
use App\Models\hasilvoting;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class osis2Controller extends Controller
{
    public function index(Request $request)
    {
        $siswas = tbsiswa::all();

        if ($request->ajax()) {
            $data = osis::with(['siswa.kelas'])
                ->select(
                    'osis_id',
                    'siswa_id',
                    'foto',
                    'visi',
                    'misi'
                )->get();

            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->osis_id . ');" class="btn btn-primary">Edit</button>';

                    return $button;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$osis_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }

        return view('osis.index', compact('siswas'));
    }
    public function edit($id)
    {
        $data = osis::find($id);
        if ($data) {
          
                $siswa_id = $data->siswa_id;
                $foto = $data->foto;
                $visi = $data->visi;
                $misi = $data->misi;
                
                return response()->json([
            
                    "siswa_id" => $siswa_id,
                  
                    "foto" => $foto,
                    "visi" => $visi,
                    "misi" => $misi
    
                ]);
            }
            return response()->json(null, 404);
        }
 
       

    public function update(Request $request)
{
    DB::beginTransaction();
    try {
        $request->validate([
            'foto' => 'image|mimes:jpeg|max:2048',
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format file gambar harus jpeg.',
            'foto.max' => 'Ukuran file gambar tidak boleh melebihi 2 MB.',
        ]);

        if ($request->txt_id !== '0') {
            $osis = osis::find($request->txt_id);
            if (!$osis) {
                return redirect()->back()->withErrors(['error' => 'Data osis tidak ditemukan']);
            }

            $siswaId = is_array($request->siswa_id) ? $request->siswa_id[0] : $request->siswa_id;
            $siswa = Tbsiswa::find($siswaId);
            if (!$siswa) {
                return redirect()->back()->withErrors(['error' => 'Data siswa tidak ditemukan']);
            }
            $osis->siswa_id = $siswaId;
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $file = $request->file('foto');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/fotosiswa', $fileName); 
                $osis->foto = $fileName; 
            }
            $osis->visi = $request->visi;
            $osis->misi = $request->misi;
            $osis->save();
           
        } else {
            $siswaId = is_array($request->siswa_id) ? $request->siswa_id[0] : $request->siswa_id;
            $siswa = Tbsiswa::find($siswaId);
            if (!$siswa) {
                return redirect()->back()->withErrors(['error' => 'Data siswa tidak ditemukan']);
            }

            $osis = new Osis();
            $osis->siswa_id = $siswaId;
            if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                $file = $request->file('foto');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('fotosiswa/'), $fileName);
                $osis->foto = $fileName;
            }
            $osis->visi = $request->visi;
            $osis->misi = $request->misi;
            $osis->save();
        }

        DB::commit();
        return redirect('/osis')->with('success', 'Data Osis Berhasil Diperbarui atau Ditambahkan!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
}

        
        // public function update(Request $request)
        // {
        //     DB::beginTransaction();
        //     try {
        //         $request->validate([
        //             'foto' => 'image|mimes:jpeg|max:2048',
        //         ], [
        //             'foto.image' => 'File harus berupa gambar.',
        //             'foto.mimes' => 'Format file gambar harus jpeg.',
        //             'foto.max' => 'Ukuran file gambar tidak boleh melebihi 2 MB.',
             
        //         ]);
        
        //         if ($request->txt_id !== '0') {
        //             $osis = osis::find($request->txt_id);
        //             if (!$osis) {
        //                 return redirect()->back()->withErrors(['error' => 'Data osis tidak ditemukan']);
        //             }
        
        //             $siswaId = is_array($request->siswa_id) ? $request->siswa_id[0] : $request->siswa_id;
        //             $siswa = Tbsiswa::find($siswaId);
        //             if (!$siswa) {
        //                 return redirect()->back()->withErrors(['error' => 'Data siswa tidak ditemukan']);
        //             }
        //             $osis->siswa_id = $siswaId;
        //             if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
        //                 $file = $request->file('foto');
        //                 $fileName = time() . '_' . $file->getClientOriginalName();
        //                 $file->move(public_path('fotosiswa/'), $fileName); 
        //                 $osis->foto = $fileName; 
        //             }
        //             $osis->visi = $request->visi;
        //             $osis->misi = $request->misi;
        //             $osis->save();
        //         }
        //         DB::commit();
        //         return redirect('/osis')->with('success', 'Siswa Berhasil Diperbarui!');
        //     } catch (\Exception $e) {
        //         DB::rollBack();
        //         return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        //     }
        // }
        
        
        
        
        public function removeall(Request $request)
        {
            $request->validate([
                'osis_id' => 'required|array',
                'osis_id.*' => 'exists:osis,osis_id' // Validasi setiap ID ada di tabel osis
            ]);
        
            $osis_id_array = $request->input('osis_id');
        
            // Hapus data terkait di tabel Voting dan HasilVoting
            voting::whereIn('osis_id', $osis_id_array)->delete();
            hasilvoting::whereIn('osis_id', $osis_id_array)->delete();
        
            // Hapus data di tabel Osis
            $deleted = osis::whereIn('osis_id', $osis_id_array)->delete();
        
            // Mengembalikan respons sesuai dengan hasil penghapusan
            if ($deleted) {
                return response()->json(['message' => 'Data Deleted'], 200);
            } else {
                return response()->json(['message' => 'Data Deletion Failed'], 500);
            }
        }
        
    // function removeall(Request $request)
    // {
    //     $osis_id_array = $request->input('osis_id');
    //     $data = osis::whereIn('osis_id', $osis_id_array);
    //     if ($data->delete()) {
    //         return response()->json(['message' => 'Data Deleted']);
    //     }
    // }
}
