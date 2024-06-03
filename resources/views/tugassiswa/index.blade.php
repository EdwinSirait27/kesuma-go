
@extends('index')
@section('title', 'Kesuma-GO | Data Tugas')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Data Tugas</h3>
                    @foreach ($datakelasdatamengajars->unique('datakelas.tahun.tahunakademik') as $data)
                    <h5>Tahun Akademik : {{ $data->datakelas->tahun->tahunakademik }}</h5>
                @endforeach
                    @foreach ($datakelasdatamengajars->unique('datakelas.tahun.kurikulum.Nama_Kurikulum') as $data)
                    <h5>Kurikulum : {{ $data->datakelas->tahun->kurikulum->Nama_Kurikulum }}</h5>
                @endforeach
                    <h5>Nama Lengkap : {{ $NamaLengkap }}</h5>
                    @foreach ($datakelasdatamengajars->unique('datakelas.kelas.namakelas') as $data)
                    <h5>Kelas : {{ $data->datakelas->kelas->namakelas }}</h5>
                @endforeach
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
                                        <th>Nama Guru</th>        
                                        <th>Nama Mata Pelajaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($datakelasdatamengajars as $data)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->datamengajar->Guru->Nama}}</td>
                                            <td>{{ $data->datamengajar->matpel->MataPelajaran}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                    <div class="button-container mt-3">
                            <!-- Button to visit website -->
                            <a href="/lihattugas" class="btn btn-success" > Lihat Tugas</a>
                        
                        <button type="button" onclick="window.location.href = '/SiswaBeranda'"
                            class="btn btn-dark">Kembali</button>
                        {{-- <a href="{{ route('ekstrakulikulersiswa.list') }}" class="btn btn-primary">Daftar</a> --}}
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
