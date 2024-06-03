@extends('index')

@section('title', 'Kesuma-GO | Edit Tenaga Pengajar')

@section('content')
<style>
    .dashboard_graph {
        background-color: #f9f9f9;
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    h3 {
        color: #333;
        font-family: 'Arial', sans-serif;
        margin-bottom: 20px;
    }
/* 
    .form-group label {
        font-weight: bold;
    } */
    
                .col-form-label {
                    font-size: 18px;
                }
            
    .form-control {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 4px;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .form-control.invalid {
        border-color: red;
    }
</style>
<div class="col-md-12 col-sm-12">
    <div class="dashboard_graph">
        <div class="d-flex align-items-center justify-content-between">
            <h3>
                <i class="fa fa-male" style="margin-right: 4px; margin-top: 15px;"></i> Edit | 
                <small>Guru {{ $guru->Nama }}</small>
            </h3>
            <a href="{{ route('editpasswordguru.index', ['encodedId' => base64_encode($guru->guru_id)]) }}" class="btn btn-dark">Edit Password</a>
        </div>
        

                    
        <hr>
        <form method="POST" action="{{ route('guruall.updatee', ['encodedId' => base64_encode($guru->guru_id)]) }}" enctype="multipart/form-data" id="myForm">
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
            @method('PUT')
            <div class="form-group row">
                <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-4">
                    <input value="{{ $guru->Nama }}" type="text" class="form-control" id="Nama" name="Nama" placeholder="Nama" maxlength="50">
                </div>
                <label for="TempatLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-4">
                    <input value="{{ $guru->TempatLahir }}" type="text" class="form-control" id="TempatLahir" name="TempatLahir" placeholder="Tempat Lahir" maxlength="30" required oninput="validateInput(this)">
                </div>
            </div>
            <script>
                function validateInput(inputElement) {
                    // Hanya izinkan huruf (A-Z, a-z) dan spasi
                    inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                }
            </script>
             <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-4">
                    <input value="{{ $guru->TanggalLahir }}"type="date" class="form-control" id="TanggalLahir" name="TanggalLahir" required>
                </div>
                <label for="Agama" class="col-sm-2 col-form-label label-input">Agama</label>
                <div class="col-sm-4">
                    <select value="{{ $guru->Agama }}"class="form-control select-field" id="Agama" name="Agama" required>
                        <option value="Katolik">Katolik</option>
                        <option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Islam">Islam</option>
                    </select>
                </div>
            </div>
            
             <div class="form-group row">
                <label for="JenisKelamin" class="col-sm-2 col-form-label label-input">Jenis Kelamin</label>
                    <div class="col-sm-4">
                        <select class="form-control select-field"value="{{ $guru->JenisKelamin }}" id="JenisKelamin" name="JenisKelamin" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                   

            </div>
            <label for="StatusPegawai" class="col-sm-2 col-form-label label-input">Status Pegawai</label>
                    <div class="col-sm-4">
                        <select class="form-control select-field"value="{{ $guru->StatusPegawai }}" id="StatusPegawai" name="StatusPegawai" required>
                            
                            <option value="GT">GT</option>
                            <option value="PNS YDP">PNS YDP</option>
                            <option value="GTT">GTT</option>
                            <option value="Honorer">Honorer</option>
                            <option value="PT">PT</option>
                            <option value="PTT">PTT</option>
                        </select>
                    </div>

            </div>
             <div class="form-group row">
                <label for="NipNips" class="col-sm-2 col-form-label">NIP/NIPS</label>
                <div class="col-sm-4">
                    <input value="{{ $guru->NipNips }}"type="text" class="form-control" id="NipNips" name="NipNips"
                        placeholder="Nip atau NIPS"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
                </div>
                <label for="Nuptk" class="col-sm-2 col-form-label">NUPTK</label>
                <div class="col-sm-4">
                    <input value="{{ $guru->Nuptk }}"type="text" class="form-control" id="Nuptk" name="Nuptk"
                        placeholder="Nomor Unik Pendidik dan Ketenaga Kependidikan"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
                </div>

            </div>
             <div class="form-group row">
                <label for="Nik" class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-4">
                    <input value="{{ $guru->Nik }}"type="text" class="form-control" id="Nik" name="Nik" placeholder="NIK"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>

                    </div>
                        <label for="Npwp" class="col-sm-2 col-form-label">NPWP</label>
                        <div class="col-sm-4">
                            <input value="{{ $guru->Npwp }}"type="text" class="form-control" id="Npwp" name="Npwp" placeholder="NPWP"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
    
            </div>
            </div>
             <div class="form-group row">
                <label for="NomorSertifikatPendidik" class="col-sm-2 col-form-label">Nomor Sertifikat
                    Pendidik</label>
                <div class="col-sm-4">
                    <input value="{{ $guru->NomorSertifikatPendidik }}"type="text" class="form-control" id="NomorSertifikatPendidik"
                        name="NomorSertifikatPendidik" placeholder="Nomor Sertifikat Pendidik"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="20" required>
                </div>
                <label for="TahunSertifikasi" class="col-sm-2 col-form-label">Tahun Sertifikasi</label>
                <div class="col-sm-4">
                    <input value="{{ $guru->TahunSertifikasi }}"type="date" class="form-control" id="TahunSertifikasi" name="TahunSertifikasi"
                        placeholder="Tahun Sertifikasi" required>

            </div>
            </div>
             <div class="form-group row">
                <label for="pangkatgt" class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-4">
                        <input value="{{ $guru->pangkatgt }}"type="text" class="form-control" id="pangkatgt" name="pangkatgt"
                            placeholder="Pangkat"required>

                    </div>
                    <label for="jadwalkenaikanpangkat" class="col-sm-2 col-form-label">Jadwal Kenaikan Pangkat</label>
                    <div class="col-sm-4">
                        <input value="{{ $guru->jadwalkenaikanpangkat }}" type="date" class="form-control" id="jadwalkenaikanpangkat"
                            name="jadwalkenaikanpangkat" placeholder="Jadwal Kenaikan Pangkat"required>
                    </div>

            </div>
             <div class="form-group row">
                <label for="jadwalkenaikangaji" class="col-sm-2 col-form-label">Jadwal Kenaikan Gaji</label>
                <div class="col-sm-4">
                    <input value="{{ $guru->jadwalkenaikangaji }}"type="date" class="form-control" id="jadwalkenaikangaji" name="jadwalkenaikangaji"
                        placeholder="Jadwal Kenaikan Gaji"required>

                </div>
                <label for="PangkatGolonganTerakhir" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-4">
                    {{-- <input type="PangkatGolonganTerakhir" class="form-control" id="PangkatGolonganTerakhir"
                        name="PangkatGolonganTerakhir" placeholder="Pangkat Golongan Terakhir"maxlength="30"
                        disabled> --}}
                </div>

            </div>
             <div class="form-group row">
                <label for="TMT" class="col-sm-2 col-form-label">TMT</label>
                <div class="col-sm-4">
                    <input value="{{ $guru->TMT }}"type="date" class="form-control" id="TMT" name="TMT"
                        placeholder="Tanggal Mulai Tugas">

                </div>
                <label for="PendidikanAkhir" class="col-sm-2 col-form-label">Pendidikan Akhir</label>
                <div class="col-sm-4">
                    <input value="{{ $guru->PendidikanAkhir }}"type="PendidikanAkhir" class="form-control" id="PendidikanAkhir"
                        name="PendidikanAkhir" placeholder="Pendidikan Akhir"maxlength="5" required>

                </div>

            </div>
             <div class="form-group row">
                <label for="TahunTamat" class="col-sm-2 col-form-label">Tahun Tamat</label>
                <div class="col-sm-4">
                    <input type="date" value="{{ $guru->TahunTamat }}"class="form-control" id="TahunTamat" name="TahunTamat"
                        placeholder="Tahun Tamat"required>

                </div>
                <label for="Jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-4">
                    <input type="Jurusan" value="{{ $guru->Jurusan }}"class="form-control" id="Jurusan" name="Jurusan"
                        placeholder="Jurusan"maxlength="50" required>

                </div>

            </div>
             <div class="form-group row">
                <label for="TugasMengajar" class="col-sm-2 col-form-label">Tugas Mengajar</label>
                <div class="col-sm-4">
                    <input type="TugasMengajar" value="{{ $guru->TugasMengajar }}"class="form-control" id="TugasMengajar" name="TugasMengajar"
                        placeholder="Tugas Mengajar"maxlength="50" required>

                </div>
                <label for="TugasTambahan" class="col-sm-2 col-form-label">Tugas Tambahan</label>
                <div class="col-sm-4">
                    <input type="TugasTambahan" value="{{ $guru->TugasTambahan }}"class="form-control" id="TugasTambahan" name="TugasTambahan"
                        placeholder="Tugas Tambahan"maxlength="50" required>

                </div>

            </div>
             <div class="form-group row">
                <label for="JamPerMinggu" class="col-sm-2 col-form-label">Jam Per Minggu</label>
                <div class="col-sm-4">
                    <input type="JamPerMinggu" value="{{ $guru->JamPerMinggu }}"class="form-control" id="JamPerMinggu" name="JamPerMinggu"
                        placeholder="Jam Per Minggu"maxlength="30" required>

                </div>
                <label for="TahunPensiun" class="col-sm-2 col-form-label">Tahun Pensiun</label>
                <div class="col-sm-4">
                    <input type="date" value="{{ $guru->TahunPensiun }}"class="form-control" id="TahunPensiun" name="TahunPensiun"
                        placeholder="Tahun Pensiun"required>

                </div>

            </div>
             <div class="form-group row">
                <label for="NomorTelephone" class="col-sm-2 col-form-label">Nomor Telephone</label>
                    <div class="col-sm-4">
                        <input value="{{ $guru->NomorTelephone }}"type="text" class="form-control" id="NomorTelephone" name="NomorTelephone"
                            placeholder="Nomor Telephone"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>
                    </div>
                    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-4">
                        <input value="{{ $guru->Alamat }}"type="Alamat" class="form-control" id="Alamat" name="Alamat"
                            placeholder="Alamat"maxlength="40" required>

                    </div>

            </div>

             <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label label-input">Status Aktif</label>
                <div class="col-sm-4">
                    <select class="form-control select-field"value="{{ $guru->status }}" id="status" name="status" required>
                        
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                        
                    </select>
                </div>
                <label for="username"class="col-sm-2 col-form-label label-input">Username</label>
                 <div class="col-sm-4">
                    <input type="text" class="form-control" name="username" placeholder="username"
                                    value="{{ $guru->listakun->username }}" maxlength="13" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="foto" class="col-sm-2 col-form-label">Upload Foto</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <label for="foto" class="col-sm-2 col-form-label">Preview Foto</label>
                <div class="col-sm-4">
                
                    @if($guru->foto)
                        <img src="{{ asset('storage/fotoguru/' . $guru->foto) }}" alt="Foto Profil" width="200" height="300" class="img-thumbnail">
                    @else
                        <p>Foto belum diunggah.</p>
                    @endif
               
                </div>
            </div>
            
         
            <hr>
           
            <div class="form-group row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" onclick="window.location.href = '/guruall'"
                    class="btn btn-danger">Kembali</button>
                </div>
            </div>
            
        </form>
    </div>
    <br>
    <br>
</div>

                <script>
                    const passwordInput = document.getElementById('password');
                    const updatePasswordCheckbox = document.getElementById('updatePasswordCheckbox');
                    updatePasswordCheckbox.addEventListener('change', function() {
                        if (updatePasswordCheckbox.checked) {
                            passwordInput.removeAttribute('disabled');
                        } else {
                            passwordInput.setAttribute('disabled', 'disabled');
                            passwordInput.value = '';
                        }
                    });

                    const form = document.querySelector('form');
                    form.addEventListener('submit', function(event) {
                        if (!updatePasswordCheckbox.checked) {
                            event.preventDefault(); // Mencegah pengiriman formulir
                            passwordInput.removeAttribute('name');
                        }
                    });
                </script>
<script>
    $(document).ready(function() {
        $('#showPasswordBtn').on('click', function() {
            var passwordInput = $('#password');
            var passwordIcon = $(this).find('i');
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>

<script>
    const fotoInput = document.getElementById('foto-input');
    const fotoLabel = document.getElementById('foto-label');

    fotoLabel.addEventListener('click', function() {
        fotoInput.click();
    });

    fotoInput.addEventListener('change', function() {
        if (fotoInput.files.length > 0) {
            const file = fotoInput.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                fotoLabel.innerHTML =
                    `<img src="${e.target.result}" alt="Foto Biodata" style="max-width: 200px; max-height: 200px;">`;
            };
            reader.readAsDataURL(file);
        } else {
            fotoLabel.innerHTML = 'Choose File';
        }
    });
</script>
@endsection