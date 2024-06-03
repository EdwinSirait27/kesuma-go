@extends('index')
@section('title', 'Kesuma-GO | Data Tugas Siswa')
@section('content')
    @include('cektugas.create')
    <style>
        .table th,
        .table td {

            text-align: center;

        }

        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }

        .col-form-label {
            font-size: 18px;
            /* Ganti dengan ukuran font yang Anda inginkan */
        }

        .text-success {
            color: rgb(255, 0, 0);
            /* Warna teks putih untuk kontras */
            background-color: rgb(0, 0, 0);
            /* Warna latar belakang hitam (tanpa opasitas) */
            padding: 5px 10px;
            /* Padding untuk estetika */
            border-radius: 5px;
            /* Sudut bulat untuk estetika */
        }


        .text-danger {
            background-color: rgb(0, 0, 0);
            /* Warna latar belakang merah (tanpa opasitas) */
            color: rgb(255, 0, 0);
            /* Warna teks untuk kontras */
            padding: 5px 10px;
            /* Padding untuk estetika */
            border-radius: 5px;
            /* Sudut bulat untuk estetika */
        }
    </style>
    <div class="row" id="hal_index">
        <div class="card-header bg-dark text-white">
            <h3><i class="fa fa-users"style="margin-right: 10px; margin-top: 15px;"></i>Pengumpulan <small>Tugas</small></h3>
        
            @if(isset($tugas_id))
            <p>Tugas ID: {{ $tugas_id }}</p>
        @endif
        
    
    </div>
    </div>
    <hr>
    <div class="x_panel">
        <div class="x_title">
            
            <h2><i class="fa fa-bar-chart" style="margin-right: 10px; "></i>Pengumpulana<small>Tugas</small></h2>
            
            
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table class="table table-striped table-bordered user_datatable">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        style="text-align: center; width: 5px; font-size: 13px; max-width: 10px;">
                                        No.
                                    </th>

                                
                                    
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Mata Pelajaran
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Nama Siswa
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Kelas
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Tugas Siswa
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Tanggal Pengumpulan
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Status
                                    </th>
                                    {{-- <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Mata Pelajaran
                                    </th>
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                       Tugas Anda
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Tanggal Mengumpul
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Status
                                    </th> --}}
                                    <th scope="col" style="text-align: center; width: 10px; font-size: 13px;">
                                        Action
                                    </th>
                                  
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="form-group row">
                        <div class=r"col-sm-10">
                          
                                            <button type="button" onclick="window.location.href = '/tugasguru'"
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

        function tambah() {
            $('#txt_id').val(0);
            $('#siswa_id').val('');
            $('#tugas_id').val('');
           $('#dokumen').val('');
            $('#tanggal').val('');

            iForm('hal_edit');
        }

        function editAndShow(iv, id) {
    $.ajax({
        url: "/cektugas-edit2/" + id,
        type: "GET",
        success: function(data) {
            $('#txt_id').val(id);
            $('#tugas_id').val(data.tugas_id);
            $('#siswa_id').val(data.siswa_id);
           
            if (data.dokumen) {
                $('#info_dokumen').text('Dokumen: ' + data.dokumen);
            } else {
                $('#info_dokumen').text('Tidak ada dokumen terlampir');
            }
           $('#tanggal').val(data.tanggal);
            iForm('hal_edit');
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}
function saveChanges() {
            var id = $('#txt_id').val();
            var tugas_id = $('#tugas_id').val();
            var siswa_id = $('#siswa_id').val();
            var tanggal = $('#tanggal').val();
            var data = {
                id: id,
                tugas_id: tugas_id,
                siswa_id: siswa_id,
                tanggal: tanggal
            };

            $.ajax({
                url: "/cektugas-save",
                type: "POST",
                data: data,
                success: function(response) {
                    // Tindakan setelah berhasil menyimpan perubahan
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function setData(data) {
            // Kode pengisian data yang lain...
            $('#txt_id').val(data.txt_id);
            $('#tugas_id').val(data.tugas_id);
            $('#siswa_id').val(data.siswa_id);
            $('#tanggal').val(data.tanggal);
            // Mengembalikan deferred object agar $.when() mengetahui bahwa pengisian data selesai
            return $.Deferred().resolve().promise();
        }
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
    var table = $('.user_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('cektugas.index') }}",
            method: "GET"
        },
        columns: [{
                        data: 'pengumpulan_id',
                        name: 'pengumpulan_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'tugas.datakelasdatamengajar.datamengajar.matpel.MataPelajaran',
                        name: 'tugas.datakelasdatamengajar.datamengajar.matpel.MataPelajaran'
                    },
                      {
                        data: 'siswa.NamaLengkap',
                        name: 'siswa.NamaLengkap'
                    },
                      {
                        data: 'siswa.kelas.namakelas',
                        name: 'siswa.kelas.namakelas'
                    },
                    {
                        data: 'dokumen',
                        name: 'dokumen'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                  
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
            // Kolom-kolom Anda di sini...
        ],
       
    });
});
      
      
      
      
   
    </script>
  
@endsection


{{-- // {
    //     data: 'tugas.datakelasdatamengajar.datamengajar.guru.Nama',
    //     name: 'tugas.datakelasdatamengajar.datamengajar.guru.Nama'
    // },
    // {
    //     data: 'tugas.datakelasdatamengajar.datamengajar.matpel.MataPelajaran',
    //     name: 'tugas.datakelasdatamengajar.datamengajar.matpel.MataPelajaran'
    // },
    // {
    //     data: 'tugas.keterangan',
    //     name: 'tugas.keterangan'
    // },
    // {
    //     data: 'tanggal',
    //     name: 'tanggal'
    // },
    // {
    //     data: 'status',
    //     name: 'status'
    // }, --}}