
@extends('index')

@section('title', 'Kesuma-GO | List Organisasi')

@section('content')
@if (auth()->user()->hakakses == 'Admin' || auth()->user()->hakakses == 'KepalaSekolah')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data <small>Organisasi</small></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Tahun Akademik : {{ $tahunakademik }}</h4>
                            <h4>Semester : {{ $semester }}</h4>
                            <h4>Guru Pembina : {{ $namaGuru }}</h4>
                            <h4>Oranisasi :  {{ $namaorgan }}</h4>
                            <h4>Kapasitas :  {{ $kapasitas }}</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" onclick="history.back();" class="btn btn-danger btn-hover">Kembali</button>
                        
                                <a href="{{ route('downloadddd', ['organisasi_guru_siswa_id' => $organisasi_guru_siswa_id]) }}" class="btn btn-success" >Download Data</a>
                          
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(isset($siswas) && count($siswas) > 0)
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('listorganisasi.hapus') }}">
                                    @csrf
                                    <table class="table table-striped table-bordered" id="siswaTable">
                                        <thead class="thead-white">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Siswa</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($siswas as $siswa)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $siswa->siswa->NamaLengkap }}</td>
                                                <td>{{ $siswa->siswa->kelas->namakelas }}</td>
                                                
                                                    <td><input type="checkbox" name="siswa_ids[]" value="{{ $siswa->siswa_organisasi_guru_id }}"></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-danger btn-hover">Hapus Siswa Terpilih</button>
                                </form>
                                
                        </div>
                    @else
                        <div class="alert alert-info">
                            Tidak ada siswa yang terdaftar dalam Ekstrakulikuler ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#siswaTable').DataTable({
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "Semua"]
            ],
            "pageLength": 10,
            "dom": 'lBfrtip',
            "buttons": [
                {
                    extend: 'copy',
                    text: 'Salin'
                },
                {
                    extend: 'csv',
                    text: 'CSV'
                },
                {
                    extend: 'excel',
                    text: 'Excel'
                },
            ]
        });
    });
</script>
<style>
    /* Hover effect for buttons */
    .btn-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Transition effect for table */
    table {
        transition: all 0.3s ease;
    }

    table:hover {
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
</style>
@endif
@if (auth()->user()->hakakses == 'Guru' || auth()->user()->hakakses == 'Siswa'|| auth()->user()->hakakses == 'Kurikulum')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data <small>Organisasi</small></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Guru Pembina : {{ $namaGuru }}</h4>
                            <h4>Oranisasi :  {{ $namaorgan }}</h4>
                            <h4>Kapasitas :  {{ $kapasitas }}</h4>
                        </div>
                        <div class="col-md-6 text-right">
           
                            @if(isset($siswas) && count($siswas) > 0)
                              
                            @else
                                <button class="btn btn-success" disabled>Download Data</button>
                                <span class="text-danger">Tidak ada data yang dapat diunduh.</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(isset($siswas) && count($siswas) > 0)
                            <div class="table-responsive">
                                <form action="{{ route('hapus_siswa') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                <table class="table table-striped table-bordered" id="siswaTable">
                                    <thead class="thead-white">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Siswa</th>
                                          
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siswas as $index => $siswa)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $siswa ? $siswa->siswa->NamaLengkap : 'Siswa tidak ditemukan' }}</td>
                                             
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                               
                            </div>
                            {{-- <button type="submit" class="btn btn-danger mt-2">Hapus yang Dipilih</button> --}}                 <button type="button" onclick="history.back();" class="btn btn-danger btn-hover">Kembali</button>
                        </form>
                    @else
                        <div class="alert alert-info">
                            Tidak ada siswa yang terdaftar dalam Ekstrakulikuler ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#siswaTable').DataTable({
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "Semua"]
            ],
            "pageLength": 10,
            "dom": 'lBfrtip',
            "buttons": [
                // {
                //     extend: 'copy',
                //     text: 'Salin'
                // },
                // {
                //     extend: 'csv',
                //     text: 'CSV'
                // },
                // {
                //     extend: 'excel',
                //     text: 'Excel'
                // },
            ]
        });
    });
</script>
<style>
    /* Hover effect for buttons */
    .btn-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Transition effect for table */
    table {
        transition: all 0.3s ease;
    }

    table:hover {
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
</style>
@endif
@endsection
