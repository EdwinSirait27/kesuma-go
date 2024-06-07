@extends('index')
@section('title', 'Kesuma-GO | Edit Profile')
@section('content')
<style>
    .dashboard_graph {
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fff;
        margin-bottom: 20px;
    }

    @media (max-width: 767.98px) {
        .dashboard_graph {
            padding: 10px;
        }
    }

    label {
        font-size: 18px;
    }
    input:valid {
border-color: #28a745; /* Hijau */
}

input:invalid {
border-color: #dc3545; /* Merah */
}
.btn-back {
transition: transform 0.3s ease;
}

.btn-back:hover {
transform: scale(1.1);
}
input[type="text"],
input[type="password"] {
width: 100%;
padding: 10px;
font-size: 16px;
border: 1px solid #ccc; /* Warna border input */
border-radius: 5px;
transition: border-color 0.3s ease; /* Transisi warna border */
}

input[type="text"]:focus,
input[type="password"]:focus {
border-color: #007bff; /* Warna border saat input difokuskan */
box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Efek bayangan saat input difokuskan */
}

input[type="text"]:hover,
input[type="password"]:hover {
border-color: #66afe9; /* Warna border saat input dihover */
}

label {
display: block;
margin-bottom: 5px;
font-size: 16px;
color: #333; /* Warna teks label */
}



    </style>
   <div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 style="display: flex; align-items: center;">
                        <i class="fa fa-calculator" style="margin-right: 10px;"></i>
                        Edit |<small>   Profile</small>
                        <span style="flex-grow: 1;"></span>
                        <a href="/editpasskurikulum" class="btn btn-success">Ganti Password</a>
                    </h3>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h4>Nama Tenaga Pengajar : {{ $guru->Nama }}</h4>
                        </div>

                    </div>
                </div>
                <form method="POST" action="{{ route('editprofileKurikulum.update') }}" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <br>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username"
                                value="{{ old('username', auth()->user()->akunguru->username) }}" maxlength="50"
                                readonly>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="text">Nama Lengkap</label>
                            <input type="text" class="form-control" name="NamaLengkap" placeholder="Nama Lengkap"
                                value="{{ old('Nama', $guru->Nama) }}" maxlength="50" readonly>
                        </div>
                      

               
                        <div class="form-group col-md-6">
                            <label for="text">Tempat Lahir</label>
                            <input type="TempatLahir" class="form-control" name="TempatLahir" placeholder="Tempat Lahir"
                                    maxlength="30"
                                    value="{{ old('TempatLahir', auth()->user()->guru->TempatLahir) }}"oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');">
                        </div>
                        </div>



                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">Agama</label>
                            <select type="Agama" class="form-control form-control select-field" id="Agama"
                            name="Agama" value="{{ old('Agama', auth()->user()->guru->Agama) }}"readonly>
                            <option value="Katolik">Katolik</option>
                            <option value="Kristen Protestan">Kristen Protestan</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Konghucu">Konghucu</option>
                            <option value="Islam">Islam</option>
                        </select>
                        </div>
                

                    
                        <div class="form-group col-md-6">
                            <label for="text">Jenis Kelamin</label>
                            <select type="JenisKelamin" class="form-control form-control select-field" id="JenisKelamin"
                            name="JenisKelamin"value="{{ old('JenisKelamin', auth()->user()->guru->JenisKelamin) }}"
                            readonly>
                            <option value="L">L</option>
                            <option value="P">P</option>
                        </select>
                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">Status Pegawai</label>
                            <select type="StatusPegawai" class="form-control form-control select-field"
                            id="StatusPegawai"
                            name="StatusPegawai"value="{{ old('StatusPegawai', auth()->user()->guru->StatusPegawai) }}"
                            readonly>
                            <option value="GT">GT</option>
                            <option value="PNS YDP">PNS YDP</option>
                            <option value="GTT">GTT</option>
                            <option value="Honorer">Honorer</option>
                            <option value="PT">PT</option>
                            <option value="PTT">PTT</option>
                        </select>
                        </div>
                   
                  
                        <div class="form-group col-md-6">
                            <label for="text">NIP/ NIPS </label>
                            <input type="NipNips" class="form-control" name="NipNips"
                            placeholder="NIP/NIPS "maxlength="20"
                            value="{{ old('NipNips', auth()->user()->guru->NipNips) }}"readonly>
                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">NUPTK</label>
                            <input type="Nuptk" class="form-control" name="Nuptk"
                                    placeholder="NUPTK"maxlength="25"
                                    value="{{ old('Nuptk', auth()->user()->guru->Nuptk) }}"readonly>
                        </div>

                    <!-- Continue for other fields similarly -->

                        <div class="form-group col-md-6">
                            <label for="text">NIK</label>
                              <input type="Nik" class="form-control" name="Nik" placeholder="NIK"
                            maxlength="16"value="{{ old('Nik', auth()->user()->guru->Nik) }}"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">NPWP</label>
                            <input type="Npwp" class="form-control" name="Npwp"
                            placeholder="NPWP"maxlength="20"
                            value="{{ old('Npwp', auth()->user()->guru->Npwp) }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="text">Nomor Sertifikat Pendidik</label>
                            <input type="NomorSertifikatPendidik" class="form-control" name="NomorSertifikatPendidik"
                            maxlength="20"placeholder="Nomor Sertifikat Pendidik"
                            value="{{ old('NomorSertifikatPendidik', auth()->user()->guru->NomorSertifikatPendidik) }}"
                            readonly>

                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">Tahun Sertifikasi</label>
                            <input type="TahunSertifikasi" class="form-control" name="TahunSertifikasi"
                                    maxlength="4"
                                    placeholder="Tahun Sertifikasi"value="{{ old('TahunSertifikasi', auth()->user()->guru->TahunSertifikasi) }}"
                                    readonly>

                     
                    </div>
                    
                  
                        <div class="form-group col-md-6">
                            <label for="text">Pangkat Golongan Terakhir</label>
                            <input type="PangkatGolonganTerakhir" class="form-control"
                                    name="PangkatGolonganTerakhir"maxlength="30"
                                    placeholder="Pangkat Golongan Terakhir"value="{{ old('PangkatGolonganTerakhir', auth()->user()->guru->PangkatGolonganTerakhir) }}"
                                    readonly>
                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">Tanggal Mulai Tugas</label>
                            <input id="TMT" class="date-picker form-control" name="TMT" placeholder="TMT"
                                    type="TMT" required="required" type="TMT" onfocus="this.type='date'"
                                    onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'"
                                    onmouseout="timeFunctionLong(this)"
                                    value="{{ old('TMT', auth()->user()->guru->TMT) }}"readonly>
                                <script>
                                    function timeFunctionLong(input) {
                                        setTimeout(function() {
                                            input.type = 'TMT';
                                        }, 60000);
                                    }
                                </script>
                        </div>
                    
                   
                        <div class="form-group col-md-6">
                            <label for="text">Pendidikan Akhir</label>
                            <input type="PendidikanAkhir" class="form-control" name="PendidikanAkhir"maxlength="30"
                                    placeholder="Pendidikan Akhir"value="{{ old('PendidikanAkhir', auth()->user()->guru->PendidikanAkhir) }}">

                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">Tahun Tamat</label>
                            <input id="TahunTamat" class="date-picker form-control" name="TahunTamat"
                            placeholder="TahunTamat" type="TahunTamat" required="required" type="TahunTamat"
                            onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'"
                            onblur="this.type='text'" onmouseout="timeFunctionLong(this)"
                            value="{{ old('TahunTamat', auth()->user()->guru->TahunTamat) }}">
                        <script>
                            function timeFunctionLong(input) {
                                setTimeout(function() {
                                    input.type = 'TahunTamat';
                                }, 60000);
                            }
                        </script>

                        </div>
                   
                    
                        <div class="form-group col-md-6">
                            <label for="text">Jurusan</label>
                            <input type="Jurusan" class="form-control" name="Jurusan"
                                    maxlength="30"placeholder="Jurusan"
                                    value="{{ old('Jurusan', auth()->user()->guru->Jurusan) }}"oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');">
                     

                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">Tugas Mengajar</label>
                            <input type="TugasMengajar" class="form-control" name="TugasMengajar"
                            maxlength="30"placeholder="Tugas Mengajar"
                            value="{{ old('TugasMengajar', auth()->user()->guru->TugasMengajar) }}" readonly>
                     

                        </div>
                        <div class="form-group col-md-6">
                            <label for="text">Tugas Tambahan</label>
                            <input type="TugasTambahan" class="form-control" name="TugasTambahan"
                            maxlength="30"placeholder="Tugas Tambahan"
                            value="{{ old('TugasTambahan', auth()->user()->guru->TugasTambahan) }}" readonly>
                     

                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">Jam Per Minggu</label>
                            <input type="JamPerMinggu" class="form-control" name="JamPerMinggu"
                                    maxlength="30"placeholder="Jam Per Minggu"
                                    value="{{ old('JamPerMinggu', auth()->user()->guru->JamPerMinggu) }}" readonly>
                     

                        </div>
                        <div class="form-group col-md-6">
                            <label for="text">Tahun Pensiun</label>
                            <input id="TahunPensiun" class="date-picker form-control" name="TahunPensiun"
                                    placeholder="TahunPensiun" type="TahunPensiun" required="required"
                                    type="TahunPensiun" onfocus="this.type='date'" onmouseover="this.type='date'"
                                    onclick="this.type='date'" onblur="this.type='text'"
                                    onmouseout="timeFunctionLong(this)"
                                    value="{{ old('TahunPensiun', auth()->user()->guru->TahunPensiun) }}"readonly>
                                    <script>
                                        function timeFunctionLong(input) {
                                            setTimeout(function() {
                                                input.type = 'TahunPensiun';
                                            }, 60000);
                                        }
                                    </script>

                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">Pangkat</label>
                            <input type="text" class="form-control" name="pangkatgt"maxlength="30"
                            placeholder="Pangkat"value="{{ old('pangkatgt', auth()->user()->guru->pangkatgt) }}"
                            readonly>
                     

                        </div>
                        <div class="form-group col-md-6">
                            <label for="text">Jadwal Kenaikan Pangkat</label>
                            <input type="jadwalkenaikanpangkat" class="form-control" name="jadwalkenaikanpangkat"
                            maxlength="30"placeholder="Jadwal Kenaikan Pangkat"
                            value="{{ old('jadwalkenaikanpangkat', auth()->user()->guru->jadwalkenaikanpangkat) }}"
                            readonly>
                     

                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">Jadwal Kenaikan Gaji</label>
                            <input type="text" class="form-control" name="jadwalkenaikangaji"maxlength="30"
                            placeholder="Jadwal Kenaikan Gaji"value="{{ old('jadwalkenaikangaji', auth()->user()->guru->jadwalkenaikangaji) }}"
                            readonly>
                     

                        </div>
                        <div class="form-group col-md-6">
                            <label for="text">Jabatan</label>
                            <input type="jabatan" class="form-control" name="jabatan"
                                    maxlength="30"placeholder="Jabatan"
                                    value="{{ old('jabatan', auth()->user()->guru->jabatan) }}" readonly>
                     

                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="text">Nomor Telephone</label>
                            <input type="text" class="form-control" name="NomorTelephone"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13"
                                    placeholder="Nomor Telephone"value="{{ old('NomorTelephone', auth()->user()->guru->NomorTelephone) }}">
                                <div class="row">
                                    <h8 style="color: red;">*Diawali dengan 08xx</h8>
                                </div>
                     

                        </div>
                        <div class="form-group col-md-6">
                            <label for="text">Alamat</label>
                            <input type="text" class="form-control" name="Alamat"
                                    maxlength="50"placeholder="Alamat"
                                    value="{{ old('Alamat', auth()->user()->guru->Alamat) }}">
                     

                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="Email"maxlength="30"
                                    placeholder="Email"value="{{ old('Email', auth()->user()->guru->Email) }}" required>
                     

                        </div>
                     
                  
                        <div class="form-group col-md-6">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                @foreach ($availableRoles as $role)
                                    <option value="{{ $role }}"
                                        {{ $akunguru->hakakses == $role ? 'selected' : '' }}>
                                        {{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="foto">Upload Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">

                    </div>
                    
                  
                        <div class="form-group col-md-6">
                            @if ($guru->foto)
                            <img src="{{ asset('storage/fotoguru/' . $guru->foto) }}" alt="Foto Profil" width="200" height="300">
                        @else
                            <h2>Belum ada foto profil</h2>
                        @endif
                            <div class="row">
                                <h8 style="color: red;">*Type File Gambar JPEG, Max 1MB </h8>

                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        Update
                    </button>
                    
                    {{-- <button type="button" onclick="goBack()" class="btn btn-danger">Kembali</button> --}}
                    {{-- <button type="button" onclick="goBack()" class="btn btn-danger btn-back">Kembali</button> --}}
                    <a href="/KurikulumBeranda" class="btn btn-danger">Kembali</a>
                   
                        </div>
                       
                    
                    <br>
                    
                    {{-- <button type="submit" class="btn btn-primary">Update</button> --}}

                </form>
                <br>
            </div>
            <br>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.getElementById('submitBtn').addEventListener('click', function() {
this.querySelector('span').classList.remove('d-none');
});

    function togglePasswordField(checkbox) {
        var passwordField = document.getElementById('password');
        passwordField.disabled = !checkbox.checked;
        if (!checkbox.checked) {
            passwordField.value = '';
        }
    }

    function togglePasswordVisibility() {
        var passwordField = document.getElementById('password');
        var passwordBtn = document.getElementById('showPasswordBtn');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordBtn.innerHTML = '<i class="fa fa-eye-slash"></i>';
        } else {
            passwordField.type = 'password';
            passwordBtn.innerHTML = '<i class="fa fa-eye"></i>';
        }
    }

    function goBack() {
        window.history.back();
    }
</script>
@endsection

    {{-- <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h1><i class="fa fa-cogs" style="margin-right: 10px;"></i>Edit<small>Profile</small></h1>
            <hr>
            <form method="POST" action="{{ route('editprofile.update') }}" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
               
                       

                <table class="table">
                    <tbody>
                        <tr>
                            <td><label for="username" class="col-form-label">Username</label></td>
                            <td><input type="text" class="form-control" name="username" placeholder="username"
                                    value="{{ old('username', auth()->user()->akunguru->username) }}" maxlength="50"
                                    readonly></td>
                           
                                    <td>
                                      
                                    </td>
                                    <td>
                                      
                                    </td>
                   
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="nama">Nama Lengkap:</label></td>
                            <td>
                                <input type="text" class="form-control" name="Nama" placeholder="Nama" readonly
                                    value="{{ old('Nama', $guru->Nama) }}" maxlength="50" requiredreadonly>
                            </td>
                            <td><label class="col-form-label" for="TempatLahir">Tempat Lahir:</label></td>
                            <td>
                                <input type="TempatLahir" class="form-control" name="TempatLahir" placeholder="Tempat Lahir"
                                    maxlength="30"
                                    value="{{ old('TempatLahir', auth()->user()->guru->TempatLahir) }}"oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="nama">Agama:</label></td>
                            <td>
                                <select type="Agama" class="form-control form-control select-field" id="Agama"
                                    name="Agama" value="{{ old('Agama', auth()->user()->guru->Agama) }}"readonly>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Islam">Islam</option>
                                </select>
                            </td>
                            <td><label class="col-form-label" for="JenisKelamin">Jenis Kelamin:</label></td>
                            <td>
                                <select type="JenisKelamin" class="form-control form-control select-field" id="JenisKelamin"
                                    name="JenisKelamin"value="{{ old('JenisKelamin', auth()->user()->guru->JenisKelamin) }}"
                                    readonly>
                                    <option value="L">L</option>
                                    <option value="P">P</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="StatusPegawai">Status Pegawai:</label></td>
                            <td>
                                <select type="StatusPegawai" class="form-control form-control select-field"
                                    id="StatusPegawai"
                                    name="StatusPegawai"value="{{ old('StatusPegawai', auth()->user()->guru->StatusPegawai) }}"
                                    readonly>
                                    <option value="GT">GT</option>
                                    <option value="PNS YDP">PNS YDP</option>
                                    <option value="GTT">GTT</option>
                                    <option value="Honorer">Honorer</option>
                                    <option value="PT">PT</option>
                                    <option value="PTT">PTT</option>
                                </select>
                            </td>
                            <td><label class="col-form-label" for="NipNips">NIP / NIPS:</label></td>
                            <td>
                                <input type="NipNips" class="form-control" name="NipNips"
                                    placeholder="NIP/NIPS "maxlength="20"
                                    value="{{ old('NipNips', auth()->user()->guru->NipNips) }}"readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="NUPTK">NUPTK:</label></td>
                            <td>
                                <input type="Nuptk" class="form-control" name="Nuptk"
                                    placeholder="NUPTK"maxlength="25"
                                    value="{{ old('Nuptk', auth()->user()->guru->Nuptk) }}"readonly>
                            </td>
                            <td><label class="col-form-label" for="NIK">NIK:</label></td>
                            <td>
                                <input type="Nik" class="form-control" name="Nik" placeholder="NIK"
                                    maxlength="16"value="{{ old('Nik', auth()->user()->guru->Nik) }}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="Npwp">NPWP:</label></td>
                            <td>
                                <input type="Npwp" class="form-control" name="Npwp"
                                    placeholder="NPWP"maxlength="20"
                                    value="{{ old('Npwp', auth()->user()->guru->Npwp) }}">
                            </td>
                            <td><label class="col-form-label" for="NomorSertifikatPendidik">Nomor Sertifikat
                                    Pendidik:</label></td>
                            <td>
                                <input type="NomorSertifikatPendidik" class="form-control" name="NomorSertifikatPendidik"
                                    maxlength="20"placeholder="Nomor Sertifikat Pendidik"
                                    value="{{ old('NomorSertifikatPendidik', auth()->user()->guru->NomorSertifikatPendidik) }}"
                                    readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="TahunSertifikasi">Tahun Sertifikasi:</label></td>
                            <td>
                                <input type="TahunSertifikasi" class="form-control" name="TahunSertifikasi"
                                    maxlength="4"
                                    placeholder="Tahun Sertifikasi"value="{{ old('TahunSertifikasi', auth()->user()->guru->TahunSertifikasi) }}"
                                    readonly>
                            </td>
                            <td><label class="col-form-label" for="PangkatGolonganTerakhit">Pangkat Golongan
                                    Terakhir:</label></td>
                            <td>
                                <input type="PangkatGolonganTerakhir" class="form-control"
                                    name="PangkatGolonganTerakhir"maxlength="30"
                                    placeholder="Pangkat Golongan Terakhir"value="{{ old('PangkatGolonganTerakhir', auth()->user()->guru->PangkatGolonganTerakhir) }}"
                                    readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="TMT">Tanggal Mulai Tugas:</label></td>
                            <td>
                                <input id="TMT" class="date-picker form-control" name="TMT" placeholder="TMT"
                                    type="TMT" required="required" type="TMT" onfocus="this.type='date'"
                                    onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'"
                                    onmouseout="timeFunctionLong(this)"
                                    value="{{ old('TMT', auth()->user()->guru->TMT) }}"readonly>
                                <script>
                                    function timeFunctionLong(input) {
                                        setTimeout(function() {
                                            input.type = 'TMT';
                                        }, 60000);
                                    }
                                </script>
                            </td>
                            <td><label class="col-form-label" for="PendidikanAkhir">Pendidikan Akhir:</label></td>
                            <td>
                                <input type="PendidikanAkhir" class="form-control" name="PendidikanAkhir"maxlength="30"
                                    placeholder="Pendidikan Akhir"value="{{ old('PendidikanAkhir', auth()->user()->guru->PendidikanAkhir) }}">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="TahunTamat">Tahun Tamat:</label></td>
                            <td>
                                <input id="TahunTamat" class="date-picker form-control" name="TahunTamat"
                                    placeholder="TahunTamat" type="TahunTamat" required="required" type="TahunTamat"
                                    onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'"
                                    onblur="this.type='text'" onmouseout="timeFunctionLong(this)"
                                    value="{{ old('TahunTamat', auth()->user()->guru->TahunTamat) }}">
                                <script>
                                    function timeFunctionLong(input) {
                                        setTimeout(function() {
                                            input.type = 'TahunTamat';
                                        }, 60000);
                                    }
                                </script>
                            </td>
                            <td><label class="col-form-label" for="Jurusan">Jurusan:</label></td>
                            <td>
                                <input type="Jurusan" class="form-control" name="Jurusan"
                                    maxlength="30"placeholder="Jurusan"
                                    value="{{ old('Jurusan', auth()->user()->guru->Jurusan) }}"oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="TugasMengajar">Tugas Mengajar:</label></td>
                            <td>
                                <input type="TugasMengajar" class="form-control" name="TugasMengajar"
                                    maxlength="30"placeholder="Tugas Mengajar"
                                    value="{{ old('TugasMengajar', auth()->user()->guru->TugasMengajar) }}" readonly>
                            </td>
                            <td><label class="col-form-label" for="TugasTambahan">Tugas Tambahan:</label></td>
                            <td>
                                <input type="TugasTambahan" class="form-control" name="TugasTambahan"
                                    maxlength="30"placeholder="Tugas Tambahan"
                                    value="{{ old('TugasTambahan', auth()->user()->guru->TugasTambahan) }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="JamPerMinggu">Jam Per Minggu:</label></td>
                            <td>
                                <input type="JamPerMinggu" class="form-control" name="JamPerMinggu"
                                    maxlength="30"placeholder="Jam Per Minggu"
                                    value="{{ old('JamPerMinggu', auth()->user()->guru->JamPerMinggu) }}" readonly>
                            </td>
                            <td><label class="col-form-label" for="TahunPensiun">Tahun Pensiun:</label></td>
                            <td>
                                <input id="TahunPensiun" class="date-picker form-control" name="TahunPensiun"
                                    placeholder="TahunPensiun" type="TahunPensiun" required="required"
                                    type="TahunPensiun" onfocus="this.type='date'" onmouseover="this.type='date'"
                                    onclick="this.type='date'" onblur="this.type='text'"
                                    onmouseout="timeFunctionLong(this)"
                                    value="{{ old('TahunPensiun', auth()->user()->guru->TahunPensiun) }}"readonly>
                                <script>
                                    function timeFunctionLong(input) {
                                        setTimeout(function() {
                                            input.type = 'TahunPensiun';
                                        }, 60000);
                                    }
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="Pangkatgt">Pangkat:</label></td>
                            <td>
                                <input type="text" class="form-control" name="pangkatgt"maxlength="30"
                                    placeholder="Pangkat"value="{{ old('pangkatgt', auth()->user()->guru->pangkatgt) }}"
                                    readonly>
                            </td>
                            <td><label class="col-form-label" for="jadwalkenaikanpangkat">Jadwal Kenaikan Pangkat:</label>
                            </td>
                            <td>
                                <input type="jadwalkenaikanpangkat" class="form-control" name="jadwalkenaikanpangkat"
                                    maxlength="30"placeholder="Jadwal Kenaikan Pangkat"
                                    value="{{ old('jadwalkenaikanpangkat', auth()->user()->guru->jadwalkenaikanpangkat) }}"
                                    readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="jadwalkenaikangaji">Jadwal Kenaikan Gaji:</label></td>
                            <td>
                                <input type="text" class="form-control" name="jadwalkenaikangaji"maxlength="30"
                                    placeholder="Jadwal Kenaikan Gaji"value="{{ old('jadwalkenaikangaji', auth()->user()->guru->jadwalkenaikangaji) }}"
                                    readonly>
                            </td>
                            <td><label class="col-form-label" for="jabatan">Jabatan:</label></td>
                            <td>
                                <input type="jabatan" class="form-control" name="jabatan"
                                    maxlength="30"placeholder="Jabatan"
                                    value="{{ old('jabatan', auth()->user()->guru->jabatan) }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="NomorTelephone">Nomor Telephone:</label></td>
                            <td>
                                <input type="text" class="form-control" name="NomorTelephone"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13"
                                    placeholder="Nomor Telephone"value="{{ old('NomorTelephone', auth()->user()->guru->NomorTelephone) }}">
                                <div class="row">
                                    <h8 style="color: red;">*Diawali dengan 08xx</h8>
                                </div>
                            </td>
                            <td><label class="col-form-label" for="Alamat">Alamat:</label></td>
                            <td>
                                <input type="text" class="form-control" name="Alamat"
                                    maxlength="50"placeholder="Alamat"
                                    value="{{ old('Alamat', auth()->user()->guru->Alamat) }}">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="Email">Email:</label></td>
                            <td>
                                <input type="text" class="form-control" name="Email"maxlength="30"
                                    placeholder="Email"value="{{ old('Email', auth()->user()->guru->Email) }}" >
                            </td>
                            <td><label class="col-form-label" for="foto">Upload Foto:</label></td>
                            <td>
                                <input type="file" class="form-control" id="foto" name="foto">
                            </td>
                        </tr>
                        <tr>
                            <td><label class="col-form-label" for="hakakses">Role:</label></td>
                            <td>
                                <select name="role" id="role" class="form-control">
                                    @foreach ($availableRoles as $role)
                                        <option value="{{ $role }}"
                                            {{ $akunguru->hakakses == $role ? 'selected' : '' }}>
                                            {{ $role }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                            </td>
                            <td>
                                @if ($guru->foto)
                                <img src="{{ asset('storage/fotoguru/' . $guru->foto) }}" alt="Foto Profil" width="200" height="300">
                            @else
                                <h2>Belum ada foto profil</h2>
                            @endif
                                <div class="row">
                                    <h8 style="color: red;">*Type File Gambar JPEG, Max 2MB </h8>

                                </div>
                            </td>
                        </tr>
                      
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/editpassadmin" class="btn btn-dark">Edit Pass</a>
                <button type="button" onclick="window.location.href = '/AdminBeranda'"
                class="btn btn-danger">Kembali</button>
                <script>
                    function goBack() {
                        window.history.back();
                    }
                </script>
            </form>
        </div>
        <hr>
    </div>
@endsection --}}
