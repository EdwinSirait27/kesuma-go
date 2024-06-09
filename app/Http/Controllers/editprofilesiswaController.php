<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\ekstraguru;
use App\Models\organisasiguru;
use App\Models\SiswaEkstraGuru;
use App\Models\SiswaOrganisasiGuru;
use Illuminate\Support\Facades\DB; 

class editprofilesiswaController extends Controller
{
    public function showekskul()
    {
        $siswa = auth()->user()->siswa;
        $namaLengkap = $siswa->NamaLengkap;
        $kelas = $siswa->kelas->namakelas ?? 'Belum Ada Kelas';
        $ekstraguru = ekstraguru::all();
        $siswaEkstraGurus = $siswa->ekstragurus;
        return view('ekstrakulikulersiswa.index', compact('namaLengkap', 'kelas', 'siswaEkstraGurus'));
    }
    public function showorganisasi()
    {
        $siswa = auth()->user()->siswa;
        $namaLengkap = $siswa->NamaLengkap;
        $kelas = $siswa->kelas->namakelas ?? 'Belum Ada Kelas';
        $organisasiguru = organisasiguru::all();
        $siswaOrganisasiGurus = $siswa->organisasigurus;
        return view('organisasisiswa.index', compact('namaLengkap', 'kelas', 'siswaOrganisasiGurus'));
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'ekstra_guru_id' => 'required_without:bidang_lain|array',
    ], [
        'ekstra_guru_id.required_without' => 'Anda harus memilih setidaknya satu ekstrakulikuler.',
    ]);

    try {
        // Mengambil user yang sedang login
        $user = Auth::user();

        // Mengambil siswa_id dari user yang sedang login
        $siswaId = $user->siswa_id;

        // Memeriksa keberadaan siswa dengan ID yang sesuai
        if (!$siswaId) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        // Memeriksa pendaftaran ekstrakurikuler untuk setiap id yang dipilih
        foreach ($request->ekstra_guru_id as $ekstraGuruId) {
            $existingEntry = SiswaEkstraGuru::where('siswa_id', $siswaId)
                ->where('ekstra_guru_id', $ekstraGuruId)
                ->exists();
            if ($existingEntry) {
                return redirect()->back()->with('warning', 'Anda sudah mendaftar kegiatan ekstrakurikuler ini sebelumnya.');
            }

            $countEkstraGuru = SiswaEkstraGuru::where('siswa_id', $siswaId)->count();
            if ($countEkstraGuru >= 3) {
                return redirect()->back()->with('error', 'Anda hanya boleh mendaftar hingga 3 ekstrakulikuler.');
            }

            $ekstraGuru = EkstraGuru::with('ekskul')->find($ekstraGuruId);
            $kapasitasEkstra = $ekstraGuru->ekskul->kapasitas;
            $countSiswaMendaftar = SiswaEkstraGuru::where('ekstra_guru_id', $ekstraGuruId)->count();
            if ($countSiswaMendaftar >= $kapasitasEkstra) {
                return redirect()->back()->with('error', 'Kapasitas ekstrakurikuler ' . $ekstraGuru->ekskul->namaekskul . ' telah mencapai batas maksimal.');
            }

            $siswaEkstraGuru = new SiswaEkstraGuru();
            $siswaEkstraGuru->siswa_id = $siswaId;
            $siswaEkstraGuru->ekstra_guru_id = $ekstraGuruId;
            $siswaEkstraGuru->save();
        }

        return redirect()->back()->with('success', 'Pendaftaran pada ekstrakurikuler berhasil.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
    }
}


    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'ekstra_guru_id' => 'required_without:bidang_lain|array',
    //     ], [
    //         'ekstra_guru_id.required_without' => 'Anda harus memilih setidaknya satu ekstrakulikuler.',
    //     ]);
    //     try {
    //         $siswaId = Auth::id(); // Dapatkan ID dari pengguna yang diautentikasi (mungkin seorang siswa)
    //         foreach ($request->ekstra_guru_id as $ekstraGuruId) {
    //             $existingEntry = SiswaEkstraGuru::where('siswa_id', $siswaId)
    //                 ->where('ekstra_guru_id', $ekstraGuruId)
    //                 ->exists();
    //             if ($existingEntry) {
    //                 return redirect()->back()->with('warning', 'Anda sudah mendaftar kegiatan ekstrakurikuler ini sebelumnya.');
    //             }
    //             $countEkstraGuru = SiswaEkstraGuru::where('siswa_id', $siswaId)->count();
    //             if ($countEkstraGuru >= 3) {
    //                 return redirect()->back()->with('error', 'Anda hanya boleh mendaftar hingga 3 ekstrakulikuler.');
    //             }
    //             $ekstraGuru = ekstraguru::with('ekskul')->find($ekstraGuruId);
    //             $kapasitasEkstra = $ekstraGuru->ekskul->kapasitas;
    //             $countSiswaMendaftar = SiswaEkstraGuru::where('ekstra_guru_id', $ekstraGuruId)->count();
    //             if ($countSiswaMendaftar >= $kapasitasEkstra) {
    //                 return redirect()->back()->with('error', 'Kapasitas ekstrakurikuler ' . $ekstraGuru->ekskul->namaekskul . ' telah mencapai batas maksimal.');
    //             }
    //             $siswaEkstraGuru = new SiswaEkstraGuru();
    //             $siswaEkstraGuru->siswa_id = $siswaId;
    //             $siswaEkstraGuru->ekstra_guru_id = $ekstraGuruId;
    //             $siswaEkstraGuru->save();
    //         }
    //         return redirect()->back()->with('success', 'Pendaftaran pada ekstrakurikuler berhasil.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
    //     }
    // }
    public function storee(Request $request)
    {
        $validatedData = $request->validate([
            'organisasi_guru_siswa_id' => 'required_without:bidang_lain',
        ], [
            'organisasi_guru_siswa_id.required_without' => 'Anda harus memilih setidaknya satu Organisasi.',
        ]);
        try {
            $user = Auth::user();

            // Mengambil siswa_id dari user yang sedang login
            $siswaId = $user->siswa_id;
    
            // Memeriksa keberadaan siswa dengan ID yang sesuai
            if (!$siswaId) {
                return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
            }
    
            foreach ($request->organisasi_guru_siswa_id as $organisasiGuruId) {
                $existingEntry = SiswaOrganisasiGuru::where('siswa_id', $siswaId)
                    ->where('organisasi_guru_siswa_id', $organisasiGuruId)
                    ->exists();
                if ($existingEntry) {
                    return redirect()->back()->with('warning', 'Anda sudah mendaftar kegiatan Organisasi ini sebelumnya.');
                }
                $countOrganisasiGuru = SiswaOrganisasiGuru::where('siswa_id', $siswaId)->count();
                if ($countOrganisasiGuru >= 3) {
                    return redirect()->back()->with('error', 'Anda hanya boleh mendaftar hingga 2 organisasi.');
                }
                $organisasiGuru = organisasiGuru::with('organ')->find($organisasiGuruId);
                $kapasitasOrganisasi = $organisasiGuru->organ->kapasitas;
                $countSiswaMendaftar = SiswaorganisasiGuru::where('organisasi_guru_siswa_id', $organisasiGuruId)->count();

                if ($countSiswaMendaftar >= $kapasitasOrganisasi) {
                    return redirect()->back()->with('error', 'Kapasitas Organisasi ' . $organisasiGuru->organ->nama . ' telah mencapai batas maksimal.');
                }
                $siswaOrganisasiGuru = new SiswaOrganisasiGuru();
                $siswaOrganisasiGuru->siswa_id = $siswaId;
                $siswaOrganisasiGuru->organisasi_guru_siswa_id = $organisasiGuruId;
                $siswaOrganisasiGuru->save();
            }
            return redirect()->back()->with('success', 'Pendaftaran pada organisasi berhasil.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Pesan Kesalahan: ' . $e->getMessage());
        }
    }
    public function hapusOrganisasiSiswa(Request $request)
    {
        $siswa = auth()->user()->siswa;
        $siswaOrganisasiGuruIds = $request->input('hapusCheckbox');
        if ($siswaOrganisasiGuruIds !== null && count($siswaOrganisasiGuruIds) > 0) {
            $deletedCount = 0;
            foreach ($siswaOrganisasiGuruIds as $organisasiGuruId) {
                $organisasiGuru = $siswa->organisasigurus()->where('siswa_organisasi_guru_id', $organisasiGuruId)->first();
                if ($organisasiGuru) {
                    $organisasiGuru->delete();
                    $deletedCount++;
                }
            }
            if ($deletedCount > 0) {
                return redirect()->back()->with('success', 'Organisasi yang dipilih berhasil dihapus.');
            } else {
                return redirect()->back()->with('error', 'Tidak ada Organisasi yang dipilih untuk dihapus.');
            }
        } else {
            return redirect()->back()->with('error', 'Tidak ada Organisasi yang dipilih untuk dihapus.');
        }
    }
    public function hapus(Request $request)
    {
        $siswa = auth()->user()->siswa;
        $siswaEkstraGuruIds = $request->input('hapusCheckbox');
        if ($siswaEkstraGuruIds !== null && count($siswaEkstraGuruIds) > 0) {
            $deletedCount = 0;
            foreach ($siswaEkstraGuruIds as $ekstraGuruId) {
                $ekstraGuru = $siswa->ekstragurus()->where('siswa_ekstra_guru_id', $ekstraGuruId)->first();
                if ($ekstraGuru) {
                    $ekstraGuru->delete();
                    $deletedCount++;
                }
            }
            if ($deletedCount > 0) {
                return redirect()->back()->with('success', 'Ekstrakurikuler yang dipilih berhasil dihapus.');
            } else {
                return redirect()->back()->with('error', 'Tidak ada ekstrakurikuler yang dipilih untuk dihapus.');
            }
        } else {
            return redirect()->back()->with('error', 'Tidak ada ekstrakurikuler yang dipilih untuk dihapus.');
        }
    }
    public function create()
    {
        $ekstragurus = ekstraguru::all();
        return view('ekstrakulikulersiswa.store', compact('ekstragurus'));
    }
    public function listekstrakulikuler()
    {
        $ekstragurus = ekstraguru::all();
        $ekstrakurikulers = ekstraguru::all();
        return view('ekstrakulikulersiswa.list', compact('ekstrakurikulers', 'ekstragurus'));
    }
    public function createe()
    {
        // Mengambil semua data Ekstraguru
        $organisasigurus = organisasiguru::all();

        return view('organisasisiswa.store', compact('organisasigurus'));
    }
    public function listorganisasi()
    {
        $organisasigurus = organisasiguru::all();

        $organisasis = organisasiguru::all();
        return view('organisasisiswa.list', compact('organisasis', 'organisasigurus'));
    }
    public function index()
    {
        $akunsiswa = auth::user()->akunsiswa;
        $siswa = auth::user()->siswa;
        $availableRoles = explode(',', $akunsiswa->getRawOriginal('role'));
        $kelas = $siswa->kelas->namakelas ?? 'Belum Ada Kelas';
        $siswaOrganisasiGurus = $siswa->organisasigurus;
        $siswaEkstraGurus = $siswa->ekstragurus;
        return view('editprofilesiswa.index', compact('siswa', 'akunsiswa', 'availableRoles', 'kelas', 'siswaOrganisasiGurus', 'siswaEkstraGurus'));
    }
    public function update(Request $request)
    {
        $user = auth()->user();
        $akunsiswa = $user->akunsiswa;
        $siswa = $user->siswa;
        $request->validate(
            [
                'foto' => 'image|mimes:jpeg|max:512',
            ],
            [
                'foto.image' => 'File harus berupa gambar.',
                'foto.mimes' => 'Format file gambar harus jpeg.',
                'foto.max' => 'Ukuran file gambar tidak boleh melebihi 512 KB.',
                'NamaPanggilan' => 'required',
                'Email' => 'required',
                'NomorTelephone' => 'required',
                'cita' => 'required',

                'RiwayatPenyakit' => 'required',
            ]
        );
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/fotosiswa', $fileName);
            $siswa->foto = $fileName; 
        }
        if ($request->has('password')) {
            $akunsiswa->update([
                'password' => Hash::make($request->input('password')),
                "remember_token" => Str::random(60),
            ]);
        }
        $siswa->update($request->only([
            'NamaPanggilan',
            'Email',
            'NomorTelephone',
            'RiwayatPenyakit',
            'cita',
        ]));
        return redirect('/editprofilesiswa')->with('success', 'Profil berhasil diperbarui!');
    }
    public function indexx()
    {
        $akunsiswa = auth()->user()->akunsiswa;
        $siswa = auth()->user()->siswa;
        
        return view('editpasssiswa.index', compact('siswa', 'akunsiswa'));
    }
    public function updatee(Request $request)
    {
        $user = auth()->user();
        $akunsiswa = $user->akunsiswa;
        if ($request->has('password') && !Hash::check($request->input('password'), $akunsiswa->password)) {
            // Jika password berbeda, lakukan update
            $akunsiswa->update([
                'password' => Hash::make($request->input('password')),
                'remember_token' => Str::random(60),
            ]);
            return redirect('/editpasssiswa')->with('success', 'Edit Password berhasil diperbarui!');
        } else {
            return redirect('/editpasssiswa')->with('warning', 'Tidak ada perubahan data');
        }
    }
}
