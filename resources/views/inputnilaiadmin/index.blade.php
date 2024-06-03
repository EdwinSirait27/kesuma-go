@extends('index')
@section('title', 'Kesuma-GO | Input Nilai Siswa')

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
        }

        .text-success,
        .text-danger {
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .text-success {
            background-color: green;
        }

        .text-danger {
            background-color: red;
        }
        
    #tahun_akademik_filter {
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
    }


</style>
    <div class="row">
        <div class="col-md-12">
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px;"></i> Input Nilai Siswa</h3>
            <hr>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title row">
                    <div class="col-md-8">
                        <h2><i class="fa fa-bar-chart" style="margin-right: 10px;"></i> Input Nilai Siswa</h2>
                    </div>
                    <div class="col-md-4">
                        <select id="tahun_akademik_filter" class="form-control">
                            <option value="">Pilih Tahun Akademik</option>
                            @foreach($tahunAkademiks as $tahunAkademik)
                                <option value="{{ $tahunAkademik->tahunakademik_id }}">{{ $tahunAkademik->tahunakademik }} - {{ $tahunAkademik->semester }}</option>
                            @endforeach
                        </select>
                     
                    </div>
                </div>
                
                {{-- <div class="x_title">
                    <select id="tahun_akademik_filter">
                        <option value="">Pilih Tahun Akademik</option>
                        @foreach($tahunAkademiks as $tahunAkademik)
                            <option value="{{ $tahunAkademik->tahunakademik_id }}">{{ $tahunAkademik->tahunakademik }} - {{ $tahunAkademik->semester }}</option>
                        @endforeach
                    </select>
                    <h2><i class="fa fa-bar-chart" style="margin-right: 10px;"></i> Input Nilai Siswa</h2>
                    <div class="clearfix"></div>
                </div> --}}
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered user_datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Akademik</th>
                                    <th>Kelas</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            @if (auth()->user()->hakakses == 'Admin')
                                <button type="button" onclick="window.location.href = '/AdminBeranda'"
                                    class="btn btn-danger">Kembali</button>
                            @endif
                            @if (auth()->user()->hakakses == 'KepalaSekolah')
                                <button type="button" onclick="window.location.href = '/KepalaSekolahBeranda'"
                                    class="btn btn-danger">Kembali</button>
                            @endif
                            @if (auth()->user()->hakakses == 'Kurikulum')
                                <button type="button" onclick="window.location.href = '/KurikulumBeranda'"
                                    class="btn btn-danger">Kembali</button>
                            @endif
                            @if (auth()->user()->hakakses == 'Guru')
                                <button type="button" onclick="window.location.href = '/GuruBeranda'"
                                    class="btn btn-danger">Kembali</button>
                            @endif
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
            // Inisialisasi DataTables
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('inputnilaiadmin.index') }}",
                    method: "GET"
                },
                columns: [
                    { data: 'index_increment', name: 'index_increment' },
                    {
                        data: 'tahunakademik.tahunakademik',
                        name: 'tahunakademik.tahunakademik'
                    },
                    {
                        data: 'datakelas.kelas.namakelas',
                        name: 'datakelas.kelas.namakelas'
                    },
                    {
                        data: 'datamengajar.matpel.MataPelajaran',
                        name: 'datamengajar.matpel.MataPelajaran'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
    
            // Menggunakan event onchange untuk menangani perubahan pada dropdown tahun akademik
            $('#tahun_akademik_filter').on('change', function() {
                var tahunAkademikId = $(this).val(); // Mendapatkan nilai tahun akademik yang dipilih
                table.ajax.url("{{ route('inputnilaiadmin.index') }}?tahunakademik_id=" + tahunAkademikId).load(); // Mengubah URL Ajax dan memuat ulang tabel
            });
        });
    </script>
    
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('inputnilaiadmin.index') }}",
                    method: "GET"
                },
                columns: [
                    { data: 'index_increment', name: 'index_increment' },
                    {
                        data: 'tahunakademik.tahunakademik',
                        name: 'tahunakademik.tahunakademik'
                    },
                    {
                        data: 'datakelas.kelas.namakelas',
                        name: 'datakelas.kelas.namakelas'
                    },
                 
                   
                    {
                        data: 'datamengajar.matpel.MataPelajaran',
                        name: 'datamengajar.matpel.MataPelajaran'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script> --}}

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('myDataTable').DataTable({
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "Semua"]
            ]
        });
        $('.dataTables_length select').append('<option value="-1">Semua</option>');
        $('.dataTables_length select option[value="-1"]').text('Semua');
        $('.dataTables_length select').change(function() {
            var selectedValue = $(this).val();
            if (selectedValue == -1) {
                table.page.len(-1).draw();
            } else {
                table.page.len(selectedValue).draw();
            }
        });
    });
    $(document).on({
        mouseenter: function () {
            $(this).addClass('btn-hover');
        },
        mouseleave: function () {
            $(this).removeClass('btn-hover');
        }
    }, '.btn-success');
</script>
@endsection




{{-- @extends('index')
@section('title', 'Kesuma-GO | Daftar Siswa')
@section('content')
    @include('organisasi.create')
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
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Input Nilai <small>Siswa</small></h3>
            <hr>
        </div>
    </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart" style="margin-right: 10px; "></i>Input Nilai<small>Siswa</small></h2>
            
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table class="table table-striped table-bordered user_datatable">
                            <thead>
                                <tr>
                          
                                     <th style="width: 10px"  >No</th>
                                     <th style="width: 30px">Tahun Akademik</th>
                                     <th style="width: 30px">Kelas</th>
                                     <th style="width: 800px">Nama Siswa</th>
                                     <th style="width: 100px">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="form-group row">
                        <div class=r"col-sm-10">
                             @if (auth()->user()->hakakses == 'Admin')
                                            <button type="button" onclick="window.location.href = '/AdminBeranda'"
                                            class="btn btn-danger">Kembali</button>
                                            @endif
                                            @if (auth()->user()->hakakses == 'KepalaSekolah')
                                            <button type="button" onclick="window.location.href = '/KepalaSekolahBeranda'"
                                            class="btn btn-danger">Kembali</button>
                                            @endif

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
    
@endsection
 --}}
