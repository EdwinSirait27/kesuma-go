<div class="row" id="hal_edit"style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <style>
                .col-form-label {
                    font-size: 18px;
                    /* Ganti dengan ukuran font yang Anda inginkan */
                }
            </style>
            <h3><i class="fa fa-male" style="margin-right: 4px; margin-top: 15px;"></i>Tambah <small>Siswa</small></h3>

            <hr>
            <form method="POST" action="/siswaall-update"enctype="multipart/form-data" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="NOPDF" class="col-sm-2 col-form-label">No Pendaftaran</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="NOPDF" name="NOPDF"
                            placeholder="Nomor Pendaftaran"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="5" required>

                    </div>
                    <label for="NamaLengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-4">

                        <input type="text" class="form-control" id="NamaLengkap" name="NamaLengkap"
                            placeholder="Nama Lengkap" maxlength="50" required oninput="validateInput(this)"required>
                    </div>
                </div>
                <script>
                    function validateInput(inputElement) {
                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                    }
                </script>

                <div class="form-group row">
                    <label for="NomorInduk" class="col-sm-2 col-form-label">Nomor Induk</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="NomorInduk" name="NomorInduk"
                            placeholder="Nomor Induk"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" >

                    </div>


                    <label for="Nama_Panggilan" class="col-sm-2 col-form-label">Nama Panggilan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="NamaPanggilan" name="NamaPanggilan"
                            placeholder="Nama Panggilan" maxlength="20" required oninput="validateInput(this)"required>
                    </div>
                </div>
                <script>
                    function validateInput(inputElement) {
                        // Hanya izinkan huruf (A-Z, a-z) dan spasi
                        inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                    }
                </script>
                <div class="form-group row">
                    <label for="JenisKelamin" class="col-sm-2 col-form-label label-input">Jenis Kelamin</label>
                    <div class="col-sm-4">
                        <select class="form-control form-control select-field" id="JenisKelamin"
                            name="JenisKelamin" required>
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>

                    </div>


                    <label for="NISN" class="col-sm-2 col-form-label">NISN</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="NISN" name="NISN" placeholder="NISN"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="TempatLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="TempatLahir" name="TempatLahir"
                            placeholder="Tempat Lahir" maxlength="16" required oninput="validateInput(this)"required>
                    </div>
                    <script>
                        function validateInput(inputElement) {
                            // Hanya izinkan huruf (A-Z, a-z) dan spasi
                            inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                        }
                    </script>


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


                    <label for="Alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-4">
                        <input type="Alamat" class="form-control" id="Alamat" name="Alamat"
                            placeholder="Alamat" maxlength="50" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="RT" class="col-sm-2 col-form-label">RT</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="RT" name="RT" placeholder="RT"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required>

                  

                </div>

                <label for="RW" class="col-sm-2 col-form-label">RW</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="RW" name="RW" placeholder="RW"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required>
                </div>
        </div>
        <div class="form-group row">
            <label for="Kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Kelurahan" name="Kelurahan"
                    placeholder="Kelurahan" maxlength="20" oninput="validateInput(this)" required>
            </div>
            <script>
                function validateInput(inputElement) {
                    // Hanya izinkan huruf (A-Z, a-z) dan spasi
                    inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                }
            </script>


            <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Kecamatan" name="Kecamatan"
                    placeholder="Kecamatan" maxlength="20" oninput="validateInput(this)" required>

            </div>
        </div>
        <script>
            function validateInput(inputElement) {
                // Hanya izinkan huruf (A-Z, a-z) dan spasi
                inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
            }
        </script>


        <div class="form-group row">
            <label for="KabKota" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="KabKota" name="KabKota"
                    placeholder="KabKota" maxlength="20" oninput="validateInput(this)" required>

            </div>
            <script>
                function validateInput(inputElement) {
                    // Hanya izinkan huruf (A-Z, a-z) dan spasi
                    inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                }
            </script>

            <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Provinsi" name="Provinsi"
                    placeholder="Provinsi" maxlength="20" oninput="validateInput(this)"required>

            </div>
        </div>
        <script>
            function validateInput(inputElement) {
                // Hanya izinkan huruf (A-Z, a-z) dan spasi
                inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
            }
        </script>
        <div class="form-group row">
            <label for="KodePos" class="col-sm-2 col-form-label">Kode Pos</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="KodePos" name="KodePos"
                placeholder="Kode Pos"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="6" required>
            </div>


            <label for="Email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-4">
                <input type="Email" class="form-control" id="Email" name="Email" placeholder="Email"maxlength="40"required>
            </div>
        </div>
        <div class="form-group row">
            <label for="NomorTelephone" class="col-sm-2 col-form-label">Nomor Telepon</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="NomorTelephone" name="NomorTelephone"
                placeholder="Nomor Telephone"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>

            </div>


            <label for="Kewarganegaraan" class="col-sm-2 col-form-label">Kewarganegaraan</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Kewarganegaraan" name="Kewarganegaraan"
                placeholder="Kewarganegaraan" maxlength="23" required
                oninput="validateInput(this)"required>
        </div>
        </div>
        <script>
            function validateInput(inputElement) {
                // Hanya izinkan huruf (A-Z, a-z) dan spasi
                inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
            }
        </script>
        <div class="form-group row">
            <label for="NIK" class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="NIK" name="NIK"
                            placeholder="NIK"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>

            </div>


            <label for="GolDarah" class="col-sm-2 col-form-label">Golongan Darah</label>
            <div class="col-sm-4">
               
                <input type="text" class="form-control" id="GolDarah" name="GolDarah"
                placeholder="Golonga Darah" maxlength="1" required
                oninput="validateInput(this)"required>
        </div>
        </div>
        <script>
            function validateInput(inputElement) {
                // Hanya izinkan huruf (A-Z, a-z) dan spasi
                inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
            }
        </script>
        <div class="form-group row">
            <label for="TinggalDengan" class="col-sm-2 col-form-label">Tinggal Dengan</label>
            <div class="col-sm-4">
                
                <input type="text" class="form-control" id="TinggalDengan" name="TinggalDengan"
                placeholder="Tinggal Dengan" maxlength="20" required
                oninput="validateInput(this)"required>
        </div>
        <script>
            function validateInput(inputElement) {
                // Hanya izinkan huruf (A-Z, a-z) dan spasi
                inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
            }
        </script>
            <label for="StatusSiswa" class="col-sm-2 col-form-label">Status Siswa</label>
            <div class="col-sm-4">
                <select class="form-control form-control select-field" id="StatusSiswa"
                name="StatusSiswa">
                <option value="" selected disabled>Status </option>
                <option value="Lengkap">Lengkap</option>
                <option value="Yatim">Yatim</option>
                <option value="Piatu">Piatu</option>
                <option value="YatimPiatu">YatimPiatu</option>
            </select>
                </div>
        </div>
        <div class="form-group row">
            <label for="AnakKe" class="col-sm-2 col-form-label">Anak Ke</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="AnakKe" name="AnakKe"
                placeholder="Anak Ke"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="1" required>
    </div>


            <label for="SaudaraKandung" class="col-sm-2 col-form-label">Jumlah Saudara Kandung</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="SaudaraKandung" name="SaudaraKandung"
                placeholder="Saudara Kandung"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="1" required>
    </div>
    </div>
        <div class="form-group row">
            <label for="SaudaraTiri" class="col-sm-2 col-form-label">Jumlah Saudara Tiri</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="SaudaraTiri" name="SaudaraTiri"
                placeholder="Saudara Tiri"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="1" required>
    </div>
        
            <label for="Tinggicm" class="col-sm-2 col-form-label">Tinggi cm</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Tinggicm" name="Tinggicm"
                placeholder="Tinggi CM"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required>
    </div>
    </div>
    <div class="form-group row">
            <label for="Beratkg" class="col-sm-2 col-form-label">Berat kg</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="Beratkg" name="Beratkg"
                placeholder="Berat KG"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="3" required>
            </div>
    
            <label for="RiwayatPenyakit" class="col-sm-2 col-form-label">Riwayat Penyakit</label>
            <div class="col-sm-4">
                <input type="RiwayatPenyakit" class="form-control" id="RiwayatPenyakit"
                    name="RiwayatPenyakit" placeholder="Riwayat Penyakit">

            </div>
            </div>





            <div class="form-group row">
            <label for="AsalSMP" class="col-sm-2 col-form-label">Asal SMP</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="AsalSMP" name="AsalSMP"
                placeholder="Asal SMP" maxlength="30" required>
        </div>

        
            <label for="AlamatSMP" class="col-sm-2 col-form-label">Alamat SMP</label>
            <div class="col-sm-4">
                <input type="AlamatSMP" class="form-control" id="AlamatSMP" name="AlamatSMP"
                    placeholder="Alamat SMP"maxlength="30" required>

            </div>
            </div>

            <div class="form-group row">
            <label for="NPSNSMP" class="col-sm-2 col-form-label">NPSN SMP</label>
            <div class="col-sm-4">
                <input type="NPSNSMP" class="form-control" id="NPSNSMP" name="NPSNSMP"
                    placeholder="Nomor Pokok Sekolah Nasional"maxlength="16">
            
        </div>
       
            <label for="KabKotaSMP" class="col-sm-2 col-form-label">Kabupaten/Kota SMP</label>
            <div class="col-sm-4">
                <input type="KabKotaSMP" class="form-control" id="KabKotaSMP" name="KabKotaSMP"
                    placeholder="Kabupaten/Kota SMP"maxlength="16">

            </div>
            </div>

            <div class="form-group row">
            <label for="ProvinsiSMP" class="col-sm-2 col-form-label">Provinsi SMP</label>
            <div class="col-sm-4">
                <input type="ProvinsiSMP" class="form-control" id="ProvinsiSMP" name="ProvinsiSMP"
                    placeholder="Provinsi SMP"maxlength="16">
           
        </div>
      
            <label for="NoIjasah" class="col-sm-2 col-form-label">Nomor Ijasah SMP</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="NoIjasah" name="NoIjasah"
                placeholder="Nomor Ijasah SMP"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>

            </div>
            </div>

            <div class="form-group row">
            <label for="NoSKHUN" class="col-sm-2 col-form-label">Nomor SKHUN SMP</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="NoSKHUN" name="NoSKHUN"
                            placeholder="NoSKHUN"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16" required>
                        </div>               
            <label for="DiterimaTanggal" class="col-sm-2 col-form-label">Diterima Tanggal</label>
            <div class="col-sm-4">
                <input type="date" class="form-control" id="DiterimaTanggal"
                    name="DiterimaTanggal" placeholder="Diterima Tanggal"required>
            </div>
        </div>
        <div class="form-group row">
            <label for="DiterimaDiKelas" class="col-sm-2 col-form-label label-input">Diterima di
                Kelas</label>
            <div class="col-sm-4">
                <select class="form-control form-control select-field" id="DiterimaDiKelas"
                    name="DiterimaDiKelas"required>
                    <option value="" selected disabled>Pilih Kelas </option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    
                </select>

            </div>
            <label for="DiterimaSemester" class="col-sm-2 col-form-label">Diterima di Semester</label>
            <div class="col-sm-4"required>
                <select class="form-control form-control select-field" id="DiterimaSemester"
                    name="DiterimaSemester"required>
                    <option value="" selected disabled>Pilih Semester </option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                    
                    
                </select>
            </div> 
            </div> 
            <div class="form-group row">
            <label for="MutasiAsalSMA" class="col-sm-2 col-form-label">Mutasi Asal SMA</label>
            <div class="col-sm-4">
                <input type="MutasiAsalSMA" class="form-control" id="MutasiAsalSMA" name="MutasiAsalSMA"
                    placeholder="Mutasi Asal SMA" maxlength="20">
            
        </div>

        
            <label for="AlasanPindah" class="col-sm-2 col-form-label">Alasan Pindah</label>
            <div class="col-sm-4">
                <input type="AlasanPindah" class="form-control" id="AlasanPindah" name="AlasanPindah"
                    placeholder="Alasan Pindah"maxlength="20">
            </div>
            </div>
            <div class="form-group row">
            <label for="NoPesertaUNSMP" class="col-sm-2 col-form-label">Nomor Peserta UN SMP</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="NoPesertaUNSMP" name="NoPesertaUNSMP"
                placeholder="No Peserta UN SMP"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="16">
           
        </div>

            <label for="TglIjasah" class="col-sm-2 col-form-label">Tanggal Ijasah</label>
            <div class="col-sm-4">
                <input type="date" class="form-control" id="TglIjasah" name="TglIjasah"
                    placeholder="Tanggal Ijasah" required>
            </div>
            </div>

            <div class="form-group row">
            <label for="NamaOrangTuaPadaIjasah" class="col-sm-2 col-form-label">Nama Orang Tua pada
                Ijasah</label>
            <div class="col-sm-4">
              
                <input type="text" class="form-control" id="NamaOrangTuaPadaIjasah" name="NamaOrangTuaPadaIjasah"
                placeholder="Nama Ortu Pada Ijazah" maxlength="30" required
                oninput="validateInput(this)"required>
     
        </div>
        <script>
            function validateInput(inputElement) {
                // Hanya izinkan huruf (A-Z, a-z) dan spasi
                inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
            }
        </script>

            <label for="NamaAyah" class="col-sm-2 col-form-label">Nama Ayah</label>
            <div class="col-sm-4">
                <input type="NamaAyah" class="form-control" id="NamaAyah" name="NamaAyah"
                    placeholder="Nama Ayah"maxlength="30" required>
            </div>
            </div>
            <div class="form-group row">
            <label for="Tahun_Lahir_Ayah" class="col-sm-2 col-form-label">Tahun Lahir Ayah</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="TahunLahirAyah" name="TahunLahirAyah"
                placeholder="Tahun Lahir Ayah"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="4" required>
          
        </div>

      
            <label for="AlamatAyah" class="col-sm-2 col-form-label">Alamat Ayah</label>
            <div class="col-sm-4">
                <input type="AlamatAyah" class="form-control" id="AlamatAyah" name="AlamatAyah"
                    placeholder="Alamat Ayah" maxlength="30">
            </div>
            </div>
            <div class="form-group row">
            <label for="NomorTelephoneAyah" class="col-sm-2 col-form-label">Nomor Telepon Ayah</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="NomorTelephoneAyah" name="NomorTelephoneAyah"
                            placeholder="NomorTelephoneAyah"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>
         
        </div>

            <label for="AgamaAyah" class="col-sm-2 col-form-label">Agama Ayah</label>
            <div class="col-sm-4">
                <input type="AgamaAyah" class="form-control" id="AgamaAyah" name="AgamaAyah"
                    placeholder="Agama Ayah"  maxlength="10">
            </div>
            </div>


            <div class="form-group row">
                <label for="PendidikanTerakhirAyah" class="col-sm-2 col-form-label">Pendidikan Terakhir
                    Ayah</label>
                <div class="col-sm-4">
                    <input type="PendidikanTerakhirAyah" class="form-control" id="PendidikanTerakhirAyah"
                        name="PendidikanTerakhirAyah" placeholder="Pendidikan Terakhir Ayah" maxlength="10">
                </div>
                <label for="Pekerjaan_Ayah" class="col-sm-2 col-form-label">Pekerjaan Ayah</label>
                <div class="col-sm-4">
                    <input type="PekerjaanAyah" class="form-control" id="PekerjaanAyah"
                        name="PekerjaanAyah" placeholder="Pekerjaan Ayah" maxlength="10"required>
                </div>
            </div>

            <div class="form-group row">
                <label for="PenghasilanAyah" class="col-sm-2 col-form-label">Penghasilan Ayah</label>
                <div class="col-sm-4">
                    <input type="PenghasilanAyah" class="form-control" id="PenghasilanAyah"
                        name="PenghasilanAyah" placeholder="Penghasilan Ayah" maxlength="30" required >
                </div>


                <label for="NamaIbu" class="col-sm-2 col-form-label">Nama Ibu</label>
                <div class="col-sm-4">
                    <input type="NamaIbu" class="form-control" id="NamaIbu" name="NamaIbu"
                        placeholder="Nama Ibu" maxlength="30" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="TahunLahirIbu" class="col-sm-2 col-form-label">Tahun Lahir Ibu</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="TahunLahirIbu" name="TahunLahirIbu"
                            placeholder="Tahun Lahir Ibu"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="4" required>
                </div>
                <label for="AlamatIbu" class="col-sm-2 col-form-label">Alamat Ibu</label>
                <div class="col-sm-4">
                    <input type="AlamatIbu" class="form-control" id="AlamatIbu" name="AlamatIbu"
                        placeholder="Alamat Ibu"maxlength="30" >
                </div>
            </div>

            <div class="form-group row">
                <label for="NomorTelephoneIbu" class="col-sm-2 col-form-label">Nomor Telepon Ibu</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="NomorTelephoneIbu" name="NomorTelephoneIbu"
                    placeholder="Nomor Telephone Ibu"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" required>
                </div>
                <label for="AgamaIbu" class="col-sm-2 col-form-label">Agama Ibu</label>
                <div class="col-sm-4">
                    <input type="AgamaIbu" class="form-control" id="AgamaIbu" name="AgamaIbu"
                        placeholder="Agama Ibu"maxlength="10" required>
                </div>
            </div>

            <div class="form-group row">
            <label for="PendidikanTerakhirIbu" class="col-sm-2 col-form-label">Pendidikan Terakhir
                Ibu</label>
            <div class="col-sm-4">
                <input type="PendidikanTerakhirIbu" class="form-control" id="PendidikanTerakhirIbu"
                    name="PendidikanTerakhirIbu" placeholder="Pendidikan Terakhir Ibu"maxlength="20" >
       
        </div>

       
            <label for="PekerjaanIbu" class="col-sm-2 col-form-label">Pekerjaan Ibu</label>
            <div class="col-sm-4">
                <input type="PekerjaanIbu" class="form-control" id="PekerjaanIbu" name="PekerjaanIbu"
                    placeholder="Pekerjaan Ibu"maxlength="20" required>
            </div>
            </div>
            <div class="form-group row">
            <label for="PenghasilanIbu" class="col-sm-2 col-form-label">Penghasilan Ibu</label>
            <div class="col-sm-4">
                <input type="PenghasilanIbu" class="form-control" id="PenghasilanIbu"
                    name="PenghasilanIbu" placeholder="Penghasilan Ibu"maxlength="30" required>
            </div>
     
        <label for="NamaWali" class="col-sm-2 col-form-label">Nama Wali</label>
        <div class="col-sm-4">
            <input type="NamaWali" class="form-control" id="NamaWali" name="NamaWali"
                placeholder="Nama Wali"maxlength="30" >
        </div>
    </div>

    <div class="form-group row">
        <label for="TahunLahirWali" class="col-sm-2 col-form-label">Tahun Lahir Wali</label>
        <div class="col-sm-4">
            <input type="TahunLahirWali" class="form-control" id="TahunLahirWali" name="TahunLahirWali"
                placeholder="Tahun Lahir Wali"maxlength="4" >
        </div>
        <label for="AlamatWali" class="col-sm-2 col-form-label">Alamat Wali</label>
        <div class="col-sm-4">
            <input type="AlamatWali" class="form-control" id="AlamatWali" name="AlamatWali"
                placeholder="Alamat Wali"maxlength="30" >
        </div>
    </div>

    <div class="form-group row">
        <label for="NomorTelephoneWali" class="col-sm-2 col-form-label">Nomor Telepon Wali</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="NomorTelephoneWali" name="NomorTelephoneWali"
                            placeholder="Nomor Telfon"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="13" >
        </div>

        <label for="AgamaWali" class="col-sm-2 col-form-label">Agama Wali</label>
        <div class="col-sm-4">
            <input type="AgamaWali" class="form-control" id="AgamaWali" name="AgamaWali"
                placeholder="Agama Wali"maxlength="10">
        </div>
    </div>
  <div class="form-group row">
    <label for="PendidikanTerakhirWali" class="col-sm-2 col-form-label">Pendidikan Terakhir Wali</label>
    <div class="col-sm-4">
        <input type="PendidikanTerakhirWali" class="form-control" id="PendidikanTerakhirWali"
            name="PendidikanTerakhirWali" placeholder="Pendidikan Terakhir Wali"maxlength="12">
   
