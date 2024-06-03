@extends('index')
@section('title', 'Kesuma-GO | Data Organisasi')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Data Organisasi</h3>
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
                        <form method="POST" action="{{ route('organisasisiswa.hapusOrganisasiSiswa') }}">
                            @csrf
                        <table id="ekstrakurikulerTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                   
                                    <th>Nama Ekstrakurikuler</th>
                                    <th>Guru Pembina</th>
                                    <th style="width: 10;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($siswaOrganisasiGurus as $siswaOrganisasiGuru)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $siswaOrganisasiGuru->organisasiguru->organ->nama }}</td>
                                        <td>{{ $siswaOrganisasiGuru->organisasiguru->guru->Nama }}</td>
                                        <td>
                                            <input class="form-check-input" type="checkbox"
                                                name="hapusCheckbox[]"
                                                value="{{ $siswaOrganisasiGuru->siswa_organisasi_guru_id }}">
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
                        <a href="{{ route('organisasisiswa.list') }}" class="btn btn-primary">Daftar</a>
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
@section('title', 'Kesuma-GO | Data Ekstrakulikuler')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Data Ekstrakulikuler</h3>
                    <h5>Nama Lengkap : {{ $namaLengkap }}</h5>
                    <h5>Kelas : {{ $kelas }}</h5>
                </div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="table-responsive">
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
                                @foreach ($ekstrakurikulerSiswa as $index => $ekstrakurikuler)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $ekstrakurikuler->ekstraguru->ekskul->namaekskul }}</td>
                                    <td>{{ $ekstrakurikuler->ekstraguru->guru->Nama }}</td>
                                    <td><input type="checkbox" name="hapusCheckbox[]" value="{{ $ekstrakurikuler->id }}" class="hapus-checkbox"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="button-container mt-3">
                        <form id="hapusForm" action="{{ route('ekstrakurikuler.hapus') }}" method="POST">
                            @csrf <!-- Tambahkan token CSRF untuk validasi -->
                            <button type="button" onclick="window.location.href = '/SiswaBeranda'" class="btn btn-danger">Kembali</button>
                            <a href="{{ route('ekstrakulikulersiswa.list') }}" class="btn btn-primary">Daftar</a>
                            <button type="button" class="btn btn-danger" id="hapusButton">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#hapusButton').on('click', function() {
            if ($('.hapus-checkbox:checked').length > 0) {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menghapus ekstrakurikuler terpilih?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#hapusForm').submit();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Pilih setidaknya satu ekstrakurikuler untuk dihapus.'
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#ekstrakurikulerTable').DataTable({
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
                }
            ]
        });

     
    });
</script>
@endsection --}}
