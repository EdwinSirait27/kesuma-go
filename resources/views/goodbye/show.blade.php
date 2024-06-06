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

        .form-group label {
            font-weight: bold;
        }
        .col-form-label {
            font-size: 1.3em; /* Atau ukuran yang Anda inginkan */
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
            <form method="POST" action="{{ route('goodbye.lulus', ['encodedId' => base64_encode($siswa->siswa_id)]) }}" enctype="multipart/form-data" id="myForm">

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

                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <label for="username" class="col-form-label">Username</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="username" placeholder="username"
                                    value="{{ $siswa->listakunsiswa->username }}" maxlength="13" readonly>
                            </td>
                            <td><label for="NamaLengkap" class="col-sm-2 col-form-label">Nama Lengkap</label></td>


                            <td><input type="text" class="form-control" id="NamaLengkap" name="NamaLengkap"
                                    value="{{ $siswa->NamaLengkap }}" placeholder="Nama Lengkap" maxlength="50" required
                                    oninput="validateInput(this)"required>
                            </td>
                            <script>
                                function validateInput(inputElement) {
                                    // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                    inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                }
                            </script>
                            <td> <label for="NomorInduk" class="col-sm-2 col-form-label">Nomor Induk</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="NomorInduk"value="{{ $siswa->NomorInduk }}" name="NomorInduk"
                                    placeholder="Nomor Induk" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    maxlength="16"required>
                                < </td>

                        </tr>
                        <tr>
                            <td>
                                <label for="Nama_Panggilan" class="col-sm-2 col-form-label">Nama Panggilan</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="NamaPanggilan" name="NamaPanggilan"
                                    value="{{ $siswa->NamaPanggilan }}" placeholder="Nama Panggilan" maxlength="20" required
                                    oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td>

                                <label for="JenisKelamin" class="col-sm-2 col-form-label label-input">Jenis Kelamin</label>

                            </td>
                            <td>
                                <select class="form-control form-control select-field" id="JenisKelamin" name="JenisKelamin"
                                    value="{{ $siswa->JenisKelamin }}"required>

                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </td>
                            <td>
                                <label for="NISN" class="col-sm-2 col-form-label">NISN</label>

                            </td>
                            <td>
                                <input value="{{ $siswa->NISN }}" type="text" class="form-control" id="NISN"
                                    name="NISN" placeholder="NISN"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="TempatLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="TempatLahir" name="TempatLahir"
                                    value="{{ $siswa->TempatLahir }}"placeholder="Tempat Lahir" maxlength="16" required
                                    oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td> <label for="TanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            </td>
                            <td>
                                <input type="date" class="form-control" id="TanggalLahir" name="TanggalLahir"
                                    value="{{ $siswa->TanggalLahir }}"placeholder="Tanggal Lahir" required>
                            </td>
                            <td>
                                <label for="Agama" class="col-sm-2 col-form-label label-input">Agama</label>

                            </td>
                            <td>
                                <select class="form-control select-field" id="Agama" name="Agama"
                                    value="{{ $siswa->Agama }}"required>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Islam">Islam</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>

                            </td>
                            <td>
                                <input type="Alamat" class="form-control" id="Alamat" name="Alamat"
                                    value="{{ $siswa->Alamat }}" placeholder="Alamat" maxlength="50" required>

                            </td>
                            <td>
                                <label for="RT" class="col-sm-2 col-form-label">RT</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="RT" name="RT"
                                    placeholder="RT" value="{{ $siswa->RT }}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required>

                            </td>
                            <td>
                                <label for="RW" class="col-sm-2 col-form-label">RW</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="RW" name="RW"
                                    placeholder="RW"
                                    value="{{ $siswa->RW }}"oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    maxlength="3" required>
                            </td>
                        <tr>
                            <td>
                                <label for="Kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>

                            </td>
                            <td>
                                <input value="{{ $siswa->Kelurahan }}"type="text" class="form-control" id="Kelurahan"
                                    name="Kelurahan" placeholder="Kelurahan" maxlength="20"
                                    oninput="validateInput(this)" required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td>
                                <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>

                            </td>
                            <td>
                                <input type="text" value="{{ $siswa->Kecamatan }}"class="form-control" id="Kecamatan"
                                    name="Kecamatan" placeholder="Kecamatan" maxlength="20"
                                    oninput="validateInput(this)" required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>

                            </td>
                            <td>
                                <label for="KabKota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>

                            </td>
                            <td>
                                <input type="text" value="{{ $siswa->KabKota }}"class="form-control" id="KabKota"
                                    name="KabKota" placeholder="KabKota" maxlength="20" oninput="validateInput(this)"
                                    required>

                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi</label>

                            </td>
                            <td><input type="text" class="form-control" value="{{ $siswa->Provinsi }}"id="Provinsi"
                                    name="Provinsi" placeholder="Provinsi" maxlength="20"
                                    oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td>
                                <label for="KodePos" class="col-sm-2 col-form-label">Kode Pos</label>

                            </td>
                            <td> <input type="text" class="form-control" id="KodePos" name="KodePos"
                                    value="{{ $siswa->KodePos }}"placeholder="Kode Pos"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="6" required>
                            </td>
                            <td>
                                <label for="Email" class="col-sm-2 col-form-label">Email</label>

                            </td>
                            <td>
                                <input type="Email" value="{{ $siswa->Email }}"class="form-control" id="Email"
                                    name="Email" placeholder="Email"maxlength="40" required>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="NomorTelephone" class="col-sm-2 col-form-label">Nomor Telepon</label>
                            </td>
                            <td> <input value="{{ $siswa->NomorTelephone }}"type="text" class="form-control"
                                    id="NomorTelephone" name="NomorTelephone" placeholder="Nomor Telephone"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required></td>
                            <td> <label for="Kewarganegaraan" class="col-sm-2 col-form-label">Kewarganegaraan</label>
                            </td>
                            <td> <input value="{{ $siswa->Kewarganegaraan }}"type="text" class="form-control"
                                    id="Kewarganegaraan" name="Kewarganegaraan" placeholder="Kewarganegaraan"
                                    maxlength="23" required oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td> <label for="NIK" class="col-sm-2 col-form-label">NIK</label>
                            </td>
                            <td> <input value="{{ $siswa->NIK }}"type="text" class="form-control" id="NIK"
                                    name="NIK" placeholder="NIK"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required></td>
                        </tr>
                        <tr>
                            <td> <label for="GolDarah" class="col-sm-2 col-form-label">Golongan Darah</label>
                            </td>
                            <td> <input value="{{ $siswa->GolDarah }}"type="text" class="form-control" id="GolDarah"
                                    name="GolDarah" placeholder="Golonga Darah" maxlength="1" required
                                    oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td> <label for="TinggalDengan" class="col-sm-2 col-form-label">Tinggal Dengan</label>
                            </td>
                            <td> <input value="{{ $siswa->TinggalDengan }}"type="text" class="form-control"
                                    id="TinggalDengan" name="TinggalDengan" placeholder="Tinggal Dengan" maxlength="20"
                                    required oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td> <label for="StatusSiswa" class="col-sm-2 col-form-label">Status Siswa</label>
                            </td>
                            <td> <select value="{{ $siswa->StatusSiswa }}" class="form-control form-control select-field"
                                    id="StatusSiswa" name="StatusSiswa">

                                    <option value="Lengkap">Lengkap</option>
                                    <option value="Yatim">Yatim</option>
                                    <option value="Piatu">Piatu</option>
                                    <option value="YatimPiatu">YatimPiatu</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td> <label for="AnakKe" class="col-sm-2 col-form-label">Anak Ke</label>
                            </td>
                            <td> <input value="{{ $siswa->AnakKe }}"type="text" class="form-control" id="AnakKe"
                                    name="AnakKe" placeholder="Anak Ke"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="1" required></td>
                            <td> <label for="SaudaraKandung" class="col-sm-2 col-form-label">Jumlah Saudara
                                    Kandung</label>
                            </td>
                            <td> <input value="{{ $siswa->SaudaraKandung }}" type="text" class="form-control"
                                    id="SaudaraKandung" name="SaudaraKandung" placeholder="Saudara Kandung"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="1" required></td>
                            <td> <label for="SaudaraTiri" class="col-sm-2 col-form-label">Jumlah Saudara Tiri</label>
                            </td>
                            <td> <input type="text" class="form-control" id="SaudaraTiri" name="SaudaraTiri"
                                    value="{{ $siswa->SaudaraTiri }}" placeholder="Saudara Tiri"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="1" required></td>
                        </tr>
                        <tr>
                            <td> <label for="Tinggicm" class="col-sm-2 col-form-label">Tinggi cm</label>
                            </td>
                            <td> <input type="text" class="form-control" id="Tinggicm" name="Tinggicm"
                                    value="{{ $siswa->Tinggicm }}"placeholder="Tinggi CM"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required></td>
                            <td><label for="Beratkg" class="col-sm-2 col-form-label">Berat kg</label>
                            </td>
                            <td> <input value="{{ $siswa->Beratkg }}"type="text" class="form-control" id="Beratkg"
                                    name="Beratkg" placeholder="Berat KG"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required></td>
                            <td> <label for="RiwayatPenyakit" class="col-sm-2 col-form-label">Riwayat Penyakit</label>
                            </td>
                            <td> <input value="{{ $siswa->RiwayatPenyakit }}"type="RiwayatPenyakit" class="form-control"
                                    id="RiwayatPenyakit" name="RiwayatPenyakit" placeholder="Riwayat Penyakit">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="AsalSMP" class="col-sm-2 col-form-label">Asal SMP</label>

                            </td>
                            <td> <input value="{{ $siswa->RiwayatPenyakit }}" type="text" class="form-control"
                                    id="AsalSMP" name="AsalSMP" placeholder="Asal SMP" maxlength="30"
                                    required></td>
                            <td> <label for="AlamatSMP" class="col-sm-2 col-form-label">Alamat SMP</label>
                            </td>
                            <td> <input value="{{ $siswa->AlamatSMP }}" type="AlamatSMP" class="form-control"
                                    id="AlamatSMP" name="AlamatSMP" placeholder="Alamat SMP"maxlength="30" required></td>
                            <td>
                                <label for="NPSNSMP" class="col-sm-2 col-form-label">NPSN SMP</label>

                            </td>
                            <td>
                                <input value="{{ $siswa->NPSNSMP }}" type="NPSNSMP" class="form-control" id="NPSNSMP"
                                    name="NPSNSMP" placeholder="Nomor Pokok Sekolah Nasional"maxlength="16">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="KabKotaSMP" class="col-sm-2 col-form-label">Kabupaten/Kota SMP</label>

                            </td>
                            <td> <input type="KabKotaSMP" value="{{ $siswa->KabKotaSMP }}"class="form-control"
                                    id="KabKotaSMP" name="KabKotaSMP" placeholder="Kabupaten/Kota SMP"maxlength="16">
                            </td>
                            <td>
                                <label for="ProvinsiSMP" class="col-sm-2 col-form-label">Provinsi SMP</label>

                            </td>
                            <td> <input type="ProvinsiSMP" class="form-control" id="ProvinsiSMP" name="ProvinsiSMP"
                                    placeholder="Provinsi SMP"maxlength="16" value="{{ $siswa->ProvinsiSMP }}">
                            </td>
                            <td>
                                <label for="NoIjasah" class="col-sm-2 col-form-label">Nomor Ijasah SMP</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="NoIjasah" name="NoIjasah"
                                    placeholder="Nomor Ijasah SMP"value="{{ $siswa->NoIjasah }}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="NoSKHUN" class="col-sm-2 col-form-label">Nomor SKHUN SMP</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="NoSKHUN" name="NoSKHUN"
                                    placeholder="NoSKHUN"value="{{ $siswa->NoSKHUN }}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
                            </td>
                            <td>
                                <label for="DiterimaTanggal" class="col-sm-2 col-form-label">Diterima Tanggal</label>

                            </td>
                            <td>
                                <input type="date" class="form-control"
                                    value="{{ $siswa->DiterimaTanggal }}"id="DiterimaTanggal" name="DiterimaTanggal"
                                    placeholder="Diterima Tanggal"required>
                            </td>
                            <td>
                                <label for="DiterimaDiKelas" class="col-sm-2 col-form-label label-input">Diterima di

                            </td>
                            <td>
                                <select class="form-control form-control select-field" id="DiterimaDiKelas"
                                    name="DiterimaDiKelas"required value="{{ $siswa->DiterimaDiKelas }}">
                                    
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>

                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="DiterimaSemester" class="col-sm-2 col-form-label">Diterima di Semester</label>

                            </td>
                            <td> <select class="form-control form-control select-field" id="DiterimaSemester"
                                    name="DiterimaSemester" value="{{ $siswa->DiterimaSemester }}" required>
                                  
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>


                                </select></td>
                            <td>
                                <label for="MutasiAsalSMA" class="col-sm-2 col-form-label">Mutasi Asal SMA</label>

                            </td>
                            <td> <input type="MutasiAsalSMA" class="form-control" id="MutasiAsalSMA"
                                    name="MutasiAsalSMA" value="{{ $siswa->MutasiAsalSMA }}"
                                    placeholder="Mutasi Asal SMA" maxlength="20">
                            </td>
                            <td>
                                <label for="AlasanPindah" class="col-sm-2 col-form-label">Alasan Pindah</label>

                            </td>
                            <td>
                                <input type="AlasanPindah" value="{{ $siswa->AlasanPindah }}" class="form-control"
                                    id="AlasanPindah" name="AlasanPindah" placeholder="Alasan Pindah"maxlength="20">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="NoPesertaUNSMP" class="col-sm-2 col-form-label">Nomor Peserta UN SMP</label>

                            </td>
                            <td>
                                <input type="text" value="{{ $siswa->NoPesertaUNSMP }}" class="form-control"
                                    id="NoPesertaUNSMP" name="NoPesertaUNSMP" placeholder="No Peserta UN SMP"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16">
                            </td>
                            <td>
                                <label for="TglIjasah" class="col-sm-2 col-form-label">Tanggal Ijasah</label>

                            </td>
                            <td>
                                <input type="date" class="form-control" value="{{ $siswa->TglIjasah }}"
                                    id="TglIjasah" name="TglIjasah" placeholder="Tanggal Ijasah" required>
                            </td>
                            <td>
                                <label for="NamaOrangTuaPadaIjasah" class="col-sm-2 col-form-label">Nama Orang Tua pada
                                    Ijasah</label>
                            </td>
                            <td>
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
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="NamaAyah" class="col-sm-2 col-form-label">Nama Ayah</label>

                            </td>
                            <td><input type="NamaAyah" class="form-control" id="NamaAyah"
                                    value="{{ $siswa->NamaAyah }}"name="NamaAyah" placeholder="Nama Ayah"maxlength="30"
                                    required>
                            </td>
                            <td>
                                <label for="Tahun_Lahir_Ayah" class="col-sm-2 col-form-label">Tahun Lahir Ayah</label>

                            </td>
                            <td> <input type="text" class="form-control" id="TahunLahirAyah"
                                    value="{{ $siswa->TahunLahirAyah }}"name="TahunLahirAyah"
                                    placeholder="Tahun Lahir Ayah"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="4" required>
                            </td>
                            <td>
                                <label for="AlamatAyah" class="col-sm-2 col-form-label">Alamat Ayah</label>

                            </td>
                            <td>
                                <input type="AlamatAyah" value="{{ $siswa->AlamatAyah }}" class="form-control"
                                    id="AlamatAyah" name="AlamatAyah" placeholder="Alamat Ayah" maxlength="30">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="NomorTelephoneAyah" class="col-sm-2 col-form-label">Nomor Telepon Ayah</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{ $siswa->NomorTelephoneAyah }}"
                                    id="NomorTelephoneAyah" name="NomorTelephoneAyah" placeholder="NomorTelephoneAyah"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>

                            </td>
                            <td>
                                <label for="AgamaAyah" class="col-sm-2 col-form-label">Agama Ayah</label>

                            </td>
                            <td> <input type="AgamaAyah" class="form-control" id="AgamaAyah"
                                    value="{{ $siswa->AgamaAyah }}" name="AgamaAyah" placeholder="Agama Ayah"
                                    maxlength="10">
                            </td>
                            <td>
                                <label for="PendidikanTerakhirAyah" class="col-sm-2 col-form-label">Pendidikan Terakhir
                                    Ayah</label>
                            </td>
                            <td>
                                <input type="PendidikanTerakhirAyah" class="form-control" id="PendidikanTerakhirAyah"
                                    name="PendidikanTerakhirAyah" placeholder="Pendidikan Terakhir Ayah"
                                    maxlength="10"value="{{ $siswa->PendidikanTerakhirAyah }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Pekerjaan_Ayah" class="col-sm-2 col-form-label">Pekerjaan Ayah</label>

                            </td>
                            <td>
                                <input type="PekerjaanAyah" class="form-control"
                                    id="PekerjaanAyah"value="{{ $siswa->PekerjaanAyah }}" name="PekerjaanAyah"
                                    placeholder="Pekerjaan Ayah" maxlength="10"required>
                            </td>
                            <td>
                                <label for="PenghasilanAyah" class="col-sm-2 col-form-label">Penghasilan Ayah</label>

                            </td>
                            <td>
                                <input type="PenghasilanAyah" class="form-control"
                                    id="PenghasilanAyah"value="{{ $siswa->PenghasilanAyah }}" name="PenghasilanAyah"
                                    placeholder="Penghasilan Ayah" maxlength="30" required>

                            </td>
                            <td>
                                <label for="NamaIbu" class="col-sm-2 col-form-label">Nama Ibu</label>

                            </td>
                            <td>
                                <input type="NamaIbu" class="form-control" value="{{ $siswa->NamaIbu }}"id="NamaIbu"
                                    name="NamaIbu" placeholder="Nama Ibu" maxlength="30" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="TahunLahirIbu" class="col-sm-2 col-form-label">Tahun Lahir Ibu</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="TahunLahirIbu"
                                    value="{{ $siswa->TahunLahirIbu }}"name="TahunLahirIbu" placeholder="Tahun Lahir Ibu"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="4" required>
                            </td>
                            <td>
                                <label for="AlamatIbu" class="col-sm-2 col-form-label">Alamat Ibu</label>

                            </td>
                            <td>
                                <input type="AlamatIbu" class="form-control"
                                    value="{{ $siswa->AlamatIbu }}"id="AlamatIbu" name="AlamatIbu"
                                    placeholder="Alamat Ibu"maxlength="30">
                            </td>
                            <td>
                                <label for="NomorTelephoneIbu" class="col-sm-2 col-form-label">Nomor Telepon Ibu</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="NomorTelephoneIbu"
                                    value="{{ $siswa->NomorTelephoneIbu }}"name="NomorTelephoneIbu"
                                    placeholder="Nomor Telephone Ibu"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="AgamaIbu" class="col-sm-2 col-form-label">Agama Ibu</label>

                            </td>
                            <td>
                                <input type="AgamaIbu" class="form-control" id="AgamaIbu"
                                    name="AgamaIbu"value="{{ $siswa->AgamaIbu }}" placeholder="Agama Ibu"maxlength="10"
                                    required>

                            </td>
                            <td>  <label for="PendidikanTerakhirIbu" class="col-sm-2 col-form-label">Pendidikan Terakhir
                            </td>
                            <td> <input type="PendidikanTerakhirIbu" class="form-control"
                                value="{{ $siswa->PendidikanTerakhirIbu }}"id="PendidikanTerakhirIbu"
                                name="PendidikanTerakhirIbu" placeholder="Pendidikan Terakhir Ibu"maxlength="20">
</td>
                            <td>     <label for="PekerjaanIbu" class="col-sm-2 col-form-label">Pekerjaan Ibu</label>

                            </td>
                            <td> <input type="PekerjaanIbu" value="{{ $siswa->PekerjaanIbu }}"class="form-control"
                                id="PekerjaanIbu" name="PekerjaanIbu" placeholder="Pekerjaan Ibu"maxlength="20"
                                required>
</td>
                        </tr>
                        <tr>
                            <td>        <label for="PenghasilanIbu" class="col-sm-2 col-form-label">Penghasilan Ibu</label>
                            </td>
                            <td>  <input type="PenghasilanIbu" class="form-control"
                                value="{{ $siswa->PenghasilanIbu }}"id="PenghasilanIbu" name="PenghasilanIbu"
                                placeholder="Penghasilan Ibu"maxlength="30" required></td>
                            </td>
                            <td><label for="NamaWali" class="col-sm-2 col-form-label">Nama Wali</label>

                            </td>
                            <td>          <input type="NamaWali" class="form-control" id="NamaWali"
                                value="{{ $siswa->NamaWali }}"name="NamaWali"
                                placeholder="Nama Wali"maxlength="30">
                  </td>
                            <td>   <label for="TahunLahirWali" class="col-sm-2 col-form-label">Tahun Lahir Wali</label></td>
                            <td>   <input type="TahunLahirWali" class="form-control" id="TahunLahirWali"
                                value="{{ $siswa->TahunLahirWali }}"name="TahunLahirWali"
                                placeholder="Tahun Lahir Wali"maxlength="4"></td>
                        </tr>
                       
                        <tr>
                            <td>
                                <label for="AlamatWali" class="col-sm-2 col-form-label">Alamat Wali</label>
                            </td>
                            <td>
                                <input type="AlamatWali" class="form-control"
                                id="AlamatWali"value="{{ $siswa->AlamatWali }}" name="AlamatWali"
                                placeholder="Alamat Wali"maxlength="30">

                            </td>
                            <td>
                                <label for="NomorTelephoneWali" class="col-sm-2 col-form-label">Nomor Telepon
                                    Wali</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="NomorTelephoneWali"
                                name="NomorTelephoneWali" placeholder="Nomor Telfon"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13"
                                value="{{ $siswa->NomorTelephoneWali }}">
                            </td>
                            <td>
                                <label for="AgamaWali" class="col-sm-2 col-form-label">Agama Wali</label>
                            </td>
                            <td>
                                <input type="AgamaWali" class="form-control" id="AgamaWali"
                                value="{{ $siswa->AgamaWali }}"name="AgamaWali"
                                placeholder="Agama Wali"maxlength="10">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="PendidikanTerakhirWali" class="col-sm-2 col-form-label">Pendidikan
                                    Terakhir
                                    Wali</label>
                            </td>
                            <td>
                                <input type="PendidikanTerakhirWali" class="form-control"
                                value="{{ $siswa->PendidikanTerakhirWali }}"id="PendidikanTerakhirWali"
                                name="PendidikanTerakhirWali"
                                placeholder="Pendidikan Terakhir Wali"maxlength="12">

                            </td>
                            <td>
                                <label for="PekerjaanWali" class="col-sm-2 col-form-label">Pekerjaan Wali</label>

                            </td>
                            <td>
                                <input type="PekerjaanWali" class="form-control"
                                value="{{ $siswa->PekerjaanWali }}"id="PekerjaanWali" name="PekerjaanWali"
                                placeholder="Pekerjaan Wali"maxlength="20">
                            </td>
                            <td>
                                <label for="WaliPenghasilan" class="col-sm-2 col-form-label">Penghasilan Wali</label>
                            </td>
                            <td>
                                <input type="WaliPenghasilan" class="form-control" id="WaliPenghasilan"
                                value="{{ $siswa->WaliPenghasilan }}"name="WaliPenghasilan"
                                placeholder="Penghasilan Wali"maxlength="30">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="StatusHubunganWali" class="col-sm-2 col-form-label">Status Hubungan
                                    Wali</label>
    
                            </td>
                            <td>
                                <input type="StatusHubunganWali" class="form-control"
                                id="StatusHubunganWali"value="{{ $siswa->StatusHubunganWali }}"
                                name="StatusHubunganWali" placeholder="Status Hubungan Wali"maxlength="12">

                            </td>
                            <td>
                                <label for="MenerimaBeasiswaDari" class="col-sm-2 col-form-label">Menerima Beasiswa
                                    Dari</label>
    
                            </td>
                            <td>
                                <input type="MenerimaBeasiswaDari" class="form-control"
                                id="MenerimaBeasiswaDari"value="{{ $siswa->MenerimaBeasiswaDari }}"
                                name="MenerimaBeasiswaDari" placeholder="Menerima Beasiswa Dari"maxlength="30">

                            </td>
                            <td>
                                <label for="TahunMeninggalkanSekolah" class="col-sm-2 col-form-label">Tahun
                                    Meninggalkan
                                    Sekolah</label>
                            </td>
                            <td>
                                <input type="date" class="form-control"
                                id="TahunMeninggalkanSekolah"value="{{ $siswa->TahunMeninggalkanSekolah }}"
                                name="TahunMeninggalkanSekolah" placeholder="Tahun Meninggalkan Sekolah"></td>
                           
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="AlasanSebab" class="col-sm-2 col-form-label">Alasan Sebab</label>


                            </td>
                            <td>
                                <input type="AlasanSebab" class="form-control" id="AlasanSebab"
                                name="AlasanSebab"value="{{ $siswa->AlasanSebab }}"
                                placeholder="Alasan Sebab"maxlength="20">

                            </td>
                            <td>
                                <label for="TamatBelajarTahun" class="col-sm-2 col-form-label">Tamat Belajar
                                    Tahun</label>
    
                            </td>
                            <td>
                                <input type="TamatBelajarTahun" class="form-control"
                                id="TamatBelajarTahun"value="{{ $siswa->TamatBelajarTahun }}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="TamatBelajarTahun"
                                placeholder="Tamat Belajar SMA Tahun"maxlength="4">

                            </td>
                            <td>
                                <label for="TanggalNomorSTTB" class="col-sm-2 col-form-label">Tanggal Nomor
                                    STTB</label>
    
                            </td>
                            <td>
                                <input type="date" class="form-control"value="{{ $siswa->TanggalNomorSTTB }}"
                                id="TanggalNomorSTTB" name="TanggalNomorSTTB" placeholder="Tanggal Nomor STTB">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="InformasiLain" class="col-sm-2 col-form-label">Informasi Lain</label>

                            </td>
                            <td>
                                <input type="InformasiLain" class="form-control" id="InformasiLain"
                                value="{{ $siswa->InformasiLain }}"name="InformasiLain"
                                placeholder="Informasi Lain" maxlength="30">

                            </td>
                            <td>  <label for="status" class="col-sm-2 col-form-label">Status Aktif</label></td>
                            <td> <select class="form-control form-control select-field" id="status" name="status"
                                value="{{ $siswa->status }}"required>

                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                                <option value="Lulus">Lulus</option>
                            </select></td>
                            <td>
                                <label for="foto" class="col-sm-2 col-form-label">Upload Foto</label>
       
                            </td>
                            <td>
                        <input type="file" class="form-control" id="foto" name="foto">
                            </td>
                        </tr>
                        <tr>
                           
                            <td>
                                <label for="foto" class="col-sm-2 col-form-label">Foto Siswa</label>
                            </td>
                        <td>
                            @if($siswa->foto)
                            <img src="{{ asset('storage/fotosiswa/' . $siswa->foto) }}" alt="Foto Profil" width="200" height="300">
                    @else
                        <p>Foto belum diunggah.</p>
                    @endif
                    </td>    
                        </tr>
                    </tbody>
                </table>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        
                        <button type="button" onclick="window.location.href = '/siswaall'"
                            class="btn btn-danger">Kembali</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#showPasswordBtn').on('click', function() {
                var passwordInput = $('#password');
                var passwordIcon = $(this).find('i');
                if (passwordInput.attr('disabled') === 'password') {
                    passwordInput.attr('disabled', 'text');
                    passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('disabled', 'password');
                    passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
    <script>
        // Ambil elemen-elemen yang dibutuhkan dari DOM
        const passwordInput = document.getElementById('password');
        const updatePasswordCheckbox = document.getElementById('updatePasswordCheckbox');

        // Tambahkan event listener pada checkbox untuk mengatur keadaan input password
        updatePasswordCheckbox.addEventListener('change', function() {
            // Jika checkbox dicentang, aktifkan input password
            // Jika tidak dicentang, nonaktifkan dan reset nilai password
            if (updatePasswordCheckbox.checked) {
                passwordInput.removeAttribute('disabled');
            } else {
                passwordInput.setAttribute('disabled', 'disabled');
                passwordInput.value = '';
            }
        });

        // Tambahkan event listener pada formulir untuk mengatur pengiriman data
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            // Jika checkbox tidak dicentang, hapus elemen input password dari data yang akan dikirimkan
            if (!updatePasswordCheckbox.checked) {
                event.preventDefault(); // Mencegah pengiriman formulir
                passwordInput.removeAttribute('name');
            }
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("myForm").addEventListener("submit", function(event) {
                var inputs = document.querySelectorAll(".form-control");
                var isValid = true;
                inputs.forEach(function(input) {
                    if (input.value.trim() === "") {
                        input.classList.add("invalid");
                        input.nextElementSibling.style.display = "block";
                        isValid = false;
                    } else {
                        input.classList.remove("invalid");
                        input.nextElementSibling.style.display = "none";
                    }
                });
                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection


{{-- @extends('index')

@section('title', 'Kesuma-GO | Edit Password')

@section('content')
    <style>
        .dashboard_graph {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
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

        button:hover {
            background-color: #0056b3;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .form-control.invalid {
            border-color: red;
        }
    </style>
    
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-male" style="margin-right: 4px; margin-top: 15px;"></i>Edit <small>Siswa</small></h3>
            <hr>
            <form method="POST" action="{{ route('siswaall.updatee', $siswa->siswa_id) }}" enctype="multipart/form-data" id="myForm">
                @csrf
                @method('PUT')
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <label for="username" class="col-form-label">Username</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="username" placeholder="username"
                                    value="{{ $siswa->listakunsiswa->username }}" maxlength="13" readonly>
                            </td>
                            <td><label for="NamaLengkap" class="col-sm-2 col-form-label">Nama Lengkap</label></td>


                            <td><input type="text" class="form-control" id="NamaLengkap" name="NamaLengkap"
                                    value="{{ $siswa->NamaLengkap }}" placeholder="Nama Lengkap" maxlength="50" required
                                    oninput="validateInput(this)"required>
                            </td>
                            <script>
                                function validateInput(inputElement) {
                                    // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                    inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                }
                            </script>
                            <td> <label for="NomorInduk" class="col-sm-2 col-form-label">Nomor Induk</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="NomorInduk" name="NomorInduk"
                                    placeholder="Nomor Induk" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    maxlength="16"required>
                                < </td>

                        </tr>
                        <tr>
                            <td>
                                <label for="Nama_Panggilan" class="col-sm-2 col-form-label">Nama Panggilan</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="NamaPanggilan" name="NamaPanggilan"
                                    value="{{ $siswa->NamaPanggilan }}" placeholder="Nama Panggilan" maxlength="20" required
                                    oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td>

                                <label for="JenisKelamin" class="col-sm-2 col-form-label label-input">Jenis Kelamin</label>

                            </td>
                            <td>
                                <select class="form-control form-control select-field" id="JenisKelamin" name="JenisKelamin"
                                    value="{{ $siswa->JenisKelamin }}"required>

                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </td>
                            <td>
                                <label for="NISN" class="col-sm-2 col-form-label">NISN</label>

                            </td>
                            <td>
                                <input value="{{ $siswa->NISN }}" type="text" class="form-control" id="NISN"
                                    name="NISN" placeholder="NISN"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="TempatLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="TempatLahir" name="TempatLahir"
                                    value="{{ $siswa->TempatLahir }}"placeholder="Tempat Lahir" maxlength="16" required
                                    oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td> <label for="TanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            </td>
                            <td>
                                <input type="date" class="form-control" id="TanggalLahir" name="TanggalLahir"
                                    value="{{ $siswa->TanggalLahir }}"placeholder="Tanggal Lahir" required>
                            </td>
                            <td>
                                <label for="Agama" class="col-sm-2 col-form-label label-input">Agama</label>

                            </td>
                            <td>
                                <select class="form-control select-field" id="Agama" name="Agama"
                                    value="{{ $siswa->Agama }}"required>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Islam">Islam</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>

                            </td>
                            <td>
                                <input type="Alamat" class="form-control" id="Alamat" name="Alamat"
                                    value="{{ $siswa->Alamat }}" placeholder="Alamat" maxlength="50" required>

                            </td>
                            <td>
                                <label for="RT" class="col-sm-2 col-form-label">RT</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="RT" name="RT"
                                    placeholder="RT" value="{{ $siswa->RT }}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required>

                            </td>
                            <td>
                                <label for="RW" class="col-sm-2 col-form-label">RW</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="RW" name="RW"
                                    placeholder="RW"
                                    value="{{ $siswa->RW }}"oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    maxlength="3" required>
                            </td>
                        <tr>
                            <td>
                                <label for="Kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>

                            </td>
                            <td>
                                <input value="{{ $siswa->Kelurahan }}"type="text" class="form-control" id="Kelurahan"
                                    name="Kelurahan" placeholder="Kelurahan" maxlength="20"
                                    oninput="validateInput(this)" required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td>
                                <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>

                            </td>
                            <td>
                                <input type="text" value="{{ $siswa->Kecamatan }}"class="form-control" id="Kecamatan"
                                    name="Kecamatan" placeholder="Kecamatan" maxlength="20"
                                    oninput="validateInput(this)" required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>

                            </td>
                            <td>
                                <label for="KabKota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>

                            </td>
                            <td>
                                <input type="text" value="{{ $siswa->KabKota }}"class="form-control" id="KabKota"
                                    name="KabKota" placeholder="KabKota" maxlength="20" oninput="validateInput(this)"
                                    required>

                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi</label>

                            </td>
                            <td><input type="text" class="form-control" value="{{ $siswa->Provinsi }}"id="Provinsi"
                                    name="Provinsi" placeholder="Provinsi" maxlength="20"
                                    oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td>
                                <label for="KodePos" class="col-sm-2 col-form-label">Kode Pos</label>

                            </td>
                            <td> <input type="text" class="form-control" id="KodePos" name="KodePos"
                                    value="{{ $siswa->KodePos }}"placeholder="Kode Pos"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="6" required>
                            </td>
                            <td>
                                <label for="Email" class="col-sm-2 col-form-label">Email</label>

                            </td>
                            <td>
                                <input type="Email" value="{{ $siswa->Email }}"class="form-control" id="Email"
                                    name="Email" placeholder="Email"maxlength="40" required>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="NomorTelephone" class="col-sm-2 col-form-label">Nomor Telepon</label>
                            </td>
                            <td> <input value="{{ $siswa->NomorTelephone }}"type="text" class="form-control"
                                    id="NomorTelephone" name="NomorTelephone" placeholder="Nomor Telephone"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required></td>
                            <td> <label for="Kewarganegaraan" class="col-sm-2 col-form-label">Kewarganegaraan</label>
                            </td>
                            <td> <input value="{{ $siswa->Kewarganegaraan }}"type="text" class="form-control"
                                    id="Kewarganegaraan" name="Kewarganegaraan" placeholder="Kewarganegaraan"
                                    maxlength="23" required oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td> <label for="NIK" class="col-sm-2 col-form-label">NIK</label>
                            </td>
                            <td> <input value="{{ $siswa->NIK }}"type="text" class="form-control" id="NIK"
                                    name="NIK" placeholder="NIK"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required></td>
                        </tr>
                        <tr>
                            <td> <label for="GolDarah" class="col-sm-2 col-form-label">Golongan Darah</label>
                            </td>
                            <td> <input value="{{ $siswa->GolDarah }}"type="text" class="form-control" id="GolDarah"
                                    name="GolDarah" placeholder="Golonga Darah" maxlength="1" required
                                    oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td> <label for="TinggalDengan" class="col-sm-2 col-form-label">Tinggal Dengan</label>
                            </td>
                            <td> <input value="{{ $siswa->TinggalDengan }}"type="text" class="form-control"
                                    id="TinggalDengan" name="TinggalDengan" placeholder="Tinggal Dengan" maxlength="20"
                                    required oninput="validateInput(this)"required>
                                <script>
                                    function validateInput(inputElement) {
                                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                                    }
                                </script>
                            </td>
                            <td> <label for="StatusSiswa" class="col-sm-2 col-form-label">Status Siswa</label>
                            </td>
                            <td> <select value="{{ $siswa->StatusSiswa }}" class="form-control form-control select-field"
                                    id="StatusSiswa" name="StatusSiswa">

                                    <option value="Lengkap">Lengkap</option>
                                    <option value="Yatim">Yatim</option>
                                    <option value="Piatu">Piatu</option>
                                    <option value="YatimPiatu">YatimPiatu</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td> <label for="AnakKe" class="col-sm-2 col-form-label">Anak Ke</label>
                            </td>
                            <td> <input value="{{ $siswa->AnakKe }}"type="text" class="form-control" id="AnakKe"
                                    name="AnakKe" placeholder="Anak Ke"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="1" required></td>
                            <td> <label for="SaudaraKandung" class="col-sm-2 col-form-label">Jumlah Saudara
                                    Kandung</label>
                            </td>
                            <td> <input value="{{ $siswa->SaudaraKandung }}" type="text" class="form-control"
                                    id="SaudaraKandung" name="SaudaraKandung" placeholder="Saudara Kandung"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="1" required></td>
                            <td> <label for="SaudaraTiri" class="col-sm-2 col-form-label">Jumlah Saudara Tiri</label>
                            </td>
                            <td> <input type="text" class="form-control" id="SaudaraTiri" name="SaudaraTiri"
                                    value="{{ $siswa->SaudaraTiri }}" placeholder="Saudara Tiri"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="1" required></td>
                        </tr>
                        <tr>
                            <td> <label for="Tinggicm" class="col-sm-2 col-form-label">Tinggi cm</label>
                            </td>
                            <td> <input type="text" class="form-control" id="Tinggicm" name="Tinggicm"
                                    value="{{ $siswa->Tinggicm }}"placeholder="Tinggi CM"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required></td>
                            <td><label for="Beratkg" class="col-sm-2 col-form-label">Berat kg</label>
                            </td>
                            <td> <input value="{{ $siswa->Beratkg }}"type="text" class="form-control" id="Beratkg"
                                    name="Beratkg" placeholder="Berat KG"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required></td>
                            <td> <label for="RiwayatPenyakit" class="col-sm-2 col-form-label">Riwayat Penyakit</label>
                            </td>
                            <td> <input value="{{ $siswa->RiwayatPenyakit }}"type="RiwayatPenyakit" class="form-control"
                                    id="RiwayatPenyakit" name="RiwayatPenyakit" placeholder="Riwayat Penyakit">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="AsalSMP" class="col-sm-2 col-form-label">Asal SMP</label>

                            </td>
                            <td> <input value="{{ $siswa->RiwayatPenyakit }}" type="text" class="form-control"
                                    id="AsalSMP" name="AsalSMP" placeholder="Riwayat Penyakit" maxlength="30"
                                    required></td>
                            <td> <label for="AlamatSMP" class="col-sm-2 col-form-label">Alamat SMP</label>
                            </td>
                            <td> <input value="{{ $siswa->AlamatSMP }}" type="AlamatSMP" class="form-control"
                                    id="AlamatSMP" name="AlamatSMP" placeholder="Alamat SMP"maxlength="30" required></td>
                            <td>
                                <label for="NPSNSMP" class="col-sm-2 col-form-label">NPSN SMP</label>

                            </td>
                            <td>
                                <input value="{{ $siswa->NPSNSMP }}" type="NPSNSMP" class="form-control" id="NPSNSMP"
                                    name="NPSNSMP" placeholder="Nomor Pokok Sekolah Nasional"maxlength="16">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="KabKotaSMP" class="col-sm-2 col-form-label">Kabupaten/Kota SMP</label>

                            </td>
                            <td> <input type="KabKotaSMP" value="{{ $siswa->KabKotaSMP }}"class="form-control"
                                    id="KabKotaSMP" name="KabKotaSMP" placeholder="Kabupaten/Kota SMP"maxlength="16">
                            </td>
                            <td>
                                <label for="ProvinsiSMP" class="col-sm-2 col-form-label">Provinsi SMP</label>

                            </td>
                            <td> <input type="ProvinsiSMP" class="form-control" id="ProvinsiSMP" name="ProvinsiSMP"
                                    placeholder="Provinsi SMP"maxlength="16" value="{{ $siswa->ProvinsiSMP }}">
                            </td>
                            <td>
                                <label for="NoIjasah" class="col-sm-2 col-form-label">Nomor Ijasah SMP</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="NoIjasah" name="NoIjasah"
                                    placeholder="Nomor Ijasah SMP"value="{{ $siswa->NoIjasah }}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="NoSKHUN" class="col-sm-2 col-form-label">Nomor SKHUN SMP</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="NoSKHUN" name="NoSKHUN"
                                    placeholder="NoSKHUN"value="{{ $siswa->NoSKHUN }}"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
                            </td>
                            <td>
                                <label for="DiterimaTanggal" class="col-sm-2 col-form-label">Diterima Tanggal</label>

                            </td>
                            <td>
                                <input type="date" class="form-control"
                                    value="{{ $siswa->DiterimaTanggal }}"id="DiterimaTanggal" name="DiterimaTanggal"
                                    placeholder="Diterima Tanggal"required>
                            </td>
                            <td>
                                <label for="DiterimaDiKelas" class="col-sm-2 col-form-label label-input">Diterima di

                            </td>
                            <td>
                                <select class="form-control form-control select-field" id="DiterimaDiKelas"
                                    name="DiterimaDiKelas"required value="{{ $siswa->DiterimaDiKelas }}">
                                    
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>

                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="DiterimaSemester" class="col-sm-2 col-form-label">Diterima di Semester</label>

                            </td>
                            <td> <select class="form-control form-control select-field" id="DiterimaSemester"
                                    name="DiterimaSemester" value="{{ $siswa->DiterimaSemester }}" required>
                                  
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>


                                </select></td>
                            <td>
                                <label for="MutasiAsalSMA" class="col-sm-2 col-form-label">Mutasi Asal SMA</label>

                            </td>
                            <td> <input type="MutasiAsalSMA" class="form-control" id="MutasiAsalSMA"
                                    name="MutasiAsalSMA" value="{{ $siswa->MutasiAsalSMA }}"
                                    placeholder="Mutasi Asal SMA" maxlength="20">
                            </td>
                            <td>
                                <label for="AlasanPindah" class="col-sm-2 col-form-label">Alasan Pindah</label>

                            </td>
                            <td>
                                <input type="AlasanPindah" value="{{ $siswa->AlasanPindah }}" class="form-control"
                                    id="AlasanPindah" name="AlasanPindah" placeholder="Alasan Pindah"maxlength="20">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="NoPesertaUNSMP" class="col-sm-2 col-form-label">Nomor Peserta UN SMP</label>

                            </td>
                            <td>
                                <input type="text" value="{{ $siswa->NoPesertaUNSMP }}" class="form-control"
                                    id="NoPesertaUNSMP" name="NoPesertaUNSMP" placeholder="No Peserta UN SMP"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16">
                            </td>
                            <td>
                                <label for="TglIjasah" class="col-sm-2 col-form-label">Tanggal Ijasah</label>

                            </td>
                            <td>
                                <input type="date" class="form-control" value="{{ $siswa->TglIjasah }}"
                                    id="TglIjasah" name="TglIjasah" placeholder="Tanggal Ijasah" required>
                            </td>
                            <td>
                                <label for="NamaOrangTuaPadaIjasah" class="col-sm-2 col-form-label">Nama Orang Tua pada
                                    Ijasah</label>
                            </td>
                            <td>
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
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="NamaAyah" class="col-sm-2 col-form-label">Nama Ayah</label>

                            </td>
                            <td><input type="NamaAyah" class="form-control" id="NamaAyah"
                                    value="{{ $siswa->NamaAyah }}"name="NamaAyah" placeholder="Nama Ayah"maxlength="30"
                                    required>
                            </td>
                            <td>
                                <label for="Tahun_Lahir_Ayah" class="col-sm-2 col-form-label">Tahun Lahir Ayah</label>

                            </td>
                            <td> <input type="text" class="form-control" id="TahunLahirAyah"
                                    value="{{ $siswa->TahunLahirAyah }}"name="TahunLahirAyah"
                                    placeholder="Tahun Lahir Ayah"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="4" required>
                            </td>
                            <td>
                                <label for="AlamatAyah" class="col-sm-2 col-form-label">Alamat Ayah</label>

                            </td>
                            <td>
                                <input type="AlamatAyah" value="{{ $siswa->AlamatAyah }}" class="form-control"
                                    id="AlamatAyah" name="AlamatAyah" placeholder="Alamat Ayah" maxlength="30">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="NomorTelephoneAyah" class="col-sm-2 col-form-label">Nomor Telepon Ayah</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{ $siswa->NomorTelephoneAyah }}"
                                    id="NomorTelephoneAyah" name="NomorTelephoneAyah" placeholder="NomorTelephoneAyah"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>

                            </td>
                            <td>
                                <label for="AgamaAyah" class="col-sm-2 col-form-label">Agama Ayah</label>

                            </td>
                            <td> <input type="AgamaAyah" class="form-control" id="AgamaAyah"
                                    value="{{ $siswa->AgamaAyah }}" name="AgamaAyah" placeholder="Agama Ayah"
                                    maxlength="10">
                            </td>
                            <td>
                                <label for="PendidikanTerakhirAyah" class="col-sm-2 col-form-label">Pendidikan Terakhir
                                    Ayah</label>
                            </td>
                            <td>
                                <input type="PendidikanTerakhirAyah" class="form-control" id="PendidikanTerakhirAyah"
                                    name="PendidikanTerakhirAyah" placeholder="Pendidikan Terakhir Ayah"
                                    maxlength="10"value="{{ $siswa->PendidikanTerakhirAyah }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="Pekerjaan_Ayah" class="col-sm-2 col-form-label">Pekerjaan Ayah</label>

                            </td>
                            <td>
                                <input type="PekerjaanAyah" class="form-control"
                                    id="PekerjaanAyah"value="{{ $siswa->PekerjaanAyah }}" name="PekerjaanAyah"
                                    placeholder="Pekerjaan Ayah" maxlength="10"required>
                            </td>
                            <td>
                                <label for="PenghasilanAyah" class="col-sm-2 col-form-label">Penghasilan Ayah</label>

                            </td>
                            <td>
                                <input type="PenghasilanAyah" class="form-control"
                                    id="PenghasilanAyah"value="{{ $siswa->PenghasilanAyah }}" name="PenghasilanAyah"
                                    placeholder="Penghasilan Ayah" maxlength="30" required>

                            </td>
                            <td>
                                <label for="NamaIbu" class="col-sm-2 col-form-label">Nama Ibu</label>

                            </td>
                            <td>
                                <input type="NamaIbu" class="form-control" value="{{ $siswa->NamaIbu }}"id="NamaIbu"
                                    name="NamaIbu" placeholder="Nama Ibu" maxlength="30" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="TahunLahirIbu" class="col-sm-2 col-form-label">Tahun Lahir Ibu</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="TahunLahirIbu"
                                    value="{{ $siswa->TahunLahirIbu }}"name="TahunLahirIbu" placeholder="Tahun Lahir Ibu"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="4" required>
                            </td>
                            <td>
                                <label for="AlamatIbu" class="col-sm-2 col-form-label">Alamat Ibu</label>

                            </td>
                            <td>
                                <input type="AlamatIbu" class="form-control"
                                    value="{{ $siswa->AlamatIbu }}"id="AlamatIbu" name="AlamatIbu"
                                    placeholder="Alamat Ibu"maxlength="30">
                            </td>
                            <td>
                                <label for="NomorTelephoneIbu" class="col-sm-2 col-form-label">Nomor Telepon Ibu</label>

                            </td>
                            <td>
                                <input type="text" class="form-control" id="NomorTelephoneIbu"
                                    value="{{ $siswa->NomorTelephoneIbu }}"name="NomorTelephoneIbu"
                                    placeholder="Nomor Telephone Ibu"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="AgamaIbu" class="col-sm-2 col-form-label">Agama Ibu</label>

                            </td>
                            <td>
                                <input type="AgamaIbu" class="form-control" id="AgamaIbu"
                                    name="AgamaIbu"value="{{ $siswa->AgamaIbu }}" placeholder="Agama Ibu"maxlength="10"
                                    required>

                            </td>
                            <td>  <label for="PendidikanTerakhirIbu" class="col-sm-2 col-form-label">Pendidikan Terakhir
                            </td>
                            <td> <input type="PendidikanTerakhirIbu" class="form-control"
                                value="{{ $siswa->PendidikanTerakhirIbu }}"id="PendidikanTerakhirIbu"
                                name="PendidikanTerakhirIbu" placeholder="Pendidikan Terakhir Ibu"maxlength="20">
</td>
                            <td>     <label for="PekerjaanIbu" class="col-sm-2 col-form-label">Pekerjaan Ibu</label>

                            </td>
                            <td> <input type="PekerjaanIbu" value="{{ $siswa->PekerjaanIbu }}"class="form-control"
                                id="PekerjaanIbu" name="PekerjaanIbu" placeholder="Pekerjaan Ibu"maxlength="20"
                                required>
</td>
                        </tr>
                        <tr>
                            <td>        <label for="PenghasilanIbu" class="col-sm-2 col-form-label">Penghasilan Ibu</label>
                            </td>
                            <td>  <input type="PenghasilanIbu" class="form-control"
                                value="{{ $siswa->PenghasilanIbu }}"id="PenghasilanIbu" name="PenghasilanIbu"
                                placeholder="Penghasilan Ibu"maxlength="30" required></td>
                            </td>
                            <td><label for="NamaWali" class="col-sm-2 col-form-label">Nama Wali</label>

                            </td>
                            <td>          <input type="NamaWali" class="form-control" id="NamaWali"
                                value="{{ $siswa->NamaWali }}"name="NamaWali"
                                placeholder="Nama Wali"maxlength="30">
                  </td>
                            <td>   <label for="TahunLahirWali" class="col-sm-2 col-form-label">Tahun Lahir Wali</label></td>
                            <td>   <input type="TahunLahirWali" class="form-control" id="TahunLahirWali"
                                value="{{ $siswa->TahunLahirWali }}"name="TahunLahirWali"
                                placeholder="Tahun Lahir Wali"maxlength="4"></td>
                        </tr>
                       
                        <tr>
                            <td>
                                <label for="AlamatWali" class="col-sm-2 col-form-label">Alamat Wali</label>
                            </td>
                            <td>
                                <input type="AlamatWali" class="form-control"
                                id="AlamatWali"value="{{ $siswa->AlamatWali }}" name="AlamatWali"
                                placeholder="Alamat Wali"maxlength="30">

                            </td>
                            <td>
                                <label for="NomorTelephoneWali" class="col-sm-2 col-form-label">Nomor Telepon
                                    Wali</label>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="NomorTelephoneWali"
                                name="NomorTelephoneWali" placeholder="Nomor Telfon"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13"
                                value="{{ $siswa->NomorTelephoneWali }}">
                            </td>
                            <td>
                                <label for="AgamaWali" class="col-sm-2 col-form-label">Agama Wali</label>
                            </td>
                            <td>
                                <input type="AgamaWali" class="form-control" id="AgamaWali"
                                value="{{ $siswa->AgamaWali }}"name="AgamaWali"
                                placeholder="Agama Wali"maxlength="10">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="PendidikanTerakhirWali" class="col-sm-2 col-form-label">Pendidikan
                                    Terakhir
                                    Wali</label>
                            </td>
                            <td>
                                <input type="PendidikanTerakhirWali" class="form-control"
                                value="{{ $siswa->PendidikanTerakhirWali }}"id="PendidikanTerakhirWali"
                                name="PendidikanTerakhirWali"
                                placeholder="Pendidikan Terakhir Wali"maxlength="12">

                            </td>
                            <td>
                                <label for="PekerjaanWali" class="col-sm-2 col-form-label">Pekerjaan Wali</label>

                            </td>
                            <td>
                                <input type="PekerjaanWali" class="form-control"
                                value="{{ $siswa->PekerjaanWali }}"id="PekerjaanWali" name="PekerjaanWali"
                                placeholder="Pekerjaan Wali"maxlength="20">
                            </td>
                            <td>
                                <label for="WaliPenghasilan" class="col-sm-2 col-form-label">Penghasilan Wali</label>
                            </td>
                            <td>
                                <input type="WaliPenghasilan" class="form-control" id="WaliPenghasilan"
                                value="{{ $siswa->WaliPenghasilan }}"name="WaliPenghasilan"
                                placeholder="Penghasilan Wali"maxlength="30">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="StatusHubunganWali" class="col-sm-2 col-form-label">Status Hubungan
                                    Wali</label>
    
                            </td>
                            <td>
                                <input type="StatusHubunganWali" class="form-control"
                                id="StatusHubunganWali"value="{{ $siswa->StatusHubunganWali }}"
                                name="StatusHubunganWali" placeholder="Status Hubungan Wali"maxlength="12">

                            </td>
                            <td>
                                <label for="MenerimaBeasiswaDari" class="col-sm-2 col-form-label">Menerima Beasiswa
                                    Dari</label>
    
                            </td>
                            <td>
                                <input type="MenerimaBeasiswaDari" class="form-control"
                                id="MenerimaBeasiswaDari"value="{{ $siswa->MenerimaBeasiswaDari }}"
                                name="MenerimaBeasiswaDari" placeholder="Menerima Beasiswa Dari"maxlength="30">

                            </td>
                            <td>
                                <label for="TahunMeninggalkanSekolah" class="col-sm-2 col-form-label">Tahun
                                    Meninggalkan
                                    Sekolah</label>
                            </td>
                            <td>
                                <input type="date" class="form-control"
                                id="TahunMeninggalkanSekolah"value="{{ $siswa->TahunMeninggalkanSekolah }}"
                                name="TahunMeninggalkanSekolah" placeholder="Tahun Meninggalkan Sekolah"></td>
                           
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="AlasanSebab" class="col-sm-2 col-form-label">Alasan Sebab</label>


                            </td>
                            <td>
                                <input type="AlasanSebab" class="form-control" id="AlasanSebab"
                                name="AlasanSebab"value="{{ $siswa->AlasanSebab }}"
                                placeholder="Alasan Sebab"maxlength="20">

                            </td>
                            <td>
                                <label for="TamatBelajarTahun" class="col-sm-2 col-form-label">Tamat Belajar
                                    Tahun</label>
    
                            </td>
                            <td>
                                <input type="TamatBelajarTahun" class="form-control"
                                id="TamatBelajarTahun"value="{{ $siswa->TamatBelajarTahun }}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="TamatBelajarTahun"
                                placeholder="Tamat Belajar SMA Tahun"maxlength="4">

                            </td>
                            <td>
                                <label for="TanggalNomorSTTB" class="col-sm-2 col-form-label">Tanggal Nomor
                                    STTB</label>
    
                            </td>
                            <td>
                                <input type="date" class="form-control"value="{{ $siswa->TanggalNomorSTTB }}"
                                id="TanggalNomorSTTB" name="TanggalNomorSTTB" placeholder="Tanggal Nomor STTB">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="InformasiLain" class="col-sm-2 col-form-label">Informasi Lain</label>

                            </td>
                            <td>
                                <input type="InformasiLain" class="form-control" id="InformasiLain"
                                value="{{ $siswa->InformasiLain }}"name="InformasiLain"
                                placeholder="Informasi Lain" maxlength="30">

                            </td>
                        
                        </tr>
                       
                      
        </tbody>
        </table>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" onclick="window.location.href = '/siswaall'" class="btn btn-danger">Kembali</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#showPasswordBtn').on('click', function() {
                var passwordInput = $('#password');
                var passwordIcon = $(this).find('i');
                if (passwordInput.attr('disabled') === 'password') {
                    passwordInput.attr('disabled', 'text');
                    passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('disabled', 'password');
                    passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
    <script>
        // Ambil elemen-elemen yang dibutuhkan dari DOM
        const passwordInput = document.getElementById('password');
        const updatePasswordCheckbox = document.getElementById('updatePasswordCheckbox');

        // Tambahkan event listener pada checkbox untuk mengatur keadaan input password
        updatePasswordCheckbox.addEventListener('change', function() {
            // Jika checkbox dicentang, aktifkan input password
            // Jika tidak dicentang, nonaktifkan dan reset nilai password
            if (updatePasswordCheckbox.checked) {
                passwordInput.removeAttribute('disabled');
            } else {
                passwordInput.setAttribute('disabled', 'disabled');
                passwordInput.value = '';
            }
        });

        // Tambahkan event listener pada formulir untuk mengatur pengiriman data
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            // Jika checkbox tidak dicentang, hapus elemen input password dari data yang akan dikirimkan
            if (!updatePasswordCheckbox.checked) {
                event.preventDefault(); // Mencegah pengiriman formulir
                passwordInput.removeAttribute('name');
            }
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("myForm").addEventListener("submit", function(event) {
                var inputs = document.querySelectorAll(".form-control");
                var isValid = true;
                inputs.forEach(function(input) {
                    if (input.value.trim() === "") {
                        input.classList.add("invalid");
                        input.nextElementSibling.style.display = "block";
                        isValid = false;
                    } else {
                        input.classList.remove("invalid");
                        input.nextElementSibling.style.display = "none";
                    }
                });
                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endsection --}}



{{-- <script>
 function validateForm() {
        var nomorInduk = document.getElementById("NomorInduk").value;
        var nomorIndukInput = document.getElementById("NomorInduk");

        if (nomorInduk.trim() == "") {
            document.getElementById("NomorIndukError").style.display = "block";
            // Tambahkan class "invalid" jika validasi gagal
            nomorIndukInput.classList.add("invalid");
            return false;
        } else {
            document.getElementById("NomorIndukError").style.display = "none";
            // Hapus class "invalid" jika validasi berhasil
            nomorIndukInput.classList.remove("invalid");
            return true;
        }
    }
</script> --}}
