<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbguru;
use App\Models\listakun;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
class tbguruallController extends Controller
{

public function index1(Request $request)
{
    $akungurus = listakun::all();
    if ($request->ajax()) {
        $data = tbguru::with(['akunguru'])
            ->select(
                'guru_id',
                'foto',
                'Nama',
                'Agama',
                'JenisKelamin',
                'TugasMengajar',
                'NomorTelephone',
                'Alamat',
                'Email',
                'status'
            )->with('listakun')
            ->whereHas('listakun', function ($query) {
                $query->where('hakakses', 'Admin')
                    ->orWhere('hakakses', 'Guru')
                    ->orWhere('hakakses', 'Kurikulum')
                    ->orWhere('hakakses', 'KepalaSekolah');
            })
            ->get();

        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function ($data) {
                // $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->guru_id . ');" class="btn btn-primary">Edit</button>';
                $encodedId = base64_encode($data->guru_id);
                   
                $button = '<a href="' . route('guruall.show' , ['encodedId' => $encodedId]) .  '" class="btn btn-primary">Edit </a>';

                $encryptedGuruId = substr(Crypt::encryptString($data->guru_id),0, 12);
$redirectButton = '<a href="' . route('guruex.index', ['kesuma-goencrypted' => $encryptedGuruId]) . '" class="btn btn-success">Lihat Detail</a>';
                return $button . ' ' . $redirectButton;
            })
            ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$guru_id}}" />')
            ->rawColumns(['checkbox', 'action'])
            ->make(true);
    }
    return view('guruall.index', compact('akungurus'));
}

    // public function index1(Request $request)
    // {
    //     $akungurus = listakun::all();
    //     if ($request->ajax()) {
    //         $data = tbguru::with(['akunguru'])
    //             ->select(
    //                 'guru_id',
    //                 'foto',
    //                 'Nama',
    //                 'Agama',
    //                 'JenisKelamin',
    //                 'TugasMengajar',
    //                 'NomorTelephone',
    //                 'Alamat',
    //                 'Email',
    //                 'status'
    //             )->with('listakun')
    //             ->whereHas('listakun', function ($query) {
    //                 $query->where('hakakses', 'Admin')
    //                     ->orWhere('hakakses', 'Guru')
    //                     ->orWhere('hakakses', 'Kurikulum')
    //                     ->orWhere('hakakses', 'KepalaSekolah');
    //             })
    //             ->get();

    //         return Datatables::of($data)->addIndexColumn()
    //             ->addColumn('action', function ($data) {
    //                 $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->guru_id . ');" class="btn btn-primary">Edit</button>';
    //                 $redirectButton = '<a href="' . route('guruex.index', ['guru_id' => $data->guru_id]) . '" class="btn btn-success">Lihat Detail</a>';
    //                 return $button . ' ' . $redirectButton;
    //             })
    //             ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$guru_id}}" />')
    //             ->rawColumns(['checkbox', 'action'])
    //             ->make(true);
    //     }
    //     return view('guruall.index', compact('akungurus'));
    // }
    function removeall(Request $request)
    {
        $guru_id_array = $request->input('guru_id');
        DB::beginTransaction();
        try {
            listakun::whereIn('guru_id', $guru_id_array)->delete();
            tbguru::whereIn('guru_id', $guru_id_array)->delete();
            DB::commit();
            return response()->json(['message' => 'Data Deleted']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = tbguru::with('listakun')
                ->whereHas('listakun', function ($query) {
                    $query->where('hakakses', 'Admin')
                        ->orWhere('hakakses', 'Guru')
                        ->orWhere('hakakses', 'Kurikulum')
                        ->orWhere('hakakses', 'KepalaSekolah');
                })
                ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $button = '<button onclick="editAndShow(\'hal_edit\', ' . $data->guru_id . ');" class="btn btn-primary">Edit</button>';
                    return $button;
                })
                ->addColumn('checkbox', '<input type="checkbox" name="users_checkbox[]" class="users_checkbox" value="{{$guru_id}}" />')
                ->rawColumns(['checkbox', 'action'])
                ->make(true);
        }
        return view('guruex.index');
    }
    public function edit($id)
    {
        $data = tbguru::with('listakun')->find($id);
        if ($data) {
            $response = [
                'Nama', 'TempatLahir', 'TanggalLahir', 'Agama', 'JenisKelamin', 'StatusPegawai', 'NipNips',
                'Nuptk', 'Nik', 'Npwp', 'NomorSertifikatPendidik', 'TahunSertifikasi', 'pangkatgt',
                'jadwalkenaikanpangkat', 'jadwalkenaikangaji', 'TMT', 'PendidikanAkhir', 'TahunTamat',
                'Jurusan', 'TugasMengajar', 'TugasTambahan', 'JamPerMinggu', 'TahunPensiun', 'Berkala',
                'Pangkat', 'Jabatan', 'NomorTelephone', 'Alamat', 'Email', 'status', 'foto',
            ];
            foreach ($response as $field) {
                $response[$field] = $data->$field;
            }
            if ($data->listakun) {
                $response += [
                    'username' => $data->listakun->username,
                    'password' => $data->listakun->password,
                    'hakakses' => $data->listakun->hakakses,
                ];
            } else {
                $response += [
                    'username' => null,
                    'password' => null,
                    'hakakses' => null,
                ];
            }
            return response()->json($response);
        }
        return response()->json(null, 404);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'username' => [
                    'required',
                    Rule::unique('users')->ignore($request->txt_id),
                ],
                'foto' => 'image|mimes:jpeg|max:2048', // Menambahkan ekstensi yang diperbolehkan (png, jpg, gif) dan batas maksimum ukuran (2 MB)
            ], [
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Format file gambar harus jpeg.',
                'foto.max' => 'Ukuran file gambar tidak boleh melebihi 2 MB.',
            ]);

            $hakakses = 'Guru';

            if ($request->txt_id !== '0') {
                $existingGuru = tbguru::find($request->txt_id);

                if ($existingGuru) {
                    $existingGuru->Nama = $request->Nama;
                    $existingGuru->TempatLahir = $request->TempatLahir;
                    $existingGuru->TanggalLahir = $request->TanggalLahir;
                    $existingGuru->Agama = $request->Agama;
                    $existingGuru->JenisKelamin = $request->JenisKelamin;
                    $existingGuru->StatusPegawai = $request->StatusPegawai;
                    $existingGuru->NipNips = $request->NipNips;
                    $existingGuru->Nuptk = $request->Nuptk;
                    $existingGuru->Nik = $request->Nik;
                    $existingGuru->Npwp = $request->Npwp;
                    $existingGuru->NomorSertifikatPendidik = $request->NomorSertifikatPendidik;
                    $existingGuru->TahunSertifikasi = $request->TahunSertifikasi;
                    $existingGuru->pangkatgt = $request->pangkatgt;
                    $existingGuru->jadwalkenaikanpangkat = $request->jadwalkenaikanpangkat;
                    $existingGuru->jadwalkenaikangaji = $request->jadwalkenaikangaji;
                    $existingGuru->TMT = $request->TMT;
                    $existingGuru->PendidikanAkhir = $request->PendidikanAkhir;
                    $existingGuru->TahunTamat = $request->TahunTamat;
                    $existingGuru->Jurusan = $request->Jurusan;
                    $existingGuru->TugasMengajar = $request->TugasMengajar;
                    $existingGuru->TugasTambahan = $request->TugasTambahan;
                    $existingGuru->JamPerMinggu = $request->JamPerMinggu;
                    $existingGuru->TahunPensiun = $request->TahunPensiun;
                    $existingGuru->Berkala = $request->Berkala;
                    $existingGuru->Pangkat = $request->Pangkat;
                    $existingGuru->Jabatan = $request->Jabatan;
                    $existingGuru->NomorTelephone = $request->NomorTelephone;
                    $existingGuru->Alamat = $request->Alamat;
                    $existingGuru->Email = $request->Email;
                    $existingGuru->status = $request->status;


                    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                        $file = $request->file('foto');
                        $fileName = time() . '_' . $file->getClientOriginalName(); // Gunakan timestamp untuk membuat nama file unik
                        $file->move(public_path('fotoguru/'), $fileName); // Pindahkan file ke direktori publik
                        $existingGuru->foto = $fileName; // Simpan nama file ke dalam database
                    }

                    $existingGuru->save();

                    if ($existingGuru->listakun) {
                        $existingGuru->listakun->update([
                            "username" => $request->username,
                            "password" => bcrypt($request->password),
                            "hakakses" => $hakakses,
                        ]);
                    } else {
                        if ($request->username && $request->password) {
                            $existingGuru->listakun()->create([
                                "username" => $request->username,
                                "password" => bcrypt($request->password),
                                "hakakses" => $hakakses,
                                "remember_token" => Str::random(60),
                            ]);
                        }
                    }
                }
            } else {
                $val = [

                    "Nama" => $request->Nama,
                    "TempatLahir" => $request->TempatLahir,
                    "TanggalLahir" => $request->TanggalLahir,
                    "Agama" => $request->Agama,
                    "JenisKelamin" => $request->JenisKelamin,
                    "StatusPegawai" => $request->StatusPegawai,
                    "NipNips" => $request->NipNips,
                    "Nuptk" => $request->Nuptk,
                    "Nik" => $request->Nik,
                    "Npwp" => $request->Npwp,
                    "NomorSertifikatPendidik" => $request->NomorSertifikatPendidik,
                    "TahunSertifikasi" => $request->TahunSertifikasi,
                    "pangkatgt" => $request->pangkatgt,
                    "jadwalkenaikanpangkat" => $request->jadwalkenaikanpangkat,
                    "jadwalkenaikangaji" => $request->jadwalkenaikangaji,
                    "TMT" => $request->TMT,
                    "PendidikanAkhir" => $request->PendidikanAkhir,
                    "TahunTamat" => $request->TahunTamat,
                    "Jurusan" => $request->Jurusan,
                    "TugasMengajar" => $request->TugasMengajar,
                    "TugasTambahan" => $request->TugasTambahan,
                    "JamPerMinggu" => $request->JamPerMinggu,
                    "TahunPensiun" => $request->TahunPensiun,
                    "Berkala" => $request->Berkala,
                    "Pangkat" => $request->Pangkat,
                    "Jabatan" => $request->Jabatan,
                    "NomorTelephone" => $request->NomorTelephone,
                    "Alamat" => $request->Alamat,
                    "Email" => $request->Email,
                    "status" => $request->status,

                ];
                $newGuru = tbguru::create($val);

                if ($newGuru) {
                    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
                        $file = $request->file('foto');
                        $fileName = time() . '_' . $file->getClientOriginalName(); // Gunakan timestamp untuk membuat nama file unik
                        $file->move(public_path('fotoguru/'), $fileName); // Pindahkan file ke direktori publik
                        $newGuru->foto = $fileName; // Simpan nama file ke dalam database
                    }

                    $newGuru->save();

                    $newGuru->listakun()->create([
                        "username" => $request->username,
                        "password" => bcrypt($request->password),
                        "hakakses" => $hakakses,
                        "remember_token" => Str::random(60),
                    ]);
                }
            }

            DB::commit();
            return redirect('/guruall')->with('success', 'Guru Berhasil Diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    public function show(Request $request)
    {
        $encodedId = $request->encodedId;
        $guru_id = base64_decode($encodedId);
       
        $guru = tbguru::with('listakun')->findOrFail($guru_id);
        return view('guruall.show', compact('guru'));
    }
    public function indexxx(Request $request)
    {
        $encodedId = $request->encodedId;
        $guru_id = base64_decode($encodedId);
       
        $guru = tbguru::with('listakun')->findOrFail($guru_id);
        return view('editpasswordguru.index', compact('guru'));
    }
    public function show1(Request $request)
    {
        $encodedId = $request->encodedId;
        $guru_id = base64_decode($encodedId);
        $guru = tbguru::with('listakun')->findOrFail($guru_id);
        return view('editpasswordguru.index', compact('guru'));
    }
    public function updatee(Request $request)
    {
        $encodedId = $request->encodedId;
        $guru_id = base64_decode($encodedId);
        $request->validate([
            'foto' => 'image|mimes:jpeg|max:512', 
        ], [
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format file gambar harus jpeg.',
            'foto.max' => 'Ukuran file gambar tidak boleh melebihi 512 KB.',
        ]);
        $guru = tbguru::with('listakun')->findOrFail($guru_id);
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName(); 
            $file->storeAs('public/fotoguru', $fileName); 
            $guru->foto = $fileName;
        }
       
        $guru->Nama = $request->input('Nama');
$guru->TempatLahir = $request->input('TempatLahir');
$guru->TanggalLahir = $request->input('TanggalLahir');
$guru->Agama = $request->input('Agama');
$guru->JenisKelamin = $request->input('JenisKelamin');
$guru->StatusPegawai = $request->input('StatusPegawai');
$guru->NipNips = $request->input('NipNips');
$guru->Nuptk = $request->input('Nuptk');
$guru->Nik = $request->input('Nik');
$guru->Npwp = $request->input('Npwp');
$guru->NomorSertifikatPendidik = $request->input('NomorSertifikatPendidik');
$guru->TahunSertifikasi = $request->input('TahunSertifikasi');
$guru->pangkatgt = $request->input('pangkatgt');
$guru->jadwalkenaikanpangkat = $request->input('jadwalkenaikanpangkat');
$guru->jadwalkenaikangaji = $request->input('jadwalkenaikangaji');
$guru->TMT = $request->input('TMT');
$guru->PendidikanAkhir = $request->input('PendidikanAkhir');
$guru->TahunTamat = $request->input('TahunTamat');
$guru->Jurusan = $request->input('Jurusan');
$guru->TugasMengajar = $request->input('TugasMengajar');
$guru->TugasTambahan = $request->input('TugasTambahan');
$guru->JamPerMinggu = $request->input('JamPerMinggu');
$guru->TahunPensiun = $request->input('TahunPensiun');
$guru->Berkala = $request->input('Berkala');
$guru->Pangkat = $request->input('Pangkat');
$guru->Jabatan = $request->input('Jabatan');
$guru->NomorTelephone = $request->input('NomorTelephone');
$guru->Alamat = $request->input('Alamat');
$guru->Email = $request->input('Email');
$guru->status = $request->input('status');

        $guru->save();
      
        
        // return redirect()->route('siswaall.show', $siswa_id)->with('success', 'Data siswa berhasil diperbarui.');
        return redirect()->route('guruall.show', ['encodedId' => base64_encode($guru_id)])->with('success', 'Data Guru berhasil diperbarui.');

    }
    public function updateee(Request $request)
    {
        $encodedId = $request->encodedId;
        $guru_id = base64_decode($encodedId);
        $request->validate([
            'password' => 'required',
          
        ]);
        $guru = tbguru::with('listakun')->findOrFail($guru_id);
        
        $hashedPassword = Hash::make($request->input('password'));

        // Update password untuk setiap akun siswa terkait
        $guru->listakun()->update(['password' => $hashedPassword]);
$guru->save();
        return redirect()->route('editpasswordguru.index', ['encodedId' => base64_encode($guru_id)])->with('success', 'Password berhasil diperbarui.');

    }
}
