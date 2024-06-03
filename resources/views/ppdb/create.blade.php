<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-male" style="margin-right: 4px; margin-top: 15px;"></i>Edit <small>Siswa</small></h3>
            <hr>
            <form method="POST" action="/ppdb-update2" enctype="multipart/form-data" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #ddd;"><label for="username"
                                class="col-form-label">Username</label></td>
                        <td style="border: 1px solid #ddd;">
                            <input type="username" class="form-control" id="username" name="username"
                                placeholder="Username" readonly>
                           
                        </td>
                        <td style="border: 1px solid #ddd;"><label for="password"
                            class="col-form-label">Password</label></td>
                    <td style="border: 1px solid #ddd;">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password" maxlength="12" disabled>
                            <div class="input-group-append">
                                <button type="button" id="showPasswordBtn" class="btn btn-secondary">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="updatePasswordCheckbox"
                                    name="updatePasswordCheckbox">
                                <label class="form-check-label" for="updatePasswordCheckbox">Update
                                    Password</label>
                            </div>
                        </div>
                        <h8 style="color: red;">*Maksimal 12 Karakter bebas</h8>
                    </td>
                           
                          
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd;"><label for="NamaLengkap" class="col-form-label">Nama
                                Lengkap</label></td>
                        <td style="border: 1px solid #ddd;"><input type="text" class="form-control"
                                id="NamaLengkap" name="NamaLengkap" placeholder="Nama Lengkap" maxlength="30"
                                required oninput="validateInput(this)"></td>
                                <td style="border: 1px solid #ddd;"><label for="NISN"
                                    class="col-form-label">NISN</label></td>
                            <td style="border: 1px solid #ddd;"><input type="text" class="form-control"
                                    id="NISN" name="NISN" placeholder="NISN"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="16" required>
                            </td>
                           
                           
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd;"><label for="JenisKelamin" class="col-form-label">Jenis
                                Kelamin</label></td>
                        <td style="border: 1px solid #ddd;">
                            <select class="form-control form-control select-field" id="JenisKelamin"
                                name="JenisKelamin" required>
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </td>
                        <td style="border: 1px solid #ddd;"><label for="TanggalLahir" class="col-form-label">Tanggal
                            Lahir</label></td>
                    <td style="border: 1px solid #ddd;"><input type="date" class="form-control"
                            id="TanggalLahir" name="TanggalLahir" placeholder="Tanggal Lahir" required></td>
                          
                           
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd;"><label for="NomorTelephone" class="col-form-label">Nomor
                                Telepon</label></td>
                        <td style="border: 1px solid #ddd;"><input type="text" class="form-control"
                                id="NomorTelephone" name="NomorTelephone" placeholder="Nomor Telepon"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="13" required>
                        </td>
                            <td style="border: 1px solid #ddd;"><label for="Email"
                                    class="col-form-label">Email</label></td>
                            <td style="border: 1px solid #ddd;"><input type="email" class="form-control"
                                    id="Email" name="Email" placeholder="Email" maxlength="40" required></td>
                           
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd;"><label for="Alamat"
                                class="col-form-label">Alamat</label></td>
                        <td style="border: 1px solid #ddd;"><input type="text" class="form-control"
                                id="Alamat" name="Alamat" placeholder="Alamat" maxlength="50" required></td>
                            <td style="border: 1px solid #ddd;"><label for="Agama"
                                class="col-form-label">Agama</label></td>
                        <td style="border: 1px solid #ddd;">
                            <select class="form-control select-field" id="Agama" name="Agama" required>
                                <option value="" selected disabled>Pilih Agama</option>
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
                            <td style="border: 1px solid #ddd;"><label for="AsalSMP" class="col-form-label">Asal
                                SMP</label></td>
                        <td style="border: 1px solid #ddd;"><input type="text" class="form-control"
                                id="AsalSMP" name="AsalSMP" placeholder="Asal SMP" maxlength="30" required>
                        </td>
                        <td style="border: 1px solid #ddd;"><label for="NomorTelephoneAyah"
                                class="col-form-label">Nomor Telepon Ayah</label></td>
                        <td style="border: 1px solid #ddd;"><input type="text" class="form-control"
                                id="NomorTelephoneAyah" name="NomorTelephoneAyah"
                                placeholder="Nomor Telepon Ayah"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="13" required>
                        </td>
                          
                           
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd;"><label for="NamaAyah" class="col-form-label">Nama
                                Ayah</label></td>
                        <td style="border: 1px solid #ddd;"><input type="text" class="form-control"
                                id="NamaAyah" name="NamaAyah" placeholder="Nama Ayah" maxlength="30" required>
                        </td>
                            <td style="border: 1px solid #ddd;"><label for="cita" class="col-form-label">Cita - Cita
                                </label></td>
                        <td style="border: 1px solid #ddd;"><input type="text" class="form-control"
                                id="cita" name="cita" placeholder="Cita - Cita" maxlength="30" required>
                        </td>

                           
                            
                        </tr>
                        <tr>
                            <td style="border: 1px solid #ddd;"><label for="foto" class="col-form-label">Foto
                                Siswa</label></td>
                        <td style="border: 1px solid #ddd;">
                            <input type="file" class="form-control" id="foto" name="foto">
                        </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      
                       
                        <button type="button" onclick="window.location.href = '/ppdb'"
                        class="btn btn-danger">Kembali</button>
                       
                    </div>
                </div>
                <div class="row">
                    <h8 style="color: red;">*Kalau Mengedit Data atau Menambah Data, Jangan Lupa Untuk Mengisi CheckBox
                        dan Mengganti Passwordnya</h8>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    
