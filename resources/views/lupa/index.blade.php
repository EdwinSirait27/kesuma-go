<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/Shield_Logos__SMAK_KESUMA (1).ico" type="image/ico" />
  <title>Kesuma-GO | Lupa Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}">
  <style>
    body {
        background-image: url("../../images/DSC00004.jpg");
        background-size: cover;
        background-repeat: no-repeat;
    }

    .logo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        margin-top: 20px; 
    }

    .logo-image {
        height: 10px;
        margin-right: 10px;
    }

    .logo-text {
        font-size: 24px;
        text-decoration: none;
        color: #000;
    }

    .tooltip {
        position: absolute;
        display: none;
        background-color: rgba(0, 0, 0, 0.7);
        color: #fff;
        padding: 5px;
        font-size: 14px;
        border-radius: 3px;
        z-index: 9999;
    }

    .checkbox-container:hover .tooltip {
        display: block;
    }

    .center-content {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .profile-view {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        background: #fff;
        border-radius: 5px;
    }
  </style>
</head>
<body class="nav-md">
    <div class="container">
        <div class="center-content">
            <div class="profile-view">
                <h2 class="brief text-center"><i>Silahkan Menghubungi Operator Sekolah</i></h2>
                <hr>
                <div class="text-center">
                    <img src="images/user.png" alt="" class="img-fluid">
                    <hr>

                </div>

                <h2 class="text-center">Nama Admin</h2>
                <hr>
                <p class="text-center"><strong>No. Telephone: </strong>081263721637821</p>
                <hr>
                <h2 class="text-center">Nama Admin</h2>
<hr>
<!-- Add an <h2> element inside the <input> -->
    <div style="display: flex; align-items: center;">
        <input type="text" id="username" placeholder="Username" style="margin-right: 10px;" maxlength="12">
        <div class="text-left">
          <a href="#" class="btn btn-primary btn-sm" onclick="sendData(event)">
            <i class="fa fa-arrow-right"></i> Kirim
          </a>
        </div>
      </div
      <h8 style="color: red;">*Input Username Anda jika Anda Lupa Password</h8>
      <hr>
                <div class="text-left">
                    <a href="#" onclick="window.history.back();" class="btn btn-danger btn-sm">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>                
            </div>
        </div>
    </div>
    

      
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
      <script>
        function sendData(event) {
          event.preventDefault();
          
          const username = document.getElementById('username').value;
      
          Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin dengan Username ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
          }).then((result) => {
            if (result.isConfirmed) {
              // Mengirim data ke server
              const xhr = new XMLHttpRequest();
              const url = '{{ route("lupa.store") }}';
              const params = 'username=' + encodeURIComponent(username);
              
              xhr.open('POST', url, true);
              xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
              
              xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                  Swal.fire('Sukses', 'Data berhasil dikirim', 'success');
                }
              }
              
              xhr.send(params);
            }
          });
        }
      </script>
