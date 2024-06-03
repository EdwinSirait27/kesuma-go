@extends('index')
@section('title', 'Kesuma-GO | Data Tugas Guru')
@section('content')
    
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
        <div class="col-md-12 col-sm-12">
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Tugas <small>Siswa</small></h3>
            <hr>
        </div>
    </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart" style="margin-right: 10px; "></i>Tugas<small>Siswa</small></h2>
            
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
                                        File
                                    </th>

                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Kelas
                                    </th>

                                  
                                <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                    width="60";>
                                    Keterangan Tugas
                                </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Batas Awal Pengumpulan
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Batas Akhir Pengumpulan
                                    </th>
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
                            <button type="button" onclick="window.location.href = '/pengumpulantugas'"
                            class="btn btn-dark">Input Tugas</button>
                                            <button type="button" onclick="window.location.href = '/tugassiswa'"
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
                    url: "{{ route('lihattugas.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'tugas_id',
                        name: 'tugas_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                  
                 
                    {
                        data: 'datakelasdatamengajar.datamengajar.matpel.MataPelajaran',
                        name: 'datakelasdatamengajar.datamengajar.matpel.MataPelajaran'
                    },
                    
                    {
                        data: 'dokumen',
                        name: 'dokumen'
                    },
                    {
                        data: 'datakelasdatamengajar.datakelas.kelas.namakelas',
                        name: 'datakelasdatamengajar.datakelas.kelas.namakelas'
                    },

                    
                  
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
      
    </script>
@endsection
