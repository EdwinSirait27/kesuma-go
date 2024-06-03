<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nilai;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
class nilaiController extends Controller
{
    public function index(Request $request)
    {
       
        if ($request->ajax()) {
            $data = nilai::with('siswa','siswa.kelas','datakelasdatamengajar.datamengajar.matpel')->select(
                'nilai_id',
                'siswa_id',
                'datakelas_datamengajar_id',
                'nilaiuts'   
                // // 'tugas_id',   
                // 'siswa_organisasi_guru_id',   
                // 'siswa_ekstra_guru_id',   
                // 'nilaiuts',   
                // 'nilaiuas',   
                // 'nilaitugas',   
                // 'nilaiekstra'   
            )->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$nilai_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('nilai.index');
    }
}

