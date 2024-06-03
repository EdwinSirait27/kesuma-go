<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbguru;
use App\Models\listakun;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Pagination\Paginator;
class listakunController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
     
        $data = tbguru::with('listakun')->get();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {
                $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->guru_id . ');" class="btn btn-primary">Edit</button>';

                return $button;
            })
            ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$guru_id}}" />')
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }

    return view('SUBeranda.index');
}

public function edit($id)
{
    $guru = tbguru::with('listakun')->find($id);

    if ($guru) {
        $Nama = $guru->Nama;

        // Mengambil data dari relasi listakun jika sudah didefinisikan di model tbguru.
        $listakun = $guru->listakun;

        if ($listakun) {
            $username = $listakun->username;
            $password = $listakun->password;
            $hakakses = $listakun->hakakses;
        } else {
            $username = null;
            $password = null;
            $hakakses = null;
        }

        return response()->json([
            "txt_Nama" => $Nama,
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
        tbguru::where('guru_id', $request->txt_id)->update([
            "Nama" => $request->txt_Nama,
        ]);
        // Jika Anda ingin mengupdate data pada relasi listakun, lakukan seperti ini
        $guru = tbguru::find($request->txt_id);
        if ($guru) {
            $listakun = $guru->listakun;
            if ($listakun) {
                $listakun->update([
                    "username" => $request->username,
                    "password" => bcrypt($request->password),
                    "hakakses" => $request->hakakses,
                ]);
            }
        }
    } else {
        $val["Nama"] = $request->txt_Nama;

        // Buat data baru pada model tbguru dan relasi listakun
        $guru = tbguru::create($val);

        if ($guru) {
            $guru->listakun()->create([
                "username" => $request->username,
                "password" => $request->password,
                "hakakses" => $request->hakakses,
            ]);
        }
    }

    DB::commit();
    return redirect('/akun')->with('success', 'Tenaga Pengajar Berhasil Diperbarui!');
}

    
    function removeall(Request $request)
    {
        $guru_id_array = $request->input('guru_id');
        $data = tbguru::whereIn('guru_id', $guru_id_array);
    

        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }





}