<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/Shield_Logos__SMAK_KESUMA (1).ico') }}" type="image/ico" />
    <title>Kesuma-GO | Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <style>
        body {
            background-image: url("{{ asset('images/DSC00004.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 10px;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            margin-top: -50px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-image {
            height: 70px;
            margin-bottom: 10px;
        }

        .logo-text {
            font-size: 30px;
            text-decoration: none;
            color: #000000;
            display: block;
        }

        .card {
            border: 2px solid #fff;
            box-shadow: 0px 0px 15px 0px rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .card-body {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 0 0 10px 10px;
        }

        .input-group-text {
            background-color: #007BFF;
            border-color: #007BFF;
            color: #fff;
        }

        .btn-primary {
            background-color: #007BFF;
            border-color: #007BFF;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .mb-1 a {
            color: #007BFF;
        }

        @media (max-width: 576px) {
            .logo-text {
                font-size: 24px;
            }
            .logo-image {
                height: 50px;
            }
        }
    </style>
</head>
<body class="hold-transition login-page">
    @if (isset($error))
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endif
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="login-box">
                <div class="logo-container">
                    <img src="{{ asset('images/tes.ico') }}" alt="Logo" class="logo-image">
                    <a href="about" class="logo-text"><b>Kesuma</b>-GO</a>
                </div>
                <form action="{{ route('postlogin') }}" method="post">
                    @csrf
                      @error('username')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" maxlength="12"
                               
                               value="{{ old('username') ?: session('remembered_username') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                      @error('password')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="Password" maxlength="12" oninput="this.value = this.value.replace(/\s/g, '');"
                               required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="showPassword">
                                <label for="showPassword">
                                    Show Password
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </div>
                </form>
                @foreach($ppdbs as $link)
                    @if(now()->between($link->start_date, $link->end_date))
                        <a href="{{ $link->url }}" class="btn btn-dark btn-block mt-3">Daftar PPDB?</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: '{{ session('warning') }}',
            });
        </script>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#showPassword').change(function() {
                var passwordField = $('#password');
                var passwordFieldType = passwordField.attr('type');
                passwordField.attr('type', passwordFieldType === 'password' ? 'text' : 'password');
            });
        });
    </script>
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/Shield_Logos__SMAK_KESUMA (1).ico') }}" type="image/ico" />
    <title>Kesuma-GO | Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <style>
        body {
            background-image: url("{{ asset('images/DSC00004.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 10px;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            margin-top: -50px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-image {
            height: 70px;
            margin-bottom: 10px;
        }

        .logo-text {
            font-size: 30px;
            text-decoration: none;
            color: #000000;
            display: block;
        }

        .card {
            border: 2px solid #fff;
            box-shadow: 0px 0px 15px 0px rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .card-body {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 0 0 10px 10px;
        }

        .input-group-text {
            background-color: #007BFF;
            border-color: #007BFF;
            color: #fff;
        }

        .btn-primary {
            background-color: #007BFF;
            border-color: #007BFF;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .mb-1 a {
            color: #007BFF;
        }

        @media (max-width: 576px) {
            .logo-text {
                font-size: 24px;
            }
            .logo-image {
                height: 50px;
            }
        }
    </style>
</head>
<body class="hold-transition login-page">
  
    @if (isset($error))
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endif
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="login-box">
                <div class="logo-container">
                    <img src="{{ asset('images/tes.ico') }}" alt="Logo" class="logo-image">
                    <a href="about" class="logo-text"><b>Kesuma</b>-GO</a>
                </div>
                <form action="{{ route('postlogin') }}" method="post">
                    @csrf
                    @error('username')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username" maxlength="12"
                               
                               value="{{ old('username') ?: session('remembered_username') }}" required>
                              
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                  
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="Password" maxlength="12" oninput="this.value = this.value.replace(/\s/g, '');"
                               required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="showPassword">
                                <label for="showPassword">
                                    Show Password
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </div>
                </form>
                @foreach($ppdbs as $link)
                    @if(now()->between($link->start_date, $link->end_date))
                        <a href="{{ $link->url }}" class="btn btn-dark btn-block mt-3">Daftar PPDB?</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: '{{ session('warning') }}',
            });
        </script>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#showPassword').change(function() {
                var passwordField = $('#password');
                var passwordFieldType = passwordField.attr('type');
                passwordField.attr('type', passwordFieldType === 'password' ? 'text' : 'password');
            });
        });
    </script>
</body>
</html> --}}
