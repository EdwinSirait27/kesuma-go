<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbsiswa;
use App\Models\nilai;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class importController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Mendapatkan siswa yang belum memiliki nilai
            $data = tbsiswa::whereDoesntHave('nilai')
                ->select('siswa_id', 'NamaLengkap')
                ->get();
    
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$siswa_id}}" />')
                ->rawColumns(['checkbox'])
                ->make(true);
        }
        return view('importsiswa.index');
    }
    
    // public function index(Request $request)
    // {
       
    //     if ($request->ajax()) {
    //         $data = tbsiswa::select(
            
    //             'siswa_id',
    //             'NamaLengkap'
                
    //         )->get();
    //         return Datatables::of($data)->addIndexColumn()
                
    //             ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$siswa_id}}" />')
    //             ->rawColumns(['checkbox'])
    //             ->make(true);
    //     }
    //     return view('importsiswa.index');
    // }
    public function update(Request $request)
    {
        $selectedSiswaIds = $request->input('users_checkbox', []);
        if (empty($selectedSiswaIds)) {
            return redirect()->back()->with('error', 'Tidak ada siswa yang dipilih.');
        }
    foreach ($selectedSiswaIds as $siswaId) {
            $nilai = new Nilai();
            $nilai->siswa_id = $siswaId;
            $nilai->save();
        }
        return redirect()->back()->with('success', 'Siswa berhasil diimpor ke model Nilai.');
    }
    
}
