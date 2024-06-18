@extends('index')

@section('title', 'Kesuma-GO | Edit Siswa')

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
                <small>Siswa {{ $siswa->NamaLengkap }}</small>

            </h3>
            <a href="{{ route('editpassword.index', ['encodedId' => base64_encode($siswa->siswa_id)]) }}" class="btn btn-dark">Edit Password</a>

        </div>
        

                    
        <hr>
        <form method="POST" action="{{ route('siswaall.updatee', ['encodedId' => base64_encode($siswa->siswa_id)]) }}" enctype="multipart/form-data" id="myForm">

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
                <label  class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="NamaLengkap" name="NamaLengkap"
                    value="{{ $siswa->NamaLengkap }}" placeholder="Nama Lengkap" maxlength="50" required
                    oninput="validateInput(this)"required>
                    <script>
                        function validateInput(inputElement) {
                            // Hanya izinkan huruf (A-Z, a-z) dan spasi
                            inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                        }
                    </script>

                </div>
            </div>
          
             <div class="form-group row">
                <label for="NomorInduk" class="col-sm-2 col-form-label">Nomor Induk</label>

                <div class="col-sm-4">
                    <input type="text" class="form-control" id="NomorInduk"value="{{ $siswa->NomorInduk }}" name="NomorInduk"
                    placeholder="Nomor Induk" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                    maxlength="16"required>

                </div>
                <label for="Nama_Panggilan" class="col-sm-2 col-form-label">Nama Panggilan</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="NamaPanggilan" name="NamaPanggilan"
                    value="{{ $siswa->NamaPanggilan }}" placeholder="Nama Panggilan" maxlength="20" required
                    oninput="validateInput(this)"required>
                <script>
                    function validateInput(inputElement) {
                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                    }
                </script>

                </div>
            </div>
            
             <div class="form-group row">
                <label for="JenisKelamin" class="col-sm-2 col-form-label label-input">Jenis Kelamin</label>

                    <div class="col-sm-4">
                        <select class="form-control form-control select-field" id="JenisKelamin" name="JenisKelamin"
                        required>
                        <option value="Laki-Laki" {{ $siswa->JenisKelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="Perempuan" {{ $siswa->JenisKelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        
                    </select>


            </div>
            <label for="NISN" class="col-sm-2 col-form-label">NISN</label>

                    <div class="col-sm-4">
                        <input value="{{ $siswa->NISN }}" type="text" class="form-control" id="NISN"
                        name="NISN" placeholder="NISN"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>

                    </div>

            </div>
             <div class="form-group row">
                <label for="TempatLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>

                <div class="col-sm-4">
                    <input type="text" class="form-control" id="TempatLahir" name="TempatLahir"
                    value="{{ $siswa->TempatLahir }}"placeholder="Tempat Lahir" maxlength="16" required
                    oninput="validateInput(this)"required>
                    <script>
                        function validateInput(inputElement) {
                            // Hanya izinkan huruf (A-Z, a-z) dan spasi
                            inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                        }
                    </script>

                </div>
                <label for="TanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>

                <div class="col-sm-4">
                    <input type="date" class="form-control" id="TanggalLahir" name="TanggalLahir"
                    value="{{ $siswa->TanggalLahir }}"placeholder="Tanggal Lahir" required>

                </div>

            </div>
             <div class="form-group row">
                <label for="Agama" class="col-sm-2 col-form-label label-input">Agama</label>

                <div class="col-sm-4">
                    <select class="form-control select-field" id="Agama" name="Agama"
                    required>
                    <option value="Katolik" {{ $siswa->Agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Kristen Protestan" {{ $siswa->Agama == 'Kristen Protestan' ? 'selected' : '' }}>
                        Kristen Protestan</option>
                    <option value="Hindu" {{ $siswa->Agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ $siswa->Agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ $siswa->Agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    <option value="Islam" {{ $siswa->Agama == 'Islam' ? 'selected' : '' }}>Islam</option>
         
                   
                </select>


                    </div>
                    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>

                        <div class="col-sm-4">
                            <input type="Alamat" class="form-control" id="Alamat" name="Alamat"
                            value="{{ $siswa->Alamat }}" placeholder="Alamat" maxlength="50" required>

    
            </div>
            </div>
             <div class="form-group row">
                <label for="RT" class="col-sm-2 col-form-label">RT</label>

                <div class="col-sm-4">
                    <input type="text" class="form-control" id="RT" name="RT"
                    placeholder="RT" value="{{ $siswa->RT }}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required>

                </div>
                <label for="RW" class="col-sm-2 col-form-label">RW</label>
                    
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="RW" name="RW"
                    placeholder="RW"
                    value="{{ $siswa->RW }}"oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                    maxlength="3" required>
            </div>
            </div>
             <div class="form-group row">
                <label for="Kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>

                    <div class="col-sm-4">
                        <input value="{{ $siswa->Kelurahan }}"type="text" class="form-control" id="Kelurahan"
                                    name="Kelurahan" placeholder="Kelurahan" maxlength="20"
                                    oninput="validateInput(this)" required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>


                    </div>
                    <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>

                    <div class="col-sm-4">
                        <input type="text" value="{{ $siswa->Kecamatan }}"class="form-control" id="Kecamatan"
                        name="Kecamatan" placeholder="Kecamatan" maxlength="20"
                        oninput="validateInput(this)" required>
                    <script>
                        function validateInput(inputElement) {
                            // Hanya izinkan huruf (A-Z, a-z) dan spasi
                            inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                        }
                    </script>


            </div>
            </div>
             <div class="form-group row">
                <label for="KabKota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>


                <div class="col-sm-4">
                    <input type="text" value="{{ $siswa->KabKota }}"class="form-control" id="KabKota"
                    name="KabKota" placeholder="KabKota" maxlength="20" oninput="validateInput(this)"
                    required>

                <script>
                    function validateInput(inputElement) {
                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                    }
                </script>
                </div>
                <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi</label>

                <div class="col-sm-4">
                    <input type="text" class="form-control" value="{{ $siswa->Provinsi }}"id="Provinsi"
                    name="Provinsi" placeholder="Provinsi" maxlength="20"
                    oninput="validateInput(this)"required>
                <script>
                    function validateInput(inputElement) {
                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                    }
                </script>

                </div>

            </div>
             <div class="form-group row">
                <label for="KodePos" class="col-sm-2 col-form-label">Kode Pos</label>

                <div class="col-sm-4">
                    <input type="text" class="form-control" id="KodePos" name="KodePos"
                                    value="{{ $siswa->KodePos }}"placeholder="Kode Pos"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="6" required>


                </div>
                <label for="Email" class="col-sm-2 col-form-label">Email</label>


                <div class="col-sm-4">
                    <input type="Email" value="{{ $siswa->Email }}"class="form-control" id="Email"
                    name="Email" placeholder="Email"maxlength="40" required>


                </div>

            </div>
             <div class="form-group row">
                <label for="NomorTelephone" class="col-sm-2 col-form-label">Nomor Telepon</label>

                <div class="col-sm-4">
                    <input value="{{ $siswa->NomorTelephone }}"type="text" class="form-control"
                    id="NomorTelephone" name="NomorTelephone" placeholder="Nomor Telephone"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>
                </div>
                <label for="Kewarganegaraan" class="col-sm-2 col-form-label">Kewarganegaraan</label>

                <div class="col-sm-4">
                    <input value="{{ $siswa->Kewarganegaraan }}"type="text" class="form-control"
                                    id="Kewarganegaraan" name="Kewarganegaraan" placeholder="Kewarganegaraan"
                                    maxlength="23" required oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>


                </div>

            </div>
             <div class="form-group row">
                <label for="NIK" class="col-sm-2 col-form-label">NIK</label>

                <div class="col-sm-4">
                    <input value="{{ $siswa->NIK }}"type="text" class="form-control" id="NIK"
                    name="NIK" placeholder="NIK"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
                </div>
                <label for="GolDarah" class="col-sm-2 col-form-label">Golongan Darah</label>

                <div class="col-sm-4">
                    <input value="{{ $siswa->GolDarah }}"type="text" class="form-control" id="GolDarah"
                    name="GolDarah" placeholder="Golonga Darah" maxlength="1" required
                    oninput="validateInput(this)"required>
                <script>
                    function validateInput(inputElement) {
                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                    }
                </script>


                </div>

            </div>
             <div class="form-group row">
                <label for="TinggalDengan" class="col-sm-2 col-form-label">Tinggal Dengan</label>

                <div class="col-sm-4">
                    <input value="{{ $siswa->TinggalDengan }}"type="text" class="form-control"
                    id="TinggalDengan" name="TinggalDengan" placeholder="Tinggal Dengan" maxlength="20"
                    required oninput="validateInput(this)"required>
                <script>
                    function validateInput(inputElement) {
                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                    }
                </script>


                </div>
                <label for="StatusSiswa" class="col-sm-2 col-form-label">Status Siswa</label>
                <div class="col-sm-4">
                    <select value="{{ $siswa->StatusSiswa }}" class="form-control form-control select-field"
                        id="StatusSiswa" name="StatusSiswa">

                        <option value="Lengkap">Lengkap</option>
                        <option value="Yatim">Yatim</option>
                        <option value="Piatu">Piatu</option>
                        <option value="YatimPiatu">YatimPiatu</option>
                    </select>

                </div>

            </div>
             <div class="form-group row">
                <label for="AnakKe" class="col-sm-2 col-form-label">Anak Ke</label>

                    <div class="col-sm-4">
                        <input value="{{ $siswa->AnakKe }}"type="text" class="form-control" id="AnakKe"
                        name="AnakKe" placeholder="Anak Ke"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="1" required>
                    </div>
                    <label for="SaudaraKandung" class="col-sm-2 col-form-label">Jumlah Saudara
                        Kandung</label>

                    <div class="col-sm-4">
                        <input value="{{ $siswa->SaudaraKandung }}" type="text" class="form-control"
                        id="SaudaraKandung" name="SaudaraKandung" placeholder="Saudara Kandung"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="1" required>

                    </div>

            </div>

             <div class="form-group row">
                <label for="SaudaraTiri" class="col-sm-2 col-form-label">Jumlah Saudara Tiri</label>

                <div class="col-sm-4">
                    <input type="text" class="form-control" id="SaudaraTiri" name="SaudaraTiri"
                    value="{{ $siswa->SaudaraTiri }}" placeholder="Saudara Tiri"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="1" required>
                </div>
                <label for="Tinggicm" class="col-sm-2 col-form-label">Tinggi cm</label>

                 <div class="col-sm-4">
                    <input type="text" class="form-control" id="Tinggicm" name="Tinggicm"
                    value="{{ $siswa->Tinggicm }}"placeholder="Tinggi CM"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="Beratkg" class="col-sm-2 col-form-label">Berat kg</label>
                <div class="col-sm-4">
                    <input value="{{ $siswa->Beratkg }}"type="text" class="form-control" id="Beratkg"
                    name="Beratkg" placeholder="Berat KG"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required>
                </div>
                <label for="RiwayatPenyakit" class="col-sm-2 col-form-label">Riwayat Penyakit</label>

                <div class="col-sm-4">
                    <input value="{{ $siswa->RiwayatPenyakit }}"type="RiwayatPenyakit" class="form-control"
                    id="RiwayatPenyakit" name="RiwayatPenyakit" placeholder="Riwayat Penyakit">

                    </div>
                    </div>
            <div class="form-group row">
                <label for="AsalSMP" class="col-sm-2 col-form-label">Asal SMP</label>


                <div class="col-sm-4">
                    <input value="{{ $siswa->RiwayatPenyakit }}" type="text" class="form-control"
                    id="AsalSMP" name="AsalSMP" placeholder="Asal SMP" maxlength="30"
                    required>
                </div>
                <label for="AlamatSMP" class="col-sm-2 col-form-label">Alamat SMP</label>

                <div class="col-sm-4">
                    <input value="{{ $siswa->AlamatSMP }}" type="AlamatSMP" class="form-control"
                    id="AlamatSMP" name="AlamatSMP" placeholder="Alamat SMP"maxlength="30" required>
                    </div>
                    </div>
            <div class="form-group row">
                <label for="NPSNSMP" class="col-sm-2 col-form-label">NPSN SMP</label>

                <div class="col-sm-4">
                    <input value="{{ $siswa->NPSNSMP }}" type="NPSNSMP" class="form-control" id="NPSNSMP"
                    name="NPSNSMP" placeholder="Nomor Pokok Sekolah Nasional"maxlength="16">

                </div>
                <label for="KabKotaSMP" class="col-sm-2 col-form-label">Kabupaten/Kota SMP</label>
                <div class="col-sm-4">
                    <input type="KabKotaSMP" value="{{ $siswa->KabKotaSMP }}"class="form-control"
                    id="KabKotaSMP" name="KabKotaSMP" placeholder="Kabupaten/Kota SMP"maxlength="16">

                    </div>
                    </div>
            <div class="form-group row">
                <label for="ProvinsiSMP" class="col-sm-2 col-form-label">Provinsi SMP</label>

                <div class="col-sm-4">
                    <input type="ProvinsiSMP" class="form-control" id="ProvinsiSMP" name="ProvinsiSMP"
                    placeholder="Provinsi SMP"maxlength="16" value="{{ $siswa->ProvinsiSMP }}">

                </div>
                <label for="NoIjasah" class="col-sm-2 col-form-label">Nomor Ijasah SMP</label>


                <div class="col-sm-4">
                    <input type="text" class="form-control" id="NoIjasah" name="NoIjasah"
                    placeholder="Nomor Ijasah SMP"value="{{ $siswa->NoIjasah }}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>


                    </div>
                    </div>
            <div class="form-group row">
                <label for="NoSKHUN" class="col-sm-2 col-form-label">Nomor SKHUN SMP</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="NoSKHUN" name="NoSKHUN"
                    placeholder="NoSKHUN"value="{{ $siswa->NoSKHUN }}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>

                </div>

                <label for="DiterimaTanggal" class="col-sm-2 col-form-label">Diterima Tanggal</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control"
                    value="{{ $siswa->DiterimaTanggal }}"id="DiterimaTanggal" name="DiterimaTanggal"
                    placeholder="Diterima Tanggal"required>

                    </div>
                    </div>
            <div class="form-group row">
                <label for="DiterimaDiKelas" class="col-sm-2 col-form-label label-input">Diterima di Kelas</label>

                <div class="col-sm-4">
                    <select class="form-control form-control select-field" id="DiterimaDiKelas"
                    name="DiterimaDiKelas"required >
                    <option value="10" {{ $siswa->DiterimaDiKelas == '10' ? 'selected' : '' }}>10</option>
                    <option value="11" {{ $siswa->DiterimaDiKelas == '11' ? 'selected' : '' }}>11</option>
                    <option value="12" {{ $siswa->DiterimaDiKelas == '12' ? 'selected' : '' }}>12</option>
                    
                 

                </select>

                </div>
                <label for="DiterimaSemester" class="col-sm-2 col-form-label">Diterima di Semester</label>

                <div class="col-sm-4">
                    <select class="form-control form-control select-field" id="DiterimaSemester"
                    name="DiterimaSemester"  required>
                    <option value="Ganjil" {{ $siswa->DiterimaSemester == 'Ganjil' ? 'selected' : '' }}>11</option>
                    <option value="Genap" {{ $siswa->DiterimaSemester == 'Genap' ? 'selected' : '' }}>11</option>
                 
                </select>
                    </div>
                    </div>
            <div class="form-group row">
                <label for="MutasiAsalSMA" class="col-sm-2 col-form-label">Mutasi Asal SMA</label>


                <div class="col-sm-4">
                    <input type="MutasiAsalSMA" class="form-control" id="MutasiAsalSMA"
                    name="MutasiAsalSMA" value="{{ $siswa->MutasiAsalSMA }}"
                    placeholder="Mutasi Asal SMA" maxlength="20">

                </div>
                <label for="AlasanPindah" class="col-sm-2 col-form-label">Alasan Pindah</label>


                <div class="col-sm-4">
                    <input type="AlasanPindah" value="{{ $siswa->AlasanPindah }}" class="form-control"
                    id="AlasanPindah" name="AlasanPindah" placeholder="Alasan Pindah"maxlength="20">

                    </div>
                    </div>
            <div class="form-group row">
                <label for="NoPesertaUNSMP" class="col-sm-2 col-form-label">Nomor Peserta UN SMP</label>

                <div class="col-sm-4">
                    <input type="text" value="{{ $siswa->NoPesertaUNSMP }}" class="form-control"
                    id="NoPesertaUNSMP" name="NoPesertaUNSMP" placeholder="No Peserta UN SMP"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16">

                </div>
                <label for="TglIjasah" class="col-sm-2 col-form-label">Tanggal Ijasah</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" value="{{ $siswa->TglIjasah }}"
                    id="TglIjasah" name="TglIjasah" placeholder="Tanggal Ijasah" required>

                    </div>
                    </div>
            <div class="form-group row">
                <label for="NamaOrangTuaPadaIjasah" class="col-sm-2 col-form-label">Nama Orang Tua pada
                    Ijasah</label>

                <div class="col-sm-4">
                    <input type="text" value="{{ $siswa->NamaOrangTuaPadaIjasah }}"class="form-control"
                    id="NamaOrangTuaPadaIjasah" name="NamaOrangTuaPadaIjasah"
                    placeholder="Nama Ortu Pada Ijazah" maxlength="30" required
                    oninput="validateInput(this)"required>
                    <script>
                        function validateInput(inputElement) {
                            // Hanya izinkan huruf (A-Z, a-z) dan spasi
                            inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                        }
                    </script>

                </div>
                <label for="NamaAyah" class="col-sm-2 col-form-label">Nama Ayah</label>

                <div class="col-sm-4">
                    <input type="NamaAyah" class="form-control" id="NamaAyah"
                    value="{{ $siswa->NamaAyah }}"name="NamaAyah" placeholder="Nama Ayah"maxlength="30"
                    required>

                    </div>
                    </div>
            <div class="form-group row">
                <label for="Tahun_Lahir_Ayah" class="col-sm-2 col-form-label">Tahun Lahir Ayah</label>

                <div class="col-sm-4">
                    <input type="text" class="form-control" id="TahunLahirAyah"
                    value="{{ $siswa->TahunLahirAyah }}"name="TahunLahirAyah"
                    placeholder="Tahun Lahir Ayah"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="4" required>

                </div>
                <label for="AlamatAyah" class="col-sm-2 col-form-label">Alamat Ayah</label>

                <div class="col-sm-4">
                    <input type="AlamatAyah" value="{{ $siswa->AlamatAyah }}" class="form-control"
                    id="AlamatAyah" name="AlamatAyah" placeholder="Alamat Ayah" maxlength="30">

                    </div>
                    </div>
            <div class="form-group row">
                <label for="NomorTelephoneAyah" class="col-sm-2 col-form-label">Nomor Telepon Ayah</label>

                <div class="col-sm-4">
                    <input type="text" class="form-control" value="{{ $siswa->NomorTelephoneAyah }}"
                    id="NomorTelephoneAyah" name="NomorTelephoneAyah" placeholder="NomorTelephoneAyah"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>

                </div>
                <label for="AgamaAyah" class="col-sm-2 col-form-label">Agama Ayah</label>


                <div class="col-sm-4">
                    <input type="AgamaAyah" class="form-control" id="AgamaAyah"
                    value="{{ $siswa->AgamaAyah }}" name="AgamaAyah" placeholder="Agama Ayah"
                    maxlength="10">

                    </div>
                    </div>
            <div class="form-group row">
                <label for="PendidikanTerakhirAyah" class="col-sm-2 col-form-label">Pendidikan Terakhir
                    Ayah</label>
                <div class="col-sm-4">
                    <input type="PendidikanTerakhirAyah" class="form-control" id="PendidikanTerakhirAyah"
                    name="PendidikanTerakhirAyah" placeholder="Pendidikan Terakhir Ayah"
                    maxlength="10"value="{{ $siswa->PendidikanTerakhirAyah }}">
                </div>
                <label for="Pekerjaan_Ayah" class="col-sm-2 col-form-label">Pekerjaan Ayah</label>
                <div class="col-sm-4">
                    <input type="PekerjaanAyah" class="form-control"
                    id="PekerjaanAyah"value="{{ $siswa->PekerjaanAyah }}" name="PekerjaanAyah"
                    placeholder="Pekerjaan Ayah" maxlength="10"required>

                </div>
            </div>
              
            <div class="form-group row">
                <label for="PenghasilanAyah" class="col-sm-2 col-form-label">Penghasilan Ayah</label>

                <div class="col-sm-4">
                    <input type="PenghasilanAyah" class="form-control"
                    id="PenghasilanAyah"value="{{ $siswa->PenghasilanAyah }}" name="PenghasilanAyah"
                    placeholder="Penghasilan Ayah" maxlength="30" required>


                </div>
                <label for="NamaIbu" class="col-sm-2 col-form-label">Nama Ibu</label>

                <div class="col-sm-4">
                    <input type="NamaIbu" class="form-control" value="{{ $siswa->NamaIbu }}"id="NamaIbu"
                    name="NamaIbu" placeholder="Nama Ibu" maxlength="30" required>

                    </div>
                    </div>
            <div class="form-group row">
                <label for="TahunLahirIbu" class="col-sm-2 col-form-label">Tahun Lahir Ibu</label>


                <div class="col-sm-4">
                    <input type="text" class="form-control" id="TahunLahirIbu"
                    value="{{ $siswa->TahunLahirIbu }}"name="TahunLahirIbu" placeholder="Tahun Lahir Ibu"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="4" required>

                </div>
                <label for="AlamatIbu" class="col-sm-2 col-form-label">Alamat Ibu</label>


                <div class="col-sm-4">
                    <input type="AlamatIbu" class="form-control"
                    value="{{ $siswa->AlamatIbu }}"id="AlamatIbu" name="AlamatIbu"
                    placeholder="Alamat Ibu"maxlength="30">
                    </div>
                    </div>
            <div class="form-group row">
                <label for="NomorTelephoneIbu" class="col-sm-2 col-form-label">Nomor Telepon Ibu</label>

                <div class="col-sm-4">
                    <input type="text" class="form-control" id="NomorTelephoneIbu"
                    value="{{ $siswa->NomorTelephoneIbu }}"name="NomorTelephoneIbu"
                    placeholder="Nomor Telephone Ibu"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>

                </div>
                <label for="AgamaIbu" class="col-sm-2 col-form-label">Agama Ibu</label>

                <div class="col-sm-4">
                    <input type="AgamaIbu" class="form-control" id="AgamaIbu"
                    name="AgamaIbu"value="{{ $siswa->AgamaIbu }}" placeholder="Agama Ibu"maxlength="10"
                    required>

                    </div>
                    </div>
            <div class="form-group row">
                <label for="PendidikanTerakhirIbu" class="col-sm-2 col-form-label">Pendidikan Terakhir></label>

                <div class="col-sm-4">
                    <input type="PendidikanTerakhirIbu" class="form-control"
                    value="{{ $siswa->PendidikanTerakhirIbu }}"id="PendidikanTerakhirIbu"
                    name="PendidikanTerakhirIbu" placeholder="Pendidikan Terakhir Ibu"maxlength="20">

                </div>
                <label for="PekerjaanIbu" class="col-sm-2 col-form-label">Pekerjaan Ibu</label>

                <div class="col-sm-4">
                    <input type="PekerjaanIbu" value="{{ $siswa->PekerjaanIbu }}"class="form-control"
                    id="PekerjaanIbu" name="PekerjaanIbu" placeholder="Pekerjaan Ibu"maxlength="20"
                    required>

                    </div>
                    </div>
            <div class="form-group row">
                <label for="PenghasilanIbu" class="col-sm-2 col-form-label">Penghasilan Ibu</label>

                <div class="col-sm-4">
                    <input type="PenghasilanIbu" class="form-control"
                    value="{{ $siswa->PenghasilanIbu }}"id="PenghasilanIbu" name="PenghasilanIbu"
                    placeholder="Penghasilan Ibu"maxlength="30" required>
                </div>
                <label for="NamaWali" class="col-sm-2 col-form-label">Nama Wali</label>


                <div class="col-sm-4">
                    <input type="NamaWali" class="form-control" id="NamaWali"
                    value="{{ $siswa->NamaWali }}"name="NamaWali"
                    placeholder="Nama Wali"maxlength="30">

                    </div>
                    </div>
            <div class="form-group row">
                <label for="TahunLahirWali" class="col-sm-2 col-form-label">Tahun Lahir Wali</label></td>

                <div class="col-sm-4">
                    <input type="TahunLahirWali" class="form-control" id="TahunLahirWali"
                    value="{{ $siswa->TahunLahirWali }}"name="TahunLahirWali"
                    placeholder="Tahun Lahir Wali"maxlength="4">
                </div>
                <label for="AlamatWali" class="col-sm-2 col-form-label">Alamat Wali</label>

                <div class="col-sm-4">
                    <input type="AlamatWali" class="form-control"
                    id="AlamatWali"value="{{ $siswa->AlamatWali }}" name="AlamatWali"
                    placeholder="Alamat Wali"maxlength="30">

                    </div>
                    </div>
            <div class="form-group row">
                <label for="NomorTelephoneWali" class="col-sm-2 col-form-label">Nomor Telepon
                    Wali</label>

                <div class="col-sm-4">
                    <input type="text" class="form-control" id="NomorTelephoneWali"
                    name="NomorTelephoneWali" placeholder="Nomor Telfon"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13"
                    value="{{ $siswa->NomorTelephoneWali }}">

                </div>
                <label for="AgamaWali" class="col-sm-2 col-form-label">Agama Wali</label>

                <div class="col-sm-4">
                    <input type="AgamaWali" class="form-control" id="AgamaWali"
                    value="{{ $siswa->AgamaWali }}"name="AgamaWali"
                    placeholder="Agama Wali"maxlength="10">

                    </div>
                    </div>
            <div class="form-group row">
                <label for="PendidikanTerakhirWali" class="col-sm-2 col-form-label">Pendidikan
                    Terakhir
                    Wali</label>

                <div class="col-sm-4">
                    <input type="PendidikanTerakhirWali" class="form-control"
                    value="{{ $siswa->PendidikanTerakhirWali }}"id="PendidikanTerakhirWali"
                    name="PendidikanTerakhirWali"
                    placeholder="Pendidikan Terakhir Wali"maxlength="12">

                </div>
                <label for="PekerjaanWali" class="col-sm-2 col-form-label">Pekerjaan Wali</label>

                <div class="col-sm-4">
                    <input type="PekerjaanWali" class="form-control"
                    value="{{ $siswa->PekerjaanWali }}"id="PekerjaanWali" name="PekerjaanWali"
                    placeholder="Pekerjaan Wali"maxlength="20">

                    </div>
                    </div>
            <div class="form-group row">
                <label for="WaliPenghasilan" class="col-sm-2 col-form-label">Penghasilan Wali</label>

                <div class="col-sm-4">
                    <input type="WaliPenghasilan" class="form-control" id="WaliPenghasilan"
                    value="{{ $siswa->WaliPenghasilan }}"name="WaliPenghasilan"
                    placeholder="Penghasilan Wali"maxlength="30">

                </div>
                <label for="StatusHubunganWali" class="col-sm-2 col-form-label">Status Hubungan
                    Wali</label>

                <div class="col-sm-4">
                    <input type="StatusHubunganWali" class="form-control"
                    id="StatusHubunganWali"value="{{ $siswa->StatusHubunganWali }}"
                    name="StatusHubunganWali" placeholder="Status Hubungan Wali"maxlength="12">


                    </div>
                    </div>
            <div class="form-group row">
                <label for="MenerimaBeasiswaDari" class="col-sm-2 col-form-label">Menerima Beasiswa
                    Dari</label>

                <div class="col-sm-4">
                    <input type="MenerimaBeasiswaDari" class="form-control"
                    id="MenerimaBeasiswaDari"value="{{ $siswa->MenerimaBeasiswaDari }}"
                    name="MenerimaBeasiswaDari" placeholder="Menerima Beasiswa Dari"maxlength="30">

                </div>
                <label for="TahunMeninggalkanSekolah" class="col-sm-2 col-form-label">Tahun
                    Meninggalkan
                    Sekolah</label>

                <div class="col-sm-4">
                    <input type="date" class="form-control"
                    id="TahunMeninggalkanSekolah"value="{{ $siswa->TahunMeninggalkanSekolah }}"
                    name="TahunMeninggalkanSekolah" placeholder="Tahun Meninggalkan Sekolah">
                    </div>
                    </div>
            <div class="form-group row">
                <label for="AlasanSebab" class="col-sm-2 col-form-label">Alasan Sebab</label>


                <div class="col-sm-4">
                    <input type="AlasanSebab" class="form-control" id="AlasanSebab"
                    name="AlasanSebab"value="{{ $siswa->AlasanSebab }}"
                    placeholder="Alasan Sebab"maxlength="20">

                </div>
                <label for="TamatBelajarTahun" class="col-sm-2 col-form-label">Tamat Belajar
                    Tahun</label>

                <div class="col-sm-4">
                    <input type="TamatBelajarTahun" class="form-control"
                    id="TamatBelajarTahun"value="{{ $siswa->TamatBelajarTahun }}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="TamatBelajarTahun"
                    placeholder="Tamat Belajar SMA Tahun"maxlength="4">

                    </div>
                    </div>
            <div class="form-group row">
                <label for="TanggalNomorSTTB" class="col-sm-2 col-form-label">Tanggal Nomor
                    STTB</label>

                <div class="col-sm-4">
                    <input type="date" class="form-control"value="{{ $siswa->TanggalNomorSTTB }}"
                    id="TanggalNomorSTTB" name="TanggalNomorSTTB" placeholder="Tanggal Nomor STTB">

                </div>
                <label for="InformasiLain" class="col-sm-2 col-form-label">Informasi Lain</label>


                <div class="col-sm-4">
                    <input type="InformasiLain" class="form-control" id="InformasiLain"
                    value="{{ $siswa->InformasiLain }}"name="InformasiLain"
                    placeholder="Informasi Lain" maxlength="30">

                    </div>
                    </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status Aktif</label>
                <div class="col-sm-4">
                    <select class="form-control form-control select-field" id="status" name="status"
                   required>
                   <option value="Aktif" {{ $siswa->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                   <option value="Tidak Aktif" {{ $siswa->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                   <option value="Lulus" {{ $siswa->status == 'Lulus' ? 'selected' : '' }}>Lulus</option>

                </select>
                </div>
                <label for="foto" class="col-sm-2 col-form-label">Upload Foto</label>
       

                <div class="col-sm-4">
                    <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">Foto Siswa</label>
                    </div>
                    @if($siswa->foto)
                    <img src="{{ asset('storage/fotosiswa/' . $siswa->foto) }}" alt="Foto Profil" width="200" height="300">
            @else
                <p>Foto belum diunggah.</p>
            @endif
            

            <hr>

            </div>






            
         
            <hr>
           
            <div class="form-group row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" onclick="window.location.href = '/siswaall'"
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