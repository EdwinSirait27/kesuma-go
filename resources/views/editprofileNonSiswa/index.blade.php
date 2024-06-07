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
            border-color: #28a745;
            /* Hijau */
        }

        input:invalid {
            border-color: #dc3545;
            /* Merah */
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
            border: 1px solid #ccc;
            /* Warna border input */
            border-radius: 5px;
            transition: border-color 0.3s ease;
            /* Transisi warna border */
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            /* Warna border saat input difokuskan */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            /* Efek bayangan saat input difokuskan */
        }

        input[type="text"]:hover,
        input[type="password"]:hover {
            border-color: #66afe9;
            /* Warna border saat input dihover */
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 16px;
            color: #333;
            /* Warna teks label */
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
                            <a href="/editpassnonsiswa" class="btn btn-success">Ganti Password</a>
                        </h3>
                        
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <h4>Nama Siswa : {{ $siswa->NamaLengkap }}</h4>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('editprofileNonSiswa.update') }}" enctype="multipart/form-data">
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
                                    value="{{ old('username', auth()->user()->akunsiswa->username) }}" maxlength="50"
                                    disabled>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="NamaLengkap">Nama Lengkap</label>
                                <input type="text" class="form-control" name="NamaLengkap" placeholder="Nama Lengkap"
                                    value="{{ old('NamaLengkap', $siswa->NamaLengkap) }}" maxlength="50" disabled>
                            </div>

                            <!-- Continue for other fields similarly -->


                            <div class="form-group col-md-6">
                                <label for="NISN"></label>
                                
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Email">Email</label>
                                <input type="text" class="form-control" name="Email" placeholder="Email" maxlength="30"
                                    value="{{ old('Email', auth()->user()->siswa->Email) }}" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="JenisKelamin">Jenis Kelamin</label>
                                <select class="form-control" id="JenisKelamin" name="JenisKelamin" disabled>
                                    <option value="Laki-Laki"
                                        {{ old('JenisKelamin', auth()->user()->siswa->JenisKelamin) == 'Laki-Laki' ? 'selected' : '' }}>
                                        Laki-Laki</option>
                                    <option value="Perempuan"
                                        {{ old('JenisKelamin', auth()->user()->siswa->JenisKelamin) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="text">Alamat</label>
                                <input type="text" class="form-control" name="Alamat" placeholder="Alamat"
                                    maxlength="50" value="{{ old('Alamat', auth()->user()->siswa->Alamat) }}" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="TempatLahir">Tempat Lahir</label>
                                <input type="text" class="form-control" name="TempatLahir" placeholder="Tempat Lahir"
                                    maxlength="30" value="{{ old('TempatLahir', auth()->user()->siswa->TempatLahir) }}"
                                    oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');" disabled>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="TanggalLahir">Tanggal Lahir</label>
                                <input id="TanggalLahir" class="form-control" name="TanggalLahir"
                                    placeholder="Tanggal Lahir" type="date"
                                    value="{{ old('TanggalLahir', auth()->user()->siswa->TanggalLahir) }}" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="text">Nomor Telephone</label>
                                <input type="text" class="form-control" name="NomorTelephone"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13"
                                    placeholder="Nomor Telephone"value="{{ old('NomorTelephone', auth()->user()->siswa->NomorTelephone) }}"
                                    disabled>


                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="Agama">Agama</label>
                                <select class="form-control" id="Agama" name="Agama" disabled>
                                    <option value="Katolik"
                                        {{ old('Agama', auth()->user()->siswa->Agama) == 'Katolik' ? 'selected' : '' }}>
                                        Katolik</option>
                                    <option value="Kristen Protestan"
                                        {{ old('Agama', auth()->user()->siswa->Agama) == 'Kristen Protestan' ? 'selected' : '' }}>
                                        Kristen Protestan</option>
                                    <option value="Hindu"
                                        {{ old('Agama', auth()->user()->siswa->Agama) == 'Hindu' ? 'selected' : '' }}>Hindu
                                    </option>
                                    <option value="Budha"
                                        {{ old('Agama', auth()->user()->siswa->Agama) == 'Budha' ? 'selected' : '' }}>Budha
                                    </option>
                                    <option value="Konghucu"
                                        {{ old('Agama', auth()->user()->siswa->Agama) == 'Konghucu' ? 'selected' : '' }}>
                                        Konghucu</option>
                                    <option value="Islam"
                                        {{ old('Agama', auth()->user()->siswa->Agama) == 'Islam' ? 'selected' : '' }}>Islam
                                    </option>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="text">Asal SMP</label>
                                <input type="text" class="form-control" name="AsalSMP"
                                    maxlength="40"placeholder="Asal SMP"
                                    value="{{ old('AsalSMP', auth()->user()->siswa->AsalSMP) }}"required>

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="text">Nama Ayah</label>
                                <input type="text" class="form-control" name="NamaAyah"maxlength="30"
                                placeholder="Nama Ayah"value="{{ old('NamaAyah', auth()->user()->siswa->NamaAyah) }}" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');" required>



                            </div>
                          
                                <div class="form-group col-md-6">
                                <label for="text">Nomor Telephone Ayah</label>
                                <input type="NomorTelephoneAyah" class="form-control" id="NomorTelephoneAyah"
                                    maxlength="13" name="NomorTelephoneAyah"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    placeholder="Nomor Telephone Ayah"value="{{ old('NomorTelephoneAyah', auth()->user()->siswa->NomorTelephoneAyah) }}"
                                    required>


                            </div>
                        </div>

                        <div class="form-row">
                         
                                <div class="form-group col-md-6">
                                <label for="text">Cita - Cita</label>
                                <input type="cita" class="form-control" id="cita" name="cita"
                                    placeholder="Cita - Cita"value="{{ old('cita', auth()->user()->siswa->cita) }}">



                            </div>



                            <div class="form-group col-md-6">
                                <label for="foto">Upload Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto">

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                @if ($siswa->foto)
                                    <img src="{{ asset('storage/fotosiswa/' . $siswa->foto) }}" alt="Foto Profil"
                                        width="200" height="300">
                                @else
                                    <h2>Belum ada foto profil</h2>
                                @endif
                                <div class="row">
                                    <h8 style="color: red;">*Type File Gambar JPEG, Max 1MB </h8>

                                </div>

                            </div>
                        </div>


                        <br>

                        {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <span class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                            Perbarui
                        </button>

                      
                        {{-- <button type="button" onclick="goBack()" class="btn btn-danger">Kembali</button> --}}
                        <a href="/NonSiswaBeranda" class="btn btn-danger">Kembali</a>
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
