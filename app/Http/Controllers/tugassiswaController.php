<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatakelasDatamengajar;
use App\Models\tugas;
use Yajra\DataTables\DataTables;
class tugassiswaController extends Controller
{
    public function index(Request $request)
    {
        $siswa = auth()->user()->siswa;
    
        if ($request->ajax()) {
            $data = Tugas::whereHas('datakelasdatamengajar', function ($query) use ($siswa) {
                $query->whereHas('datakelas', function ($subquery) use ($siswa) {
                    $subquery->where('kelas_id', $siswa->kelas_id);
                });
            })->with(['datakelasdatamengajar.datamengajar.matpel','datakelasdatamengajar.datakelas.kelas'])->select(
                'tugas_id',
                'datakelas_datamengajar_id',
                'dokumen',
                'keterangan',
                'created_at',
                'updated_at'
            )->get();
    
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                   $redirectButton = '<a href="' . route('download.tugas',['tugas_id' => $data->tugas_id]) . '" class="btn btn-success">Download Tugas</a>';
                    return $redirectButton;
                    
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$tugas_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        $datakelasdatamengajars =DatakelasDatamengajar::whereHas('datakelas', function ($query) use ($siswa) {
            $query->where('kelas_id', $siswa->kelas_id);
        })->with(['datamengajar.matpel'])->get();
    
        return view('lihattugas.index', compact('datakelasdatamengajars'));
    }
}
