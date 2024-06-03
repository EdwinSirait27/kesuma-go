@extends('index')
@section('title', 'Kesuma-GO | Data Ekstrakurikuler')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-light">
                    <div class="card-header bg-dark text-white">
                        <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Data Ekstrakurikuler</h3>
                        <h5>Nama Lengkap : {{ $namaLengkap }}</h5>
                        <h5>Kelas : {{ $kelas }}</h5>
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
                            <form method="POST" action="{{ route('ekstrakulikulersiswa.hapus') }}">
                                @csrf
                                <table id="ekstrakurikulerTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">No</th>
                                            <th>Nama Ekstrakurikuler</th>
                                            <th>Guru Pembina</th>
                                            <th style="width: 5%;">Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($siswaEkstraGurus as $siswaEkstraGuru)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $siswaEkstraGuru->ekstraguru->ekskul->namaekskul }}</td>
                                                <td>{{ $siswaEkstraGuru->ekstraguru->guru->Nama }}</td>
                                                <td>
                                                    <input class="form-check-input" type="checkbox"
                                                        name="hapusCheckbox[]"
                                                        value="{{ $siswaEkstraGuru->siswa_ekstra_guru_id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                        <div class="button-container mt-3">
                            <button type="submit" class="btn btn-danger">Hapus yang Dipilih</button>
                            <button type="button" onclick="window.location.href = '/SiswaBeranda'"
                                class="btn btn-dark">Kembali</button>
                            <a href="{{ route('ekstrakulikulersiswa.list') }}" class="btn btn-primary">Daftar</a>
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
