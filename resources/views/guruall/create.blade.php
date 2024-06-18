
<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <style>
                .col-form-label {
                    font-size: 18px;
                }
            </style>
            <h3><i class="fa fa-eyedropper" style="margin-right: 10px; margin-top: 15px;"></i>Daftar <small>Guru</small>
            </h3>
            <hr>
            <form id="myForm" method="POST" action="/guruall-update" enctype="multipart/form-data"
                onsubmit="return simpan()">

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
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-4">
                        {{-- <input type="text" class="form-control" id="Nama" name="Nama" placeholder="Nama"
                            maxlength="50" required> --}}
                            <input type="text" class="form-control" name="Nama" placeholder="Nama Lengkap"
                                maxlength="50" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                              required>
                    </div>
                    <label for="TempatLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="TempatLahir" name="TempatLahir"
                            placeholder="Tempat Lahir" maxlength="30" required oninput="validateInput(this)"required>
                    </div>
                </div>
                <script>
                    function validateInput(inputElement) {
                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                    }
                </script>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="TanggalLahir" name="TanggalLahir" required>
                    </div>
                    <label for="Agama" class="col-sm-2 col-form-label label-input">Agama</label>
                    <div class="col-sm-4">
                        <select class="form-control select-field" id="Agama" name="Agama" required>
                            <option value="" selected disabled>Pilih Agama</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Kristen Protestan">Kristen Protestan</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Konghucu">Konghucu</option>
                            <option value="Islam">Islam</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="JenisKelamin" class="col-sm-2 col-form-label label-input">Jenis Kelamin</label>
                    <div class="col-sm-4">
                        <select class="form-control select-field" id="JenisKelamin" name="JenisKelamin" required>
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <label for="StatusPegawai" class="col-sm-2 col-form-label label-input">Status Pegawai</label>
                    <div class="col-sm-4">
                        <select class="form-control select-field" id="StatusPegawai" name="StatusPegawai" required>
                            <option value="" selected disabled>Pilih Status Pegawai</option>
                            <option value="GT">GT</option>
                            <option value="PNS YDP">PNS YDP</option>
                            <option value="GTT">GTT</option>
                            <option value="Honorer">Honorer</option>
                            <option value="PT">PT</option>
                            <option value="PTT">PTT</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="NipNips" class="col-sm-2 col-form-label">NIP/NIPS</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="NipNips" name="NipNips"
                            placeholder="Nip atau NIPS"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
                    </div>

                    <label for="Nuptk" class="col-sm-2 col-form-label">NUPTK</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="Nuptk" name="Nuptk"
                            placeholder="Nomor Unik Pendidik dan Ketenaga Kependidikan"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="Nik" name="Nik" placeholder="NIK"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>

                    </div>
                    <label for="Npwp" class="col-sm-2 col-form-label">NPWP</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="Npwp" name="Npwp" placeholder="NPWP"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="NomorSertifikatPendidik" class="col-sm-2 col-form-label">Nomor Sertifikat
                        Pendidik</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="NomorSertifikatPendidik"
                            name="NomorSertifikatPendidik" placeholder="Nomor Sertifikat Pendidik"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="20" required>
                    </div>
                    <label for="TahunSertifikasi" class="col-sm-2 col-form-label">Tahun Sertifikasi</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="TahunSertifikasi" name="TahunSertifikasi"
                            placeholder="Tahun Sertifikasi" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pangkatgt" class="col-sm-2 col-form-label">Pangkat</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="pangkatgt" name="pangkatgt"
                            placeholder="Pangkat"required>

                    </div>

                    <label for="jadwalkenaikanpangkat" class="col-sm-2 col-form-label">Jadwal Kenaikan Pangkat</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="jadwalkenaikanpangkat"
                            name="jadwalkenaikanpangkat" placeholder="Jadwal Kenaikan Pangkat"required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jadwalkenaikangaji" class="col-sm-2 col-form-label">Jadwal Kenaikan Gaji</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="jadwalkenaikangaji" name="jadwalkenaikangaji"
                            placeholder="Jadwal Kenaikan Gaji"required>

                    </div>

                    <label for="PangkatGolonganTerakhir" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-4">
                        {{-- <input type="PangkatGolonganTerakhir" class="form-control" id="PangkatGolonganTerakhir"
                            name="PangkatGolonganTerakhir" placeholder="Pangkat Golongan Terakhir"maxlength="30"
                            disabled> --}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="TMT" class="col-sm-2 col-form-label">TMT</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="TMT" name="TMT"
                            placeholder="Tanggal Mulai Tugas" required>

                    </div>

                    <label for="PendidikanAkhir" class="col-sm-2 col-form-label">Pendidikan Akhir</label>
                    <div class="col-sm-4">
                        <input type="PendidikanAkhir" class="form-control" id="PendidikanAkhir"
                            name="PendidikanAkhir" placeholder="Pendidikan Akhir"maxlength="5" required>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="TahunTamat" class="col-sm-2 col-form-label">Tahun Tamat</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="TahunTamat" name="TahunTamat"
                            placeholder="Tahun Tamat"required>

                    </div>

                    <label for="Jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col-sm-4">
                        <input type="Jurusan" class="form-control" id="Jurusan" name="Jurusan"
                            placeholder="Jurusan"maxlength="50" required>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="TugasMengajar" class="col-sm-2 col-form-label">Tugas Mengajar</label>
                    <div class="col-sm-4">
                        <input type="TugasMengajar" class="form-control" id="TugasMengajar" name="TugasMengajar"
                            placeholder="Tugas Mengajar"maxlength="50" required>

                    </div>

                    <label for="TugasTambahan" class="col-sm-2 col-form-label">Tugas Tambahan</label>
                    <div class="col-sm-4">
                        <input type="TugasTambahan" class="form-control" id="TugasTambahan" name="TugasTambahan"
                            placeholder="Tugas Tambahan"maxlength="50" required>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="JamPerMinggu" class="col-sm-2 col-form-label">Jam Per Minggu</label>
                    <div class="col-sm-4">
                        <input type="JamPerMinggu" class="form-control" id="JamPerMinggu" name="JamPerMinggu"
                            placeholder="Jam Per Minggu"maxlength="30" required>

                    </div>

                    <label for="TahunPensiun" class="col-sm-2 col-form-label">Tahun Pensiun</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="TahunPensiun" name="TahunPensiun"
                            placeholder="Tahun Pensiun"required>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="NomorTelephone" class="col-sm-2 col-form-label">Nomor Telephone</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="NomorTelephone" name="NomorTelephone"
                            placeholder="Nomor Telephone"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>
                    </div>
                    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-4">
                        <input type="Alamat" class="form-control" id="Alamat" name="Alamat"
                            placeholder="Alamat"maxlength="40" required>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="Email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="Email" name="Email"
                            placeholder="Email"maxlength="40" required>

                    </div>

                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="username" name="username"
       placeholder="Username"
       oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');" minlength="7" maxlength="12" required>
       <small style="color: red;">*Minimal 7 Karakter, Maksimal 12 Karakter bebas</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password"
       placeholder="Password" minlength="12" maxlength="12" oninput="this.value = this.value.replace(/\s/g, '');" disabled>
{{-- 
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password" maxlength="12" disabled> --}}
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
                                <label class="form-check-label" for="updatePasswordCheckbox">Buat Password</label>
                            </div>
                            <small style="color: red;">*Minimal 7 Karakter, Maksimal 12 Karakter bebas</small>
       
                        </div>
                    </div>


                    <label for="status" class="col-sm-2 col-form-label label-input">Status Aktif</label>
                    <div class="col-sm-4">
                        <select class="form-control form-control select-field" id="status" name="status">
                            <option value="" selected disabled>Pilih Status </option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>


                    </div>
                </div>

                <div class="form-group row">
                    <label for="foto" class="col-sm-2 col-form-label">Foto Guru</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                    </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        
                      
                        <button type="button" onclick="window.location.href = '/guruall'"
                        class="btn btn-danger">Kembali</button>
                       

                    </div>
                </div>




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