</script>
<style>
    /* Contoh penyesuaian CSS */
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
</style>
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
            event.preventDefault(); 
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
{{-- <div class="form-group row">
    <label for="JenisKelamin" class="col-sm-2 col-form-label label-input">Jenis Kelamin</label>
    <div class="col-sm-4">
        <select class="form-control form-control select-field" id="JenisKelamin" name="JenisKelamin"
            required>
            <option value="" selected disabled>Pilih Jenis Kelamin</option>
            <option value="Laki-Laki">Laki-Laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>

    </div>

    <label for="TanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
    <div class="col-sm-4">
        <input type="date" class="form-control" id="TanggalLahir" name="TanggalLahir"
            placeholder="Tanggal Lahir" required>
    </div>
</div>
<div class="form-group row">
    <label for="Agama" class="col-sm-2 col-form-label label-input">Agama</label>
    <div class="col-sm-4">
        <select class="form-control select-field" id="Agama" name="Agama" required>
            <option value="" selected disabled>Pilih Agama</option>
            <option value="Katolik">Katolik</option>
            <option value="Kristen Protestan">Kristen Protestan</option>
            <option value="Hindu">Hindu</option>
            <option value="Buddha">Buddha</option>
            <option value="Konghucu">Konghucu</option>
            <option value="Islam">Islam</option>
        </select>

    </div>

        <label for="NomorTelephone" class="col-sm-2 col-form-label">Nomor Telepon</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="NomorTelephone" name="NomorTelephone"
                placeholder="Nomor Telephone"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>

        </div>
        </div>
        <div class="form-group row">
        <label for="Email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-4">
            <input type="Email" class="form-control" id="Email" name="Email"
                placeholder="Email"maxlength="40" required>
        </div>
   
       
    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-4">
        <input type="Alamat" class="form-control" id="Alamat" name="Alamat" placeholder="Alamat"
            maxlength="50" required>
 
            
        </div>
        </div>
        <div class="form-group row">
    <label for="AsalSMP" class="col-sm-2 col-form-label">Asal SMP</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="AsalSMP" name="AsalSMP" placeholder="Asal SMP"
            maxlength="30" required>
    
    </div>
    
    <label for="NomorTelephoneAyah" class="col-sm-2 col-form-label">Nomor Telepon Ayah</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="NomorTelephoneAyah" name="NomorTelephoneAyah"
            placeholder="NomorTelephoneAyah"
            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>

    </div>
    </div>
    <div class="form-group row">
    <label for="NamaAyah" class="col-sm-2 col-form-label">Nama Ayah</label>
    <div class="col-sm-4">
        <input type="NamaAyah" class="form-control" id="NamaAyah" name="NamaAyah"
            placeholder="Nama Ayah"maxlength="30" required>

</div>


    <label for="username" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-4">
        <input type="username" class="form-control" id="username" name="username"
            placeholder="Username">
        <div class="row">
            <h8 style="color: red;">*Kalau Mengedit Data Username Jangan Dirubah</h8>
        </div>
    </div>
    <div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-4">
        <div class="input-group">
            <input type="password" class="form-control" name="password" id="password"
                placeholder="Password" maxlength="12" disabled>
            <div class="input-group-append">
                <button type="button" id="showPasswordBtn" class="btn btn-secondary">
                    <i class="fa fa-eye"></i>
                </button>
            
        </div>
        </div>
        <div class="col-sm-4">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="updatePasswordCheckbox"
                    name="updatePasswordCheckbox">
                <label class="form-check-label" for="updatePasswordCheckbox">Update Password</label>
            </div>
        </div>
        <h8 style="color: red;">*Maksimal 12 Karakter bebas</h8>
    </div>



    <div class="form-group row">
<label for="foto" class="col-sm-2 col-form-label">Foto Siswa</label>
<div class="col-sm-4">
    <input type="file" class="form-control" id="foto" name="foto">
</div>
</div>
</div> --}}