</div>


    <label for="PekerjaanWali" class="col-sm-2 col-form-label">Pekerjaan Wali</label>
    <div class="col-sm-4">
        <input type="PekerjaanWali" class="form-control" id="PekerjaanWali" name="PekerjaanWali"
            placeholder="Pekerjaan Wali"maxlength="20">
    </div>
    </div>
    <div class="form-group row">
    <label for="WaliPenghasilan" class="col-sm-2 col-form-label">Penghasilan Wali</label>
    <div class="col-sm-4">
        <input type="WaliPenghasilan" class="form-control" id="WaliPenghasilan" name="WaliPenghasilan"
            placeholder="Penghasilan Wali"maxlength="30">
 
</div>


    <label for="StatusHubunganWali" class="col-sm-2 col-form-label">Status Hubungan Wali</label>
    <div class="col-sm-4">
        <input type="StatusHubunganWali" class="form-control" id="StatusHubunganWali"
            name="StatusHubunganWali" placeholder="Status Hubungan Wali"maxlength="12">
    </div>
    </div>


    <div class="form-group row">
        <label for="MenerimaBeasiswaDari" class="col-sm-2 col-form-label">Menerima Beasiswa
            Dari</label>
        <div class="col-sm-4">
            <input type="MenerimaBeasiswaDari" class="form-control" id="MenerimaBeasiswaDari"
                name="MenerimaBeasiswaDari" placeholder="Menerima Beasiswa Dari"maxlength="30">
        </div>
        <label for="TahunMeninggalkanSekolah" class="col-sm-2 col-form-label">Tahun Meninggalkan
            Sekolah</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" id="TahunMeninggalkanSekolah"
                name="TahunMeninggalkanSekolah" placeholder="Tahun Meninggalkan Sekolah">
        </div>
    </div>

    <div class="form-group row">
        <label for="AlasanSebab" class="col-sm-2 col-form-label">Alasan Sebab</label>
        <div class="col-sm-4">
            <input type="AlasanSebab" class="form-control" id="AlasanSebab" name="AlasanSebab"
                placeholder="Alasan Sebab"maxlength="20">
        </div>
        <label for="TamatBelajarTahun" class="col-sm-2 col-form-label">Tamat Belajar Tahun</label>
        <div class="col-sm-4">
            <input type="TamatBelajarTahun" class="form-control" id="TamatBelajarTahun"
            oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="TamatBelajarTahun" placeholder="Tamat Belajar SMA Tahun"maxlength="4">
        </div>
    </div>

    <div class="form-group row">
        <label for="TanggalNomorSTTB" class="col-sm-2 col-form-label">Tanggal Nomor STTB</label>
        <div class="col-sm-4">
            <input type="date" class="form-control" id="TanggalNomorSTTB"
                name="TanggalNomorSTTB" placeholder="Tanggal Nomor STTB">
        </div>
        <label for="InformasiLain" class="col-sm-2 col-form-label">Informasi Lain</label>
        <div class="col-sm-4">
            <input type="InformasiLain" class="form-control" id="InformasiLain" name="InformasiLain"
                placeholder="Informasi Lain" maxlength="30">
        
    </div>
    </div>

    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-4">
            <input type="username" class="form-control" id="username" name="username" placeholder="Username">
            
        </div>

        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                    maxlength="12"  disabled>
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
    </div>
    <div class="form-group row">
        <label for="cita" class="col-sm-2 col-form-label">Cita-Cita</label>
        <div class="col-sm-4">
            <input type="cita" class="form-control" id="cita" name="cita" placeholder="Cita-Cita">
            <div class="row">
            </div>
        </div>


        <label for="foto" class="col-sm-2 col-form-label">Foto Siswa</label>
        <div class="col-sm-4">
            <input type="file" class="form-control" id="foto" name="foto" >
        </div>
    </div>
    <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label label-input">Status Aktif</label>
        <div class="col-sm-4">
            <select class="form-control form-control select-field" id="status" name="status"required>
                <option value="" selected disabled>Pilih Status </option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
        </div>
        <div class="form-group row">
            <div class="col-sm-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
               
                <button type="button" onclick="window.location.href = '/siswaall'"
                class="btn btn-danger">Kembali</button>
                
                
            </div>
        </div>
        <div class="row">
            <h2 style="color: red;">*diisi semua
            </h2>
        </div>
        <br>
        <br>
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
<br>
<br>

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
