<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbguru;
use DB;
use Yajra\DataTables\DataTables;
use App\Models\tbsiswa;
use App\Models\listakunsiswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class listakunsiswaController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
     
        $data = tbsiswa::with('listakunsiswa')->get();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {
                $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->siswa_id . ');" class="btn btn-primary">Edit</button>';

                return $button;
            })
            ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$siswa_id}}" />')
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }

    return view('akun1.index');
}
    
    public function edit($id)
    {
        $siswa = tbsiswa::with('listakunsiswa')->find($id);
    
        if ($siswa) {
            $NamaLengkap = $siswa->NamaLengkap;
    
            // Mengambil data dari relasi listakun jika sudah didefinisikan di model tbguru.
            $listakunsiswa = $siswa->listakunsiswa;
    
            if ($listakunsiswa) {
                $username = $listakunsiswa->username;
                $password = $listakunsiswa->password;
                $hakakses = $listakunsiswa->hakakses;
            } else {
                $username = null;
                $password = null;
                $hakakses = null;
            }
    
            return response()->json([
                "txt_NamaLengkap" => $NamaLengkap,
                "username" => $username,
                "password" => $password,
                "hakakses" => $hakakses,
            ]);
        }
    
        return response()->json(null, 404);
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        
        if ($request->txt_id !== '0') {
            // Update data pada model tbguru
            tbsiswa::where('siswa_id', $request->txt_id)->update([
                "NamaLengkap" => $request->txt_NamaLengkap,
            ]);
            // Jika Anda ingin mengupdate data pada relasi listakun, lakukan seperti ini
            $siswa = tbsiswa::find($request->txt_id);
            if ($siswa) {
                $listakunsiswa = $siswa->listakunsiswa;
                if ($listakunsiswa) {
                    $listakunsiswa->update([
                        "username" => $request->username,
                        "password" => bcrypt($request->password),
                        "hakakses" => $request->hakakses,
                    ]);
                }
            }
        } else {
            $val["NamaLengkap"] = $request->txt_NamaLengkap;
    
            // Buat data baru pada model tbguru dan relasi listakun
            $siswa = tbsiswa::create($val);
    
            if ($siswa) {
                $siswa->listakunsiswa()->create([
                    "username" => $request->username,
                    "password" => $request->password,
                    "hakakses" => $request->hakakses,
                ]);
            }
        }
    
        DB::commit();
        return redirect('/akun1')->with('success', 'Data Siswa Berhasil Diperbarui!');
    }
    
        
        function removeall(Request $request)
        {
            $siswa_id_array = $request->input('siswa_id');
            $data = tbguru::whereIn('siswa_id', $siswa_id_array);
        
    
            if ($data->delete()) {
                return response()->json(['message' => 'Data Deleted']);
            }
        }
    
    
    
    
    
    }