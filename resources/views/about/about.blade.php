<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/Shield_Logos__SMAK_KESUMA (1).ico') }}" type="image/ico" />
    <title>Kesuma-GO | About</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}" rel="stylesheet">
    <style>
        /* Gaya Tambahan */
        .btn-social {
            margin: 5px;
        }
        body {
            background-image: url("../../images/DSC00004.jpg");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .profile-view {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.7); /* Warna latar belakang elemen */
        }

        @media (max-width: 768px) {
            .profile-view {
                padding: 10px;
            }
        }
    </style>
</head>

<br>
<br>
<br>
<body class="nav-md">
    <div class="container">
        <div class="center-content">
            <div class="profile-view">
                <h2 class="brief text-center"><i>Web Developer</i></h2>
                <hr>
                <div class="text-center">
                    <img src="{{ asset('images/Screenshot 2023-06-22 104103.jpg_341x340.jpg') }}" alt="" class="img-fluid">
                    <hr>
                </div>
                <h2 class="text-center">Christopher Edwin Sirait S.Kom.</h2>
                <hr>
                <p class="text-center"><strong>About: </strong>Universitas Pewahyu Rakyat / Teknik 19 / Teknologi Informasi 19</p>
                <hr>
                <h3>
                    <p class="text-center">
                        <strong>Pesan: </strong>Dari KESUMA, Untuk KESUMA.
                    </p>
                </h3>
                <hr>
                <div class="text-center">
                    <button type="button" class="btn btn-dark btn-social" onclick="window.open('https://instagram.com/edwnsirait?igshid=ZDc4ODBmNjlmNQ==', '_blank')">
                        <i class="fab fa-instagram"></i>
                    </button>
                    
                    <button type="button" class="btn btn-dark btn-social" onclick="window.open('https://t.me/edwnsirait', '_blank')">
                        <i class="fab fa-telegram"></i>
                    </button>
                </div>
                <div class="text-left">
                    <button type="button" onclick="window.location.href='{{ url('/') }}'" class="btn btn-danger">Kembali</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
    <script src="{{ asset('build/js/custom.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/emoji-css@3.0.1">
</body>
</html>
