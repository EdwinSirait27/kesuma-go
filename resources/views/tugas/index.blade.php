@extends('index')
@section('title', 'Kesuma-GO | Data Tugas')
@section('content')
<style>
.disabled {
    pointer-events: none;
    opacity: 0.6;
    cursor: not-allowed;
}

</style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-light">
                    <div class="card-header bg-dark text-white">
                        <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Data Tugas</h3>
                        <h5>Nama Lengkap : {{ $Nama }}</h5>
                        <h2>Tanggal dan Waktu Realtime : {{ $formattedDateTime }}</h2>
           
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <form method="POST" >
                                @csrf
                                <table id="ekstrakurikulerTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">No</th>
                                            <th>Nama Mata Pelajaran</th>
                                            <th>Kelas</th>        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($datakelasdatamengajars as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->datamengajar->matpel->MataPelajaran}}</td>
                                                <td>
                                                    @if(isset($data->datamengajar->kelas->namakelas) && !empty($data->datamengajar->kelas->namakelas))
                                                        {{ $data->datamengajar->kelas->namakelas }}
                                                    @else
                                                        Belum di Set
                                                    @endif
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                        <div class="button-container mt-3">
                            @if(isset($data->datamengajar->kelas->namakelas) && !empty($data->datamengajar->kelas->namakelas))
                            <a href="/tugasguru" class="btn btn-success">Tambah Tugas</a>
                        @else
                            <a href="#" class="btn btn-success disabled" onclick="return false;">Tambah Tugas</a>
                        @endif
                        
                            
                            <button type="button" onclick="window.location.href = '/SiswaBeranda'"
                                class="btn btn-dark">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#ekstrakurikulerTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "pageLength": 10,
                "dom": 'lBfrtip',
                "buttons": [
                ]
            });
        });
    </script>
@endsection
{{-- @extends('index')
@section('title', 'Kesuma-GO | Data Tugas')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-light">
                    <div class="card-header bg-dark text-white">
                        <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Data Tugas</h3>
                        <h5>Nama Lengkap : {{ $Nama }}</h5>
                        <h1>Tanggal dan Waktu Saat Ini (Asia/Makassar)</h1>
                        <p>{{ $formattedDateTime }}</p>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <form method="POST" >
                                @csrf
                                <table id="ekstrakurikulerTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">No</th>
                                            <th>Nama Mata Pelajaran</th>
                                            <th>Kelas</th>        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($datakelasdatamengajars as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->datamengajar->matpel->MataPelajaran}}</td>
                                                <td>{{ $data->datamengajar->kelas->namakelas}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                        <div class="button-container mt-3">
                                <a href="/tugasguru" class="btn btn-success" > Tambah Tugas</a>
                            
                            <button type="button" onclick="window.location.href = '/SiswaBeranda'"
                                class="btn btn-dark">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#ekstrakurikulerTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "pageLength": 10,
                "dom": 'lBfrtip',
                "buttons": [
                ]
            });
        });
    </script>
@endsection --}}
