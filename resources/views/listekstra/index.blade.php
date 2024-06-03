@extends('index')
@section('title', 'Kesuma-GO | List Ekstrakulikuler')
@section('content')
<style>
    /* CSS untuk hover effect pada tombol */
.btn-hover:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* CSS untuk shadow effect pada tabel saat dihover */
table {
    transition: all 0.3s ease;
}

table:hover {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

</style>
@if (auth()->user()->hakakses == 'KepalaSekolah'||auth()->user()->hakakses == 'Admin')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data <small>Ekstrakulikuler</small>
                        </h3>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Tahun Akademik : {{ $tahunakademik }}</h4>
                                <h4>Semester : {{ $semester }}</h4>
                                <h4>Guru Pembina : {{ $namaGuru }}</h4>
                                <h4>Ekstrakulikuler : {{ $namaekskul }}</h4>
                                
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" onclick="history.back();"
                                    class="btn btn-danger btn-hover">Kembali</button>
                                @if (isset($siswas) && count($siswas) > 0)
                                    <a href="{{ route('downloadd', ['ekstra_guru_id' => $ekstra_guru_id]) }}"
                                        class="btn btn-success">Download Data</a>
                                @else
                                    <button class="btn btn-success" disabled>Download Data</button>
                                    <span class="text-danger">Tidak ada data yang dapat diunduh.</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (isset($siswas) && count($siswas) > 0)
                            <div class="table-responsive">
                                <form action="{{ route('listekstra.hapus') }}" method="POST">
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
                                            @foreach ($siswas as $siswa)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $siswa->siswa->NamaLengkap }}</td>
                                                    <td>{{ $siswa->siswa->kelas->namakelas }}</td>

                                                    <td><input type="checkbox" name="siswa_ids[]"
                                                            value="{{ $siswa->siswa_ekstra_guru_id }}"></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <button type="submit"class="btn btn-danger btn-hover">Hapus Siswa Terpilih</button>
                            </div>
                         
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
        $(document).ready(function() {
            var table = $('#siswaTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "pageLength": 10,
                "dom": 'lBfrtip',
                "buttons": [{
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
table {
            transition: all 0.3s ease;
        }
        table:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
    </style>
    @endif
    @if (auth()->user()->hakakses == 'Siswa'||auth()->user()->hakakses == 'Guru'||auth()->user()->hakakses == 'Kurikulum')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data <small>Ekstrakulikuler</small>
                        </h3>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Tahun Akademik : {{ $tahunakademik }}</h4>
                                <h4>Semester : {{ $semester }}</h4>
                                <h4>Guru Pembina : {{ $namaGuru }}</h4>
                                <h4>Ekstrakulikuler : {{ $namaekskul }}</h4>
                                
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" onclick="history.back();"
                                    class="btn btn-danger btn-hover">Kembali</button>
                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (isset($siswas) && count($siswas) > 0)
                            <div class="table-responsive">
                                   
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
                                            @foreach ($siswas as $siswa)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $siswa->siswa->NamaLengkap }}</td>
                                                    <td>{{ $siswa->siswa->kelas->namakelas }}</td>

                                                    <td><input type="checkbox" name="siswa_ids[]"
                                                            ></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- <button type="submit"class="btn btn-danger btn-hover">Hapus Siswa Terpilih</button> --}}
                            </div>
                         
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
        $(document).ready(function() {
            var table = $('#siswaTable').DataTable({
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
    <style>
        /* Hover effect for buttons */
        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
table {
            transition: all 0.3s ease;
        }
        table:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
    </style>
    @endif
@endsection
