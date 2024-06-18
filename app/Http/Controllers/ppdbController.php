<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbsiswa;
use App\Models\ppdb;
use App\Models\listakunsiswa;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class ppdbController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = tbsiswa::select(
                'siswa_id',
                'foto',
                'NamaLengkap',
                'NISN',
                'JenisKelamin',
                'TanggalLahir',
                'Agama',
                'NomorTelephone',
                'Email',
                'Alamat',
                'AsalSMP',
                'NomorTelephoneAyah',
                'NamaAyah'
            )->with('listakunsiswa')
                ->whereHas('listakunsiswa', function ($query) {
                    $query->where('hakakses', 'NonSiswa');
                })
                ->get();

            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->siswa_id . ');" class="btn btn-primary">Edit</button>';
                  
                    return $button;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$siswa_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('ppdb.index');
    }
   

    public function update(Request $request)
    {
        // Validasi request
        $request->validate([
            'siswa_id' => 'required|array',

        ]);

        // Ambil siswa_id dari request
        $siswaIds = $request->input('siswa_id');

        // Lakukan pengubahan hak akses menjadi "Siswa" untuk setiap siswa yang dipilih
        tbsiswa::whereIn('siswa_id', $siswaIds)->each(function ($siswa) {
            $siswa->update(['status' => 'Aktif']);
            $siswa->listakunsiswa()->update(['hakakses' => 'Siswa']); // Perbarui hak akses di relasi listakunsiswa
        });

        // Beri respons sukses
        return response()->json(['message' => 'Hak akses berhasil diubah menjadi Siswa']);
    }
    public function update2(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'password' => [
                    'required',
                    'string',
                    'min:7',
                    'max:12',
                    'regex:/^\S*$/', // menambahkan regex untuk memastikan tidak ada spasi
                
                ],
                'foto' => ['image|mimes:jpeg|max:512', 
'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Format file gambar harus jpeg.',
                'foto.max' => 'Ukuran file gambar tidak boleh melebihi 512 KB.',
            ],
            ]);
           
            if ($request->txt_id !== '0') {
                $existingSiswa = tbsiswa::find($request->txt_id);
                if ($existingSiswa) {
                    $existingSiswa->NamaLengkap = $request->NamaLengkap;
                    $existingSiswa->JenisKelamin = $request->JenisKelamin;
                    $existingSiswa->TanggalLahir = $request->TanggalLahir;
                    $existingSiswa->Agama = $request->Agama;
                    $existingSiswa->Alamat = $request->Alamat;
                    $existingSiswa->Email = $request->Email;
                    $existingSiswa->NomorTelephone = $request->NomorTelephone;
                    $existingSiswa->AsalSMP = $request->AsalSMP;
                    $existingSiswa->NamaAyah = $request->NamaAyah;
                    $existingSiswa->NomorTelephoneAyah = $request->NomorTelephoneAyah;
                    $existingSiswa->cita = $request->cita;
                    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                        $file = $request->file('foto');
                        $fileName = time() . '_' . $file->getClientOriginalName(); // Gunakan timestamp untuk membuat nama file unik
                        $file->storeAs('public/fotosiswa', $fileName);
                        $existingSiswa->foto = $fileName; // Simpan nama file ke dalam database
                    }
                    $existingSiswa->save();
                    if ($existingSiswa->listakunsiswa) {
                        $existingSiswa->listakunsiswa->update([
                            "username" => $request->username,
                            "password" => bcrypt($request->password),
                        ]);
                    } else {
                        if ($request->username && $request->password) {
                            $existingSiswa->listakunsiswa()->create([
                                "username" => $request->username,
                                "password" => bcrypt($request->password),
                               
                                "remember_token" => Str::random(60),
                            ]);
                        }
                    }
                }
            } else {
                $val = [
                    "NamaLengkap" => $request->NamaLengkap,
                    "NomorInduk" => $request->NomorInduk,
                    "JenisKelamin" => $request->JenisKelamin,
                    "TanggalLahir" => $request->TanggalLahir,
                    "Agama" => $request->Agama,
                    "Alamat" => $request->Alamat,
                    "Email" => $request->Email,
                    "NomorTelephone" => $request->NomorTelephone,
                    "AsalSMP" => $request->AsalSMP,
                    "NamaAyah" => $request->NamaAyah,
                    "NomorTelephoneAyah" => $request->NomorTelephoneAyah,
                    "cita" => $request->cita,
                ];
                $newSiswa = tbsiswa::create($val);
                if ($newSiswa) {
                    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                        $file = $request->file('foto');
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('fotosiswa/'), $fileName);
                        $newSiswa->foto = $fileName;
                    }
                    $newSiswa->save();
                    $newSiswa->listakunsiswa()->create([
                        "username" => $request->username,
                        "password" => bcrypt($request->password),         
                       
                    ]);
                }
            }
            DB::commit();
            return redirect('/ppdb')->with('success', 'Siswa Berhasil Diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }




    function removeall(Request $request)
    {
        $siswa_id_array = $request->input('siswa_id');

        DB::beginTransaction();
        try {
            listakunsiswa::whereIn('siswa_id', $siswa_id_array)->delete();
            tbsiswa::with('kelas')->whereIn('siswa_id', $siswa_id_array)->delete();
            DB::commit();

            return response()->json(['message' => 'Data Deleted']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }
    // function removeall(Request $request)
    // {
    //     $siswa_id_array = $request->input('siswa_id');

    //     DB::beginTransaction();
    //     try {
    //         listakunsiswa::whereIn('siswa_id', $siswa_id_array)->delete();
    //         tbsiswa::whereIn('siswa_id', $siswa_id_array)->delete();
    //         DB::commit();

    //         return response()->json(['message' => 'Data Deleted']);
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         return response()->json(['error' => $e->getMessage()]);
    //     }
    // }
    public function edit($id)
    {
        $data = tbsiswa::with('listakunsiswa')->find($id);
        if ($data) {
            $response = [
                'foto',
                'NOPDF',
                'NamaLengkap',
                'NomorInduk',
                'NamaPanggilan',
                'JenisKelamin',
                'NISN',
                'TempatLahir',
                'TanggalLahir',
                'Agama',
                'Alamat',
                'RT',
                'RW',
                'Kelurahan',
                'Kecamatan',
                'KabKota',
                'Provinsi',
                'KodePos',
                'Email',
                'NomorTelephone',
                'Kewarganegaraan',
                'NIK',
                'GolDarah',
                'TinggalDengan',
                'StatusSiswa',
                'AnakKe',
                'SaudaraKandung',
                'SaudaraTiri',
                'Tinggicm',
                'Beratkg',
                'RiwayatPenyakit',
                'AsalSMP',
                'AlamatSMP',
                'NPSNSMP',
                'KabKotaSMP',
                'ProvinsiSMP',
                'NoIjasah',
                'NoSKHUN',
                'DiterimaTanggal',
                'DiterimaDiKelas',
                'DiterimaSemester',
                'MutasiAsalSMA',
                'AlasanPindah',
                'NoPesertaUNSMP',
                'TglIjasah',
                'NamaOrangTuaPadaIjasah',
                'NamaAyah',
                'TahunLahirAyah',
                'AlamatAyah',
                'NomorTelephoneAyah',
                'AgamaAyah',
                'PendidikanTerakhirAyah',
                'PekerjaanAyah',
                'PenghasilanAyah',
                'NamaIbu',
                'TahunLahirIbu',
                'AlamatIbu',
                'NomorTelephoneIbu',
                'AgamaIbu',
                'PendidikanTerakhirIbu',
                'PekerjaanIbu',
                'PenghasilanIbu',
                'NamaWali',
                'TahunLahirWali',
                'AlamatWali',
                'NomorTelephoneWali',
                'AgamaWali',
                'PendidikanTerakhirWali',
                'PekerjaanWali',
                'WaliPenghasilan',
                'StatusHubunganWali',
                'MenerimaBeasiswaDari',
                'TahunMeninggalkanSekolah',
                'AlasanSebab',
                'TamatBelajarTahun',
                'TanggalNomorSTTB',
                'InformasiLain',
                'cita',
                'status',
            ];

            foreach ($response as $field) {
                $response[$field] = $data->$field;
            }
            if ($data->listakunsiswa) {
                $response += [
                    'username' => $data->listakunsiswa->username,
                    'password' => $data->listakunsiswa->password,
                   
                ];
            } else {
                $response += [
                    'username' => null,
                    'password' => null,
                    
                ];
            }
            return response()->json($response);
        }
        return response()->json(null, 404);
    }
    public function index2(Request $request)
    {
        $ppdbs = ppdb::all();
        if ($request->ajax()) {
            $data = ppdb::select(
                'id',
                'url',
                'start_date',
                'end_date'
            )->get();

            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->id . ');" class="btn btn-primary">Edit</button>';
                  
                    return $button;
                })
                // ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$id}}" />')
                ->rawColumns([ 'action'])
                ->make(true);
        }
        return view('buttonppdb.index', compact('ppdbs'));
    }
    
    function removeall1(Request $request)
    {
        $id_array = $request->input('id');
        $data = ppdb::whereIn('id', $id_array);
    

        if ($data->delete()) {
            return response()->json(['message' => 'Data Deleted']);
        }
    }
    public function edit1($id)
    {
        $data = ppdb::find($id);
        if ($data) {
            
            $url = $data->url;
            $start_date = $data->start_date;
            $end_date = $data->end_date;
            
            
            return response()->json([
            
                "url" => $url,
                "start_date" => $start_date,
                "end_date" => $end_date
            ]);
        }
        return response()->json(null, 404);
    }
    public function update3(Request $request)
    {
        DB::beginTransaction();
        if ($request->txt_id <> '0') {
            ppdb::where('id', '=', $request->txt_id)->update([ // Ganti 'id' dengan 'jurusan_id'
            
                // "url" => $request->url,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                
            ]);
        } else {
            
            // $val["url"] = $request->url;
            $val["start_date"] = $request->start_date;
            $val["end_date"] = $request->end_date;
            
            ppdb::create($val);
        }
        DB::commit();
        return redirect('/buttonppdb')->with('success', 'tanggal ppdb Berhasil Ditambahkan!');
    }
}
