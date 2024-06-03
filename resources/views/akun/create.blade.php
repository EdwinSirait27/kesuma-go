<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <style>
                .col-form-label {
                    font-size: 18px; /* Ganti dengan ukuran font yang Anda inginkan */
                }
            </style>
             <h2><i class="fa fa-users" style="margin-right: 10px; "></i>Edit Data Akun<small>Tenaga Pengajar</small></h2>
            <hr>
            <form method="POST" action="/akun-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="txt_Nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txt_Nama" name="txt_Nama" placeholder="Nama" maxlength="50"readonly>
                    </div>
                    <label for="txt_TempatLahir" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required maxlength="30"readonly>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-4 input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" maxlength="12" required>
                        
                        <div class="input-group-append">
                            <button type="button" id="showPasswordBtn" class="btn btn-secondary">
                                <i class="fa fa-eye"></i>
                            </button>
                     
                    </div>
                    
                        <div class="col-sm-4 offset-sm-2">
                            <h8 style="color: red;">*Maksimal 12 Karakter bebas</h8>
                
                    </div>
                </div>
               
                  <label for="txt_StatusPegawai" class="col-sm-2 col-form-label label-input">Hak Akses</label>
                  <div class="col-sm-4">
                      <select class="form-control select-field" id="hakakses" name="hakakses" required>
                          <option value="" selected disabled>Pilih Hak Akses</option>
                          <option value="Admin">Admin</option>
                          <option value="Guru">Guru</option>
                          <option value="KepalaSekolah">KepalaSekolah</option>
                          <option value="Kurikulum">Kurikulum</option>
                      </select>
                  </div>
              </div>
      
                <!-- Tambahkan sisa input fields sesuai kebutuhan Anda -->
  
                <div class="form-group row">
                    <div class="col-sm-4 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" onclick="window.location.href = '/guruall'" class="btn btn-danger">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
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
  