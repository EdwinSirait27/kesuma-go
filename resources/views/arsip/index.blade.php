@extends('index')
@section('title', 'Kesuma-GO | Arsip Data Siswa')
@section('content')
  
    <style>
        .table th,
        .table td {

            text-align: center;
        }

        /* ini dia */
        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }

        .hidden {
            display: none;
        }
    </style>
    <div class="row" id="hal_index">
    <div class="card-header bg-dark text-white">
        <h3><i class="fa fa-book"style="margin-right: 10px; margin-top: 15px;"></i>Data Arsip <small> Siswa</small></h3>
       
</div>
</div>
<hr>
<div class="alert alert-dark">
    <ul>
        <li><h2><i>* Setiap ada data arsip baru, silahkan download dulu datanya lewat button excel dan wajib menghapus data arsip yang sudah ada</i></h2></li>
        <li><h2><i>* Kalau ingin menghapus semua data jangan lupa untuk mengganti ke semua entry agar data terlihat semua dan menekan tombol checkall agar tidak mencheckbox satu per satu</i></h2></li>
        <li><h2><i>* penomoran pada file excel tidak boleh kosong karena untuk penomoran data, yang lain boleh kosong jikalau memang benar tidak ada data. Okai admin :)</i></h2></li>
        <li><h2><i>* Contoh file arsip berada pada data kepala sekolah</i></h2></li>
        <li><h2><i>* JIkalau ingin mendownload data siswa, silahnya mengubah entry ke semua agar semua data siswa terlihat dan menggunakan button excel atau csv </i></h2></li>
    </ul>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2><i class="fa fa-male" style="margin-right: 10px;"></i>Detail Arsip <small>Siswa</small></h2>
        <div class="col-md-4 float-right">
            <select id="tamat" class="form-control">
                <option value="">Pilih Tamat Belajar</option>
                @foreach($tamat as $tama)
                            <option value="{{ $tama->TamatBelajarTahun }}">{{ $tama->TamatBelajarTahun }} </option>
                        @endforeach
            </select>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap user_datatable" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom" width="60">No.</th>
                                <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom" width="60">Nomor Pendaftaran Lama</th>
                                <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                Nama Lengkap
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Nama Panggilan
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                Tempat Lahir
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Tanggal Lahir
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                Alamat
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                            width="120">
                            Nomor Induk
                        </th>

                        <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                            width="120">
                            Jenis Kelamin
                        </th>
                        <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                            width="120">
                            NISN
                        </th>
                        <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                            width="120">
                            Agama
                        </th>
                        <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                            width="120">
                            Nomor Telephone
                        </th>

                        <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                            width="120">
                            Email
                        </th>
                     
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="60">
                                RT
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="60">
                                RW
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Kelurahan
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Kecamatan
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                Kab Kota
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                Provinsi
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="90">
                                Kode Pos
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                Kewarganegaraan
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                NIK
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Golongan Darah
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Tinggal Dengan
                            </th>
                          
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Status Siswa
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="90">
                                Anak Ke
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Saudara Kandung
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Saudara Tiri
                            </th>
                           
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="90">
                                Tinggi cm
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="90">
                                Berat kg
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Riwayat Penyakit
                            </th>
                            
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Asal SMP
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                Alamat SMP
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                NPSN SMP
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                Kab Kota SMP
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                Provinsi SMP
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                No Ijasah
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                No SKHUN
                            </th>
                           
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                Diterima Tanggal
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                Diterima DiKelas
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                Diterima Semester
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                Mutasi Asal SMA
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                Alasan Pindah
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                No Peserta UNSMP
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="150">
                                Tgl Ijasah
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="250">
                                Nama Orang Tua Pada Ijasah
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Nama Ayah
                            </th>
                            
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                Alamat Ayah
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="180">
                                Nomor Telephone Ayah
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Agama Ayah
                            </th>
                            
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="250">
                                Pendidikan Terakhir Ayah
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="180">
                                Pekerjaan Ayah
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="180">
                                Penghasilan Ayah
                            </th>
                           
                           
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Nama Ibu
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Tahun Lahir Ibu
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                Alamat Ibu
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="180">
                                Nomor Telephone Ibu
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Agama Ibu
                            </th>
                            
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="250">
                                Pendidikan Terakhir Ibu
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="180">
                                Pekerjaan Ibu
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="180">
                                Penghasilan Ibu
                            </th>
                           
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Nama Wali
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Tahun Lahir Wali
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                Alama tWali
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="180">
                                Nomor Telephone Wali
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="120">
                                Agama Wali
                            </th>
                           
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="250">
                                Pendidikan Terakhir Wali
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="180">
                                PekerjaanWali
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="180">
                                WaliPenghasilan
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                StatusHubunganWali
                            </th>
                           
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                MenerimaBeasiswaDari
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                TahunMeninggalkanSekolah
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                Alasan Meninggalkan
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                Tamat Belajar Tahun
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                Tanggal Nomor STTB
                            </th>
                         
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                Informasi Lain
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                Nomor Pendaftaran Baru
                            </th>
                            <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                width="200">
                                Angkatan
                            </th>
                                <th width="5px" style="text-align: center; font-size: 15px;">
                                    <button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs">Delete</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="button" onclick="window.location.href = '/uploaddata'" class="btn btn-dark">Upload data</button>
                        <button type="button" onclick="window.location.href = '/siswaall'" class="btn btn-danger">Kembali</button>
                        <button type="button" class="btn btn-primary" id="checkAll">Check All</button>
                        <button type="button" class="btn btn-secondary" id="uncheckAll">Uncheck All</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  







    {{-- <div class="row" id="hal_index">
        <div class="col-md-12 col-sm-12">
            <h3><i class="fa fa-male" style="margin-right: 10px; margin-top: 15px;"></i>Detail Arsip <small>Siswa</small></h3>
            <hr>
        </div>
    </div>
    <div class="alert alert-dark">
        <ul>
           <h2><i >*Setiap ada data arsip baru, silahkan download dulu datanya lewat button excel dan wajib menghapus data arsip yang sudah ada </i></h2>
           <h2><i >*kalau ingin menghapus semua data jangan lupa untuk mengganti ke semua entry agar data terlihat semua dan menekan tombol checkall agar tidak mencheckbox satu" </i></>
           <h2><i >*siswa_id pada file excel tidak boleh kosong karena untuk penomoran data, yang lain boleh kosong jikalau memang benar tidak ada data okai admin:) </i></>
           <h2><i >*contoh file arsip berada pada data kepala sekolah </i></>
            
        </ul>
    </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-male" style="margin-right: 10px; "></i>Detail Arsip<small>Siswa</small></h2>
                    <div class="clearfix"></div>
                    <div class="col-md-4">
                        <select id="tahun_akademik_filter" class="form-control">
                            <option value="">Pilih Tahun Akademik</option>
                           
                        </select>
                     
                    </div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap user_datatable"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        No.
                                    </th>
                                   
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="60">
                                        Nomor Pendaftaran Lama
                                    </th>
                                 
                                    <th width="5px" style="text-align: center; font-size: 15px;">
                                        <button type="button" name="bulk_delete" id="bulk_delete"
                                            class="btn btn-danger btn-xs">Delete</button>
                                    </th>
                                  
                                  
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                
                                    <button type="button" onclick="window.location.href = '/uploaddata'"class="btn btn-dark">Upload data</button>
                                    <button type="button" onclick="window.location.href = '/siswaall'"
                                        class="btn btn-danger">Kembali</button>
                                        <button type="button" class="btn btn-primary" id="checkAll">Check All</button>
                                        <button type="button" class="btn btn-secondary" id="uncheckAll">Uncheck All</button>
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    
    </div> --}}
          
  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
   <script>
        iForm('hal_index');

        function iForm(iv) {
            $('#hal_index').hide();
            $('#hal_edit').hide();
            $('#' + iv).show();
        }
        document.getElementById('checkAll').addEventListener('click', function() {
        var checkboxes = document.getElementsByClassName('users_checkbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = true;
        }
    });

    document.getElementById('uncheckAll').addEventListener('click', function() {
        var checkboxes = document.getElementsByClassName('users_checkbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false;
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // Hentikan inisialisasi DataTable sebelumnya jika sudah ada
        if ($.fn.DataTable.isDataTable('#datatable-buttons')) {
            $('#datatable-buttons').DataTable().destroy();
        }
    
        // Sekarang Anda dapat menginisialisasi DataTable yang baru
        var table = $('#datatable-buttons').DataTable({
            dom: 'lBfrtip', // 'l' will show "Show Entries" option
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
            buttons: ['copy', 'csv', 'excel'],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('arsip.index') }}",
                method: "GET"
            },
            columns: [{
                        data: 'siswa_id',
                        name: 'siswa_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'NOPDF',
                        name: 'NOPDF'
                    },
                    {
                        data: 'NamaLengkap',
                        name: 'NamaLengkap'
                    },
                 
                    {
                        data: 'NamaPanggilan',
                        name: 'NamaPanggilan'
                    },
                    {
                        data: 'TempatLahir',
                        name: 'TempatLahir'
                    },
                    {
                        data: 'TanggalLahir',
                        name: 'TanggalLahir'
                    },
                    {
                        data: 'Alamat',
                        name: 'Alamat'
                    },
                    {
                            data: 'NomorInduk',
                            name: 'NomorInduk'
                        },



                        {
                            data: 'JenisKelamin',
                            name: 'JenisKelamin'
                        },
                        {
                            data: 'NISN',
                            name: 'NISN'
                        },

                        {
                            data: 'Agama',
                            name: 'Agama'
                        },
                        {
                            data: 'NomorTelephone',
                            name: 'NomorTelephone'
                        },
                        {
                            data: 'Email',
                            name: 'Email'
                        },

                  
                    {
                        data: 'RT',
                        name: 'RT'
                    },
                    {
                        data: 'RW',
                        name: 'RW'
                    },
                    {
                        data: 'Kelurahan',
                        name: 'Kelurahan'
                    },
                    {
                        data: 'Kecamatan',
                        name: 'Kecamatan'
                    },
                    {
                        data: 'KabKota',
                        name: 'KabKota'
                    },
                    {
                        data: 'Provinsi',
                        name: 'Provinsi'
                    },
                    {
                        data: 'KodePos',
                        name: 'KodePos'
                    },
                    {
                        data: 'Kewarganegaraan',
                        name: 'Kewarganegaraan'
                    },
                    {
                        data: 'NIK',
                        name: 'NIK'
                    },
                    {
                        data: 'GolDarah',
                        name: 'GolDarah'
                    },
                    {
                        data: 'TinggalDengan',
                        name: 'TinggalDengan'
                    },
                   
                    {
                        data: 'StatusSiswa',
                        name: 'StatusSiswa'
                    },
                    {
                        data: 'AnakKe',
                        name: 'AnakKe'
                    },
                    {
                        data: 'SaudaraKandung',
                        name: 'SaudaraKandung'
                    },
                    {
                        data: 'SaudaraTiri',
                        name: 'SaudaraTiri'
                    },
                  
                    {
                        data: 'Tinggicm',
                        name: 'Tinggicm'
                    },
                    {
                        data: 'Beratkg',
                        name: 'Beratkg'
                    },
                    {
                        data: 'RiwayatPenyakit',
                        name: 'RiwayatPenyakit'
                    },
                    
                    {
                        data: 'AsalSMP',
                        name: 'AsalSMP'
                    },
                    {
                        data: 'AlamatSMP',
                        name: 'AlamatSMP'
                    },
                    {
                        data: 'NPSNSMP',
                        name: 'NPSNSMP'
                    },
                    {
                        data: 'KabKotaSMP',
                        name: 'KabKotaSMP'
                    },
                    {
                        data: 'ProvinsiSMP',
                        name: 'ProvinsiSMP'
                    },
                    {
                        data: 'NoIjasah',
                        name: 'NoIjasah'
                    },
                    {
                        data: 'NoSKHUN',
                        name: 'NoSKHUN'
                    },
                  
                    {
                        data: 'DiterimaTanggal',
                        name: 'DiterimaTanggal'
                    },
                    {
                        data: 'DiterimaDiKelas',
                        name: 'DiterimaDiKelas'
                    },
                    {
                        data: 'DiterimaSemester',
                        name: 'DiterimaSemester'
                    },
                    {
                        data: 'MutasiAsalSMA',
                        name: 'MutasiAsalSMA'
                    },
                    {
                        data: 'AlasanPindah',
                        name: 'AlasanPindah'
                    },
                    {
                        data: 'NoPesertaUNSMP',
                        name: 'NoPesertaUNSMP'
                    },
                    {
                        data: 'TglIjasah',
                        name: 'TglIjasah'
                    },
                    {
                        data: 'NamaOrangTuaPadaIjasah',
                        name: 'NamaOrangTuaPadaIjasah'
                    },
                    {
                        data: 'NamaAyah',
                        name: 'NamaAyah'
                    },
                  
                    {
                        data: 'AlamatAyah',
                        name: 'AlamatAyah'
                    },
                    {
                        data: 'NomorTelephoneAyah',
                        name: 'NomorTelephoneAyah'
                    },
                    {
                        data: 'AgamaAyah',
                        name: 'AgamaAyah'
                    },
                
                    {
                        data: 'PendidikanTerakhirAyah',
                        name: 'PendidikanTerakhirAyah'
                    },
                    {
                        data: 'PekerjaanAyah',
                        name: 'PekerjaanAyah'
                    },
                    {
                        data: 'PenghasilanAyah',
                        name: 'PenghasilanAyah'
                    },
                  
                  
                    {
                        data: 'NamaIbu',
                        name: 'NamaIbu'
                    },
                    {
                        data: 'TahunLahirIbu',
                        name: 'TahunLahirIbu'
                    },
                    {
                        data: 'AlamatIbu',
                        name: 'AlamatIbu'
                    },
                    {
                        data: 'NomorTelephoneIbu',
                        name: 'NomorTelephoneIbu'
                    },
                    {
                        data: 'AgamaIbu',
                        name: 'AgamaIbu'
                    },
                  
                    {
                        data: 'PendidikanTerakhirIbu',
                        name: 'PendidikanTerakhirIbu'
                    },
                    {
                        data: 'PekerjaanIbu',
                        name: 'PekerjaanIbu'
                    },
                    {
                        data: 'PenghasilanIbu',
                        name: 'PenghasilanIbu'
                    },
                    
                    {
                        data: 'NamaWali',
                        name: 'NamaWali'
                    },
                    {
                        data: 'TahunLahirWali',
                        name: 'TahunLahirWali'
                    },
                    {
                        data: 'AlamatWali',
                        name: 'AlamatWali'
                    },
                    {
                        data: 'NomorTelephoneWali',
                        name: 'NomorTelephoneWali'
                    },
                    {
                        data: 'AgamaWali',
                        name: 'AgamaWali'
                    },
                 
                    {
                        data: 'PendidikanTerakhirWali',
                        name: 'PendidikanTerakhirWali'
                    },
                    {
                        data: 'PekerjaanWali',
                        name: 'PekerjaanWali'
                    },
                    {
                        data: 'WaliPenghasilan',
                        name: 'WaliPenghasilan'
                    },
                    {
                        data: 'StatusHubunganWali',
                        name: 'StatusHubunganWali'
                    },
                    
                    {
                        data: 'MenerimaBeasiswaDari',
                        name: 'MenerimaBeasiswaDari'
                    },
                    {
                        data: 'TahunMeninggalkanSekolah',
                        name: 'TahunMeninggalkanSekolah'
                    },
                    {
                        data: 'AlasanSebab',
                        name: 'AlasanSebab'
                    },
                    {
                        data: 'TamatBelajarTahun',
                        name: 'TamatBelajarTahun'
                    },
                    {
                        data: 'TanggalNomorSTTB',
                        name: 'TanggalNomorSTTB'
                    },
                    
                    {
                        data: 'InformasiLain',
                        name: 'InformasiLain'
                    },
                    {
                        data: 'no_pdf',
                        name: 'no_pdf'
                    },
                    {
                        data: 'angkatan',
                        name: 'angkatan'
                    },
                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    }
                   
             


                    
                ]
            });
            $('#tamat').on('change', function() {
                var TamatBelajarTahun = $(this).val(); // Mendapatkan nilai tahun akademik yang dipilih
                table.ajax.url("{{ route('arsip.index') }}?TamatBelajarTahun=" + TamatBelajarTahun).load(); // Mengubah URL Ajax dan memuat ulang tabel
            });
        });
      
    </script>
    
    <script>
        $(document).on('click', '#bulk_delete', function() {
            var ids = []; // Menggunakan nama variable yang berbeda untuk menghindari konflik
            Swal.fire({
                title: "Apakah Yakin?",
                text: "Data Tidak Bisa Kembali",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus",
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.users_checkbox:checked').each(function() {
                        ids.push($(this).val()); // Menggunakan array ids untuk menyimpan nilai
                    });
                    if (ids.length > 0) {
                        $.ajax({
                            url: "{{ route('arsip.removeall2') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "POST", // Mengubah metode menjadi POST
                            data: {
                                ids: ids // Menggunakan nama parameter yang sesuai
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your data has been deleted.",
                                    icon: "success",
                                });
                                window.location.assign("arsip"); // Pastikan URL ini benar
                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Tidak Ada Data Yang Tercentang",
                            text: "Dicentang Dulu Baru Bisa Dihapus Ya Admin:)",
                            icon: "warning",
                        });
                    }
                }
            });
        });
        </script>
@endsection












