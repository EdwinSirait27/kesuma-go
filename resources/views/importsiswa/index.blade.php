@extends('index')
@section('title', 'Kesuma-GO | Data Kelas Siswa')
@section('content')
    <style>
        .table th,
        .table td {
            text-align: center;
        }
        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }
        .btn-custom {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Kelas Siswa</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form id="importForm" method="POST" action="{{ route('importsiswa.update') }}">
                                @csrf
                            
                            <table class="table table-striped table-bordered user_datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 5%">No.</th>
                                        <th scope="col">Nama Siswa</th>
                                        <th scope="col" style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                            <button type="submit" class="btn btn-success " onclick="return confirmImpor()">Impor Siswa Terpilih</button>
                            <button type="button" class="btn btn-primary" onclick="checkAll()">Check All</button>
                            <button type="button" class="btn btn-secondary" onclick="uncheckAll()">Uncheck All</button>
                            <button type="button" class="btn btn-danger " onclick="window.location.href = '{{ auth()->user()->hakakses == 'Admin' ? '/AdminBeranda' : '/KepalaSekolahBeranda' }}'">Kembali</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script type="text/javascript">
       function checkAll() {
        $('.user_datatable tbody input[type="checkbox"]').prop('checked', true);
    }
function uncheckAll() {
        $('.user_datatable tbody input[type="checkbox"]').prop('checked', false);
    }
    $(document).ready(function() {
    var table = $('.user_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('importsiswa.index') }}",
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
                data: 'NamaLengkap',
                name: 'NamaLengkap'
            },
            {
                data: 'checkbox',
                name: 'checkbox',
                orderable: false,
                searchable: false
            }
        ],
        lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "All"] ], // Menambahkan opsi "Show All"
        pageLength: 10 // Menetapkan panjang halaman default
    });
});

        function confirmImpor() {
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan mengimpor siswa terpilih!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Impor!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form
                    document.getElementById("importForm").submit();
                }
            });
            return false; 
        }
    </script>
@endsection


{{-- @extends('index')
@section('title', 'Kesuma-GO | Data Kelas Siswa')
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
    </style>
   <form method="POST" action="{{ route('importsiswa.update') }}">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table class="table table-striped table-bordered user_datatable">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center; width: 5px; font-size: 13px; max-width: 10px;">No.</th>
                            <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">Nama Organisasi</th>
                            <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    @if (auth()->user()->hakakses == 'Admin')
                    <button type="button" onclick="window.location.href = '/AdminBeranda'" class="btn btn-danger">Kembali</button>
                    @endif
                    @if (auth()->user()->hakakses == 'KepalaSekolah')
                    <button type="button" onclick="window.location.href = '/KepalaSekolahBeranda'" class="btn btn-danger">Kembali</button>
                    @endif
                </div>
            </div>
            <form method="POST" action="{{ route('importsiswa.update') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Impor Siswa Terpilih</button>
                    </div>
                </div>
            </form>      
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('.user_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('importsiswa.index') }}",
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
                    data: 'NamaLengkap',
                    name: 'NamaLengkap'
                },
                {
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endsection --}}
