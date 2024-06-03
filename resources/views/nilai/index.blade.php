@extends('index')
@section('title', 'Kesuma-GO | Data Kelas Siswa')
@section('content')
    @include('nilai.create')
    <style>
        /* CSS styling */
        .table th,
        .table td {
            text-align: center;
        }

        .user_datatable tbody tr:hover {
            background-color: lightyellow;
            transition: background-color 0.3s;
        }

        .col-form-label {
            font-size: 18px;
        }

        .text-success {
            color: rgb(255, 0, 0);
            background-color: rgb(0, 0, 0);
            padding: 5px 10px;
            border-radius: 5px;
        }

        .text-danger {
            background-color: rgb(0, 0, 0);
            color: rgb(255, 0, 0);
            padding: 5px 10px;
            border-radius: 5px;
        }

        .card {
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            margin-bottom: 20px;
        }

        .card:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: #f5f5f5;
            padding: 10px 20px;
            border-bottom: 1px solid #eee;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .btn-back {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            background: #ff3f34;
            color: #fff;
            border: none;
            transition: background 0.3s ease;
        }

        .btn-back:hover {
            background: #ff6859;
        }

        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left-color: #333;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="row" id="hal_index">
        <div class="col-md-12 col-sm-12">
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Nilai <small>Siswa</small></h3>
            <hr>
        </div>
    </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart" style="margin-right: 10px; "></i>Nilai<small>Siswa</small></h2>

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
                                        Nama Siswa
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Kelas
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Mata Pelajaran
                                    </th>

                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Nilai
                                    </th> 
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
    <div class="loading-overlay" id="loading-overlay" style="display: none;">
        <div class="loading-spinner"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // JavaScript function to toggle between different sections
        function toggleSection(sectionId) {
            $('.section').hide();
            $('#' + sectionId).show();
        }

        // Show notification when 'Kembali' button is clicked
        $(document).on('click', '.btn-back', function() {
            Swal.fire({
                icon: 'info',
                title: 'Anda akan kembali...',
                text: 'Anda akan dialihkan ke halaman beranda sesuai hak akses Anda!',
                showConfirmButton: false,
                timer: 2000
            });
        });

        // Show loading overlay when DataTable is processing
        $(document).on('processing.dt', function(e, settings, processing) {
            $('#loading-overlay').toggle(processing);
        });

        // Initialize DataTable
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('nilai.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'nilai_id',
                        name: 'nilai_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'siswa.NamaLengkap',
                        name: 'siswa.NamaLengkap'
                    },
                    {
                        data: function(row) {
                            return row.siswa && row.siswa.kelas ? row.siswa.kelas.namakelas : 'Belum Masuk Kelas';
                        },
                        name: 'siswa.kelas.namakelas'
                    },
                    {
                        data: function(row) {
                            return row.datakelasdatamengajar && row.datakelasdatamengajar.datamengajar.matpel ? row.datakelasdatamengajar.datamengajar.matpel.MataPelajaran : 'Belum Ada';
                        },
                        name: 'datakelasdatamengajar.datamengajar.matpel'
                    },
                    {
                        data: function(row) {
                            return row.nilaiuts && row.nilaiuts ? row.nilaiuts : 'Belum Ada';
                        },
                        name: 'nilaiuts'
                    }
                  
                 
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                pageLength: 10
            });
        });
    </script>
@endsection


{{-- @extends('index')
@section('title', 'Kesuma-GO | Data Kelas Siswa')
@section('content')
    @include('nilai.create')
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
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Nilai <small>Siswa</small></h3>
            <hr>
        </div>
    </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart" style="margin-right: 10px; "></i>Nilai<small>Siswa</small></h2>

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
                                        Nama Siswa
                                    </th>

                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Kelas
                                    </th> 
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
                    url: "{{ route('nilai.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'nilai_id',
                        name: 'nilai_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                    {
                        data: 'siswa.NamaLengkap',
                        name: 'siswa.NamaLengkap'
                    },
                    {
    data: function (row) {
        return row.siswa && row.siswa.kelas ? row.siswa.kelas.namakelas : 'Belum Masuk Kelas';
    },
    name: 'siswa.kelas.namakelas'
}
                ],
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        pageLength: 10
    });
});
    </script>
@endsection --}}
