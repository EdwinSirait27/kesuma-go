<!-- resources/views/daftar.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../images/Shield_Logos__SMAK_KESUMA (1).ico" type="image/ico" />
    <title>Kesuma-GO | Daftar PPDB</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="../../AdminLTE/plugins/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../../AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel="stylesheet">
    <link href="../../AdminLTE/dist/css/adminlte.min.css" rel="stylesheet">

</head>
{{-- <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/Shield_Logos__SMAK_KESUMA.ico') }}" type="image/ico" />
    <title>Kesuma-GO | Daftar PPDB</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> <!-- Custom CSS -->
</head> --}}
<style>
    /* public/css/custom.css */
    body {
        background-image: url("{{ asset('images/DSC00004.jpg') }}");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        /* tambahkan ini */
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: 'Source Sans Pro', sans-serif;
    }

    /* body {
        background-image: url("{{ asset('images/DSC00004.jpg') }}");
        background-size: cover;
        background-repeat: no-repeat;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;

        font-family: 'Source Sans Pro', sans-serif;
    } */

    .login-page {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    .logo-container {
        text-align: center;
    }

    .logo-image {
        width: 70px;
        margin-bottom: 10px;

    }

    .logo-text {
        font-size: 30px;
        text-decoration: none;
        color: #000000;

    }

    .card {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .custom-file-label::after {
        content: "Browse";
    }

    .input-group-text {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    @media (max-width: 768px) {
        .card {
            margin: 0 10px;
        }

        .logo-image {
            width: 80px;
        }
    }

    .text-info {
        color: red !important;
    }
</style>

<body class="hold-transition login-page">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-8 col-lg-6">
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="login-box">
                            <div class="logo-container text-center mb-4">
                                <img src="{{ asset('images/tes.ico') }}" alt="Logo" class="logo-image mb-2">
                                <a href="about" class="logo-text"><b>DAFTAR</b>-PPDB</a>
                            </div>
                            <form method="POST" action="/daftar-update" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="txt_id" id="txt_id" value="0">

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Username" minlength="11" maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" >
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <small class="text-info">*Numerik, Maksimal 12 Digit.</small>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input for="password" type="password" class="form-control" name="password"
                                                id="password" placeholder="Password" maxlength="12"
                                                oninput="this.value = this.value.replace(/\s/g, '');" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="togglePassword">
                                                    <span class="fas fa-eye" id="passwordToggleIcon"></span>
                                                </button>
                                            </div>

                                        </div>
                                        <small class="text-info">*Numerik, Maksimal 12 Digit.</small>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="NamaLengkap"
                                                id="NamaLengkap"
                                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"placeholder="Nama Lengkap"
                                                maxlength="50" required>


                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">

                                            <input type="text" class="form-control" name="NISN" id="NISN"
                                                placeholder="NISN"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="8"
                                                required>

                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-key"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input type="email" class="form-control" name="Email" id="Email"
                                            placeholder="Email" maxlength="40" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
                                     


                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <select class="custom-select" id="JenisKelamin"
                                                name="JenisKelamin"required>
                                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>


                                            <div class="input-group-append">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="Alamat" id="Alamat"
                                                placeholder="Alamat" required>


                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-database"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="TempatLahir"
                                                id="TempatLahir" placeholder="Tempat Lahir" maxlength="20"
                                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                                required>


                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-taxi"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="TanggalLahir"
                                                id="TanggalLahir" placeholder="Tanggal Lahir" required>


                                            <div class="input-group-append">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="NomorTelephone"
                                                id="NomorTelephone" placeholder="Nomor Telephone"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13"
                                                required>


                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-calculator"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <select class="custom-select" id="Agama" name="Agama" required>
                                                <option value="" selected disabled>Pilih Agama</option>
                                                <option value="Katolik">Katolik</option>
                                                <option value="Kristen Protestan">Kristen Protestan</option>
                                                <option value="Hindu">Hindu</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Konghucu">Konghucu</option>
                                                <option value="Islam">Islam</option>
                                            </select>


                                            <div class="input-group-append">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="AsalSMP" id="AsalSMP"
                                                placeholder="Sekolah Asal SMP" maxlength="40"
                                                oninput="this.value = this.value.replace(/[^A-Za-z0-9]/g, '');"
                                                required>


                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-graduation-cap"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="NamaAyah"
                                                id="NamaAyah" placeholder="Nama Orang Tua / Wali" maxlength="30"
                                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                                required>


                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="NomorTelephoneAyah"
                                                id="NomorTelephoneAyah" placeholder="Nomor Telephone Orang Tua / Wali"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13"
                                                required>


                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-calculator"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="cita" id="cita"
                                                placeholder="Cita-Cita" maxlength="30"
                                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                                required>


                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-plane"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="foto"
                                                    name="foto" onchange="previewImage()">
                                                <label class="custom-file-label" for="foto">Pas Foto 3x4</label>
                                            </div>
                                        </div>
                                        <small class="text-info">*Pas foto 3x4 JPG.</small>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <img id="preview" src="#" alt="Preview"
                                            style="max-width: 100%; max-height: 200px; display: none;">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="#" onclick="window.history.back();" class="btn btn-danger">
                                        <i class="fa fa-arrow-left"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      $(document).ready(function() {
                    $('form').submit(function(e) {
                        e.preventDefault();
            
                        var fotoInput = document.getElementById('foto');
                        if (fotoInput) {
                            var isValidFoto = fotoInput.files.length > 0 && fotoInput.files[0].type === 'image/jpeg';
                            if (!isValidFoto) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Unggah file foto dengan format JPG ya adik-adik!'
                                });
                                return;
                            }
            
                            var maxFileSize = 512 * 1024; // 512 KB
                            var fotoSize = fotoInput.files[0].size;
                            if (fotoSize > maxFileSize) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Ukuran file foto tidak boleh lebih dari 512 KB.'
                                });
                                return;
                            }
                        }
            
                        var usernameInput = document.getElementById('username').value;
                        if (!usernameInput) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Username harus diisi!'
                            });
                            return;
                        }
            
                        // Kirim permintaan AJAX untuk memeriksa keberadaan username
                        $.ajax({
                            url: '{{ route('check-username') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                username: usernameInput
                            },
                            success: function(response) {
                                if (response.exists) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Username sudah digunakan, silahkan gunakan yang lain.'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Sudah Yakin Belum?',
                                        text: "Tolong Ingat Username dan Password yang diinputkan ya adik-adik!, Di Screenshot saja ya",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Ya, Simpan!',
                                        cancelButtonText: 'Batal, Periksa Lagi'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $('form').unbind('submit').submit();
                                            Swal.fire({
                                                title: 'Success',
                                                text: 'Data berhasil disimpan!',
                                                icon: 'success',
                                                confirmButtonText: 'OK',
                                                timer: 5000
                                            });
                                        }
                                    });
                                }
                            }
                        });
                    });
                });


        const togglePasswordButton = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const passwordToggleIcon = document.getElementById('passwordToggleIcon');
        togglePasswordButton.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            passwordToggleIcon.classList.toggle('fa-eye-slash');
        });

        function previewImage() {
            const preview = document.getElementById('preview');
            const file = document.getElementById('foto').files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
</body>

</html>

{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/Shield_Logos__SMAK_KESUMA (1).ico') }}" type="image/ico" />
    <title>Kesuma-GO | Daftar PPDB</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}" rel="stylesheet">
</head>




<body class="hold-transition login-page">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="login-box">
                <div class="logo-container">
                    <img src="{{ asset('images/tes.ico') }}" alt="Logo" class="logo-image">
                    <a href="about" class="logo-text"><b>DAFTAR</b>-PPDB</a>
                </div>
                <form method="POST" action="/daftar-update" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="txt_id" id="txt_id" value="0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" minlength="11" maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <small class="text-info">*Numerik, Maksimal 12 Digit.</small>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImage()">
                                    <label class="custom-file-label" for="foto">Pas Foto 3x4</label>
                                </div>
                            </div>
                            <small class="text-info">*Pas foto 3x4 JPG.</small>
                        </div>
                        <div class="col-md-12 text-center mb-3">
                            <img id="preview" src="#" alt="Preview" style="max-width: 100%; max-height: 200px; display: none;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="#" onclick="window.history.back();" class="btn btn-danger btn-block">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html> --}}
