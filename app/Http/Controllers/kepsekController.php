<?php

namespace App\Http\Controllers;
use pdf;
use Illuminate\Http\Request;
use App\Models\kepsek1;
use App\Models\kepsek;

use Yajra\DataTables\DataTables;
class kepsekController extends Controller
{
    public function index(Request $request)
    {
        $data = kepsek1::first(); 
        if ($request->ajax()) {
            $data = kepsek::select('id', 'dokumen', 'created_at')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {
                $button = '<a href="' . route('kepsek.download', $data->dokumen) . '" class="edit btn btn-primary btn-sm">Download</a>';
                return $button;
            })
            
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }

        return view('kepsek.index',compact('data'));
    }
    public function download($dokumen)
    {
        $file = storage_path('app/public/kepsek/' . $dokumen);
        if (file_exists($file)) {
            return response()->download($file);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }
    public function update(Request $request, $id)
    {
        $data = kepsek1::findOrFail($id);
        $data->update([
            'nama' => $request->nama,
                'tempatlahir' => $request->tempatlahir,
                'ttl' => $request->ttl,
                'nomor' => $request->nomor,
                'email' => $request->email,
                'sd' => $request->sd,
                'tahunlulussd' => $request->tahunlulussd,
                'smp' => $request->smp,
                'tahunlulussmp' => $request->tahunlulussmp,
                'sma' => $request->sma,
                'tahunlulussma' => $request->tahunlulussma,
                's1' => $request->s1,
                'institusis1' => $request->institusis1,
                'tahunluluss1' => $request->tahunluluss1,
                's2' => $request->s2,
                'institusis2' => $request->institusis2,
                'tahunluluss2' => $request->tahunluluss2,
                's3' => $request->s3,
                'institusis3' => $request->institusis3,
                'tahunluluss3' => $request->tahunluluss3,
        ]);
        return redirect('/kepsek')->with('success', 'Data berhasil diperbarui');
    }
    public function storeOrUpdate(Request $request)
    {
        // Validasi data input jika diperlukan
        $request->validate([
           
        ]);

        // Mode Edit: Perbarui data yang ada
        if ($request->filled('id')) {
            $data = kepsek1::findOrFail($request->id);
            $data->update([
                'nama' => $request->nama,
                'tempatlahir' => $request->tempatlahir,
                'ttl' => $request->ttl,
                'nomor' => $request->nomor,
                'email' => $request->email,
                'sd' => $request->sd,
                'tahunlulussd' => $request->tahunlulussd,
                'smp' => $request->smp,
                'tahunlulussmp' => $request->tahunlulussmp,
                'sma' => $request->sma,
                'tahunlulussma' => $request->tahunlulussma,
                's1' => $request->s1,
                'institusis1' => $request->institusis1,
                'tahunluluss1' => $request->tahunluluss1,
                's2' => $request->s2,
                'institusis2' => $request->institusis2,
                'tahunluluss2' => $request->tahunluluss2,
                's3' => $request->s3,
                'institusis3' => $request->institusis3,
                'tahunluluss3' => $request->tahunluluss3,
                //Tambahkan kolom lain sesuai kebutuhan
            ]);
        }
        // Mode Tambah: Simpan data baru
        else {
            $data = new kepsek1([
                'nama' => $request->nama,
                'tempatlahir' => $request->tempatlahir,
                'ttl' => $request->ttl,
                'nomor' => $request->nomor,
                'email' => $request->email,
                'sd' => $request->sd,
                'tahunlulussd' => $request->tahunlulussd,
                'smp' => $request->smp,
                'tahunlulussmp' => $request->tahunlulussmp,
                'sma' => $request->sma,
                'tahunlulussma' => $request->tahunlulussma,
                's1' => $request->s1,
                'institusis1' => $request->institusis1,
                'tahunluluss1' => $request->tahunluluss1,
                's2' => $request->s2,
                'institusis2' => $request->institusis2,
                'tahunluluss2' => $request->tahunluluss2,
                's3' => $request->s3,
                'institusis3' => $request->institusis3,
                'tahunluluss3' => $request->tahunluluss3,
                
            ]);
            $data->save();
        }

        return redirect('/kepsek')->with('success', 'Data berhasil disimpan');
    }
    public function simpan(Request $request)
    {
        if (!$request->hasFile('dokumen')) {
            // Flash an error message to the session
            session()->flash('error', 'Anda harus mengunggah dokumen!');

            return redirect('kepsek');
        } else {
            $this->validate($request, [
                'dokumen' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx,csv',
            ]);

            $dokumen = $request->file('dokumen');
            $nama_dokumen = $dokumen->getClientOriginalName();
            $dokumen->storeAs('public/kepsek/', $nama_dokumen);
            
            $data = new kepsek();
            $data->dokumen = $nama_dokumen;
            $data->created_at = now(); // Store the upload date and time

            $data->save();

            // Flash a success message to the session
            session()->flash('success', 'Dokumen berhasil diunggah.');

            return redirect('kepsek');

        }
    }
    function removeall(Request $request)
    {
        $user_id_array = $request->input('id');
        $user = kepsek::whereIn('id', $user_id_array);
        if ($user->delete()) {
        }
    }
}
