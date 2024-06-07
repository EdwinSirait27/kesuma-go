@extends('index')
@section('title', 'Kesuma-GO | Edit Password')
@section('content')
<style>
    .dashboard_graph {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .input-group-append button {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn {
        margin-right: 10px;
    }

    @media (max-width: 768px) {
        .col-md-6 {
            width: 100%;
        }
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
.col-form-label
{
    display: block;
    margin-bottom: 5px;
    font-size: 16px;
    color: #333; /* Warna teks label */
}
</style>
     <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard_graph">
                    <h1><i class="fa fa-cogs" style="margin-right: 10px;"></i>Edit |<small> Password</small></h1>
                    <hr>
                    <form method="POST" id="editPasswordForm" action="{{ route('editpasssiswa.updatee') }}">
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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="col-form-label">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="username"
                                        value="{{ old('username', auth()->user()->akunsiswa->username) }}" maxlength="50"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Perbarui Password" maxlength="12" minlength="11"
                                            
                                            {{ old('updatePassword') ? '' : 'disabled' }}>
                                        <div id="warning-message" class="alert" style="display:none;">Spasi tidak
                                            diperbolehkan!</div>

                                        <div class="input-group-append">
                                            <button type="button" id="showPasswordBtn" class="btn btn-secondary"
                                                onclick="togglePasswordVisibility()">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="updatePassword" name="updatePassword" value="1"
                                        onchange="togglePasswordField(this)">
                                    <label for="updatePassword">Perbarui Password</label>
                                    <small id="info_txt_namakelas" class="form-text text-muted" style="color: red !important;">*Centang terlebih dahulu jika anda ingin perbarui password</small>
                                    <small id="info_txt_namakelas" class="form-text text-muted" style="color: red !important;">*Maksimal 12 Karakter Bebas bebas</small>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="submitBtn" class="btn btn-primary">Update</button>
                                <button type="button" onclick="window.location.href = '/editprofilesiswa'"
                                    class="btn btn-danger">Kembali</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
    </script>
     <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            event.preventDefault();
            var passwordValue = document.getElementById('password').value;
            Swal.fire({
                title: 'Apakah Anda yakin dengan password ?'     +  passwordValue ,
                text: "Anda tidak dapat mengembalikan perubahan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('editPasswordForm').submit();
                }
            });
        });

        function goBack() {
            window.history.back();
        }
    </script>
      <script>
        document.getElementById('password').addEventListener('keydown', function(event) {
            if (event.key === ' ') {
                event.preventDefault();
                document.getElementById('warning-message').style.display = 'block';
            } else {
                document.getElementById('warning-message').style.display = 'none';
            }
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
        #info_txt_namakelas {
            color: red !important;
        }

    </style>
      <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h1><i class="fa fa-cogs" style="margin-right: 10px;"></i>Edit |<small> Password</small></h1>
            <hr>
            <form method="POST"id="editPasswordForm" action="{{ route('editpasssiswa.updatee') }}">
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
                                    value="{{ old('username', auth()->user()->akunsiswa->username) }}" maxlength="50"
                                    readonly></td>
                           
                                    <td>
                                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" maxlength="12" value="{{ old('password', auth()->user()->akunsiswa->password) }}" {{ old('updatePassword') ? '' : 'disabled' }}>
                                            <div id="warning-message" class="alert" style="display:none;">Spasi tidak diperbolehkan!</div>
                                          
                                            <div class="input-group-append">
                                                <button type="button" id="showPasswordBtn" class="btn btn-secondary" onclick="togglePasswordVisibility()">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4 offset-sm-2">
                                                <input type="checkbox" id="updatePassword" name="updatePassword" value="1" onchange="togglePasswordField(this)">
                                                <label for="updatePassword">Update Password</label>
                                                <small id="info_txt_namakelas" class="form-text text-muted">*Maksimal 12 Karakter bebas</small>
                                            </body>
                                            </div>
                                        </div>
                                     
                                    </td>
                                    
                    </tbody>
                </table>
                <button type="button" id="submitBtn" class="btn btn-primary">Update</button>
                <button type="button" onclick="window.location.href = '/editprofile'" class="btn btn-danger">Kembali</button>
               
            </form>
        </div>
        <hr>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
    </script>
     <script>
        document.getElementById('submitBtn').addEventListener('click', function(event) {
            event.preventDefault();
            var passwordValue = document.getElementById('password').value;
            Swal.fire({
                title: 'Apakah Anda yakin dengan password ?'     +  passwordValue ,
                text: "Anda tidak dapat mengembalikan perubahan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('editPasswordForm').submit();
                }
            });
        });

        function goBack() {
            window.history.back();
        }
    </script>
      <script>
        document.getElementById('password').addEventListener('keydown', function(event) {
            if (event.key === ' ') {
                event.preventDefault();
                document.getElementById('warning-message').style.display = 'block';
            } else {
                document.getElementById('warning-message').style.display = 'none';
            }
        });
    </script>
@endsection --}}
