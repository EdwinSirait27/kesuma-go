@extends('index')
@section('title', 'Kesuma-GO | Detail Data Siswa')
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
        <div class="col-md-12 col-sm-12">
            <h3><i class="fa fa-male" style="margin-right: 10px; margin-top: 15px;"></i>Detail Data <small>Siswa</small></h3>
            <hr>
        </div>
    </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-male" style="margin-right: 10px; "></i>Detail Data<small>Siswa</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="myDataTable"
                                    class="table table-striped table-bordered dt-responsive nowrap user_datatable"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        No.
                                    </th>
                                   
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="60">
                                        Nomor Pendaftaran
                                    </th>
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
                                        Username
                                    </th>
                                  
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="200">
                                        Hak Akses
                                    </th>
                                  
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                
                                    <button type="button" onclick="window.location.href = '/siswaall'"
                                        class="btn btn-danger">Kembali</button>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        iForm('hal_index');

        function iForm(iv) {
            $('#hal_index').hide();
            $('#hal_edit').hide();
            $('#' + iv).show();
        }
</script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('siswaex.index') }}",
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
                        data: 'listakunsiswa.username',
                        name: 'listakunsiswa.username'
                    },
                  
                    {
                        data: 'listakunsiswa.hakakses',
                        name: 'listakunsiswa.hakakses'
                    }


                    
                ]
            });
        });
      
    </script>
    <script
     < type="text/javascript">
        $(document).ready(function() {
            var table = $('myDataTable').DataTable({
                "pageLength": 10, // Menampilkan 10 data per halaman secara default
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
            });
    
            // Menambahkan opsi "Semua" ke dalam dropdown "Show entries"        
            $('.dataTables_length select').append('<option value="-1">Semua</option>');
    
            // Mengubah tampilan "Semua" menjadi teks yang lebih jelas
            $('.dataTables_length select option[value="-1"]').text('Semua');
    
            // Mengatur agar tabel menampilkan semua entri saat "Semua" dipilih
            $('.dataTables_length select').change(function () {
                var selectedValue = $(this).val();
                if (selectedValue == -1) {
                    table.page.len(-1).draw();
                } else {
                    table.page.len(selectedValue).draw();
                }
            });
        });
    </>

</script>
@endsection












