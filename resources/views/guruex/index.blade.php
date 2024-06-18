@extends('index')
@section('title', 'Kesuma-GO | Data Lengkap Guru')
@section('content')
    @include('guruall.create')
    <style>
        .table th,
        .table td {
            text-align: center;
        }

        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }

        .hidden {
            display: none;
        }
    </style>
  <div class="row" id="hal_index">
    <div class="card-header bg-dark text-white">
        <h3><i class="fa fa-book"style="margin-right: 10px; margin-top: 15px;"></i>Data Lengkap <small> Tenaga Pengajar</small></h3>
       
</div>
</div>
<hr>
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-eyedropper" style="margin-right: 10px; "></i>Data Lengkap<small>Guru</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-buttons"
                                    class="table table-striped table-bordered dt-responsive nowrap user_datatable"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                No.
                                            </th>
                                           
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Nama Guru
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Tempat Lahir
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Tanggal Lahir
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                            class="lebar-kolom"width="60" ;>
                                            Agama
                                        </th>
                                        <th scope="col" style="text-align: center; font-size: 13px;"
                                            class="lebar-kolom"width="60" ;>
                                            Jenis Kelamin
                                        </th>
                                    
                                        <th scope="col" style="text-align: center; font-size: 13px;"
                                            class="lebar-kolom"width="60" ;>
                                            Tugas Mengajar
                                        </th>
                                        <th scope="col" style="text-align: center; font-size: 13px;"
                                            class="lebar-kolom"width="60" ;>
                                            Nomor Telephone
                                        </th>
                                        <th scope="col" style="text-align: center; font-size: 13px;"
                                            class="lebar-kolom"width="60" ;>
                                            Alamat
                                        </th>
                                        <th scope="col" style="text-align: center; font-size: 13px;"
                                            class="lebar-kolom"width="60" ;>
                                            Email
                                        </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Status Pegawai
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                NIP atau NIPS
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                NUPTK
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                NIK
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                NPWP
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Nomor Sertifikat Pendidik
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Tahun Sertifikasi
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Pangkat Golongan Terakhir
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Jadwal Kenaikan Pangkat
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Jadwal Kenaikan Gaji
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Tanggal Mulai Tugas
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Pendidikan Akhir
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Tahun Tamat
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Jurusan
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Tugas Tambahan
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Jam Per Minggu
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Tahun Pensiun
                                            </th>
                                            {{-- <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Berkala
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Pangkat
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Jabatan
                                            </th> --}}
                                           
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Username
                                            </th>
                                          
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Hak Akses
                                            </th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                   
                                    <button type="button" onclick="window.location.href = '/guruall'"
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
                    url: "{{ route('guruex.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'guru_id',
                        name: 'guru_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                  
                    {
                        data: 'Nama',
                        name: 'Nama'
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
                        data: 'Agama',
                        name: 'Agama'
                    },
                    {
                        data: 'JenisKelamin',
                        name: 'JenisKelamin'
                    },
                 
                    {
                        data: 'TugasMengajar',
                        name: 'TugasMengajar'
                    },
                   
                    {
                        data: 'NomorTelephone',
                        name: 'NomorTelephone'
                    },
                    {
                        data: 'Alamat',
                        name: 'Alamat'
                    },
                    {
                        data: 'Email',
                        name: 'Email'
                    },
                    {
                        data: 'StatusPegawai',
                        name: 'StatusPegawai'
                    },
                    {
                        data: 'NipNips',
                        name: 'NipNips'
                    },
                    {
                        data: 'Nuptk',
                        name: 'Nuptk'
                    },
                    {
                        data: 'Nik',
                        name: 'Nik'
                    },
                    {
                        data: 'Npwp',
                        name: 'Npwp'
                    },
                    {
                        data: 'NomorSertifikatPendidik',
                        name: 'NomorSertifikatPendidik'
                    },
                    {
                        data: 'TahunSertifikasi',
                        name: 'TahunSertifikasi'
                    },
                    {
                        data: 'pangkatgt',
                        name: 'pangkatgt'
                    },
                    {
                        data: 'jadwalkenaikanpangkat',
                        name: 'jadwalkenaikanpangkat'
                    },
                    {
                        data: 'jadwalkenaikangaji',
                        name: 'jadwalkenaikangaji'
                    },
                    {
                        data: 'TMT',
                        name: 'TMT'
                    },
                    {
                        data: 'PendidikanAkhir',
                        name: 'PendidikanAkhir'
                    },
                    {
                        data: 'TahunTamat',
                        name: 'TahunTamat'
                    },
                    {
                        data: 'Jurusan',
                        name: 'Jurusan'
                    },
                    {
                        data: 'TugasTambahan',
                        name: 'TugasTambahan'
                    },
                    {
                        data: 'JamPerMinggu',
                        name: 'JamPerMinggu'
                    },
                    {
                        data: 'TahunPensiun',
                        name: 'TahunPensiun'
                    },
                    // {
                    //     data: 'Berkala',
                    //     name: 'Berkala'
                    // },
                    // {
                    //     data: 'Pangkat',
                    //     name: 'Pangkat'
                    // },
                    // {
                    //     data: 'Jabatan',
                    //     name: 'Jabatan'
                    // },
                  
                    {
                        data: 'listakun.username',
                        name: 'listakun.username'
                    },
             
                    {
                        data: 'listakun.hakakses',
                        name: 'listakun.hakakses'
                    }
                ]
            });
        });
     
    </script>
  
@endsection
