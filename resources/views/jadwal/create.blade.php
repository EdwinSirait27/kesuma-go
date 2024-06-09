@extends('index')
@section('title', 'Kesuma-GO | Data Ekstrakulikuler')
@section('content')
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
<div class="container">
    <div class="row">
        <div class="col-md-12 offset-md-0">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-users" style="margin-right: 10px;"></i>List Mata Pelajaran</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Tahun Akademik : {{ $datakelas->tahun->tahunakademik }}</h5>
                            <h5>Kurikulum : {{ $datakelas->tahun->kurikulum->Nama_Kurikulum }}</h5>
                            <h5>Kelas : {{ $datakelas->kelas->namakelas }}</h5>
                            @php
                            $namaGuru = $datakelas?->guru?->Nama;
                        @endphp
                        
                        @if (!is_null($namaGuru))
                            <h2>Wali Kelas : {{ $namaGuru }}</h2>
                        @else
                            <h2>Wali Kelas : Belum Di Set</h2>
                        @endif
                        
                        
           
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" onclick="window.location.href = '/datakelasadmin'"
                    class="btn btn-danger">Kembali</button>
                   
                </div>
                </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('jadwal.store') }}" method="POST" id="jadwalForm">
                        @csrf
                        @foreach ($siswa_id as $siswa)
                        <input type="hidden" name="siswa_id[]" value="{{ $siswa }}">
                    @endforeach
                    

                    <input type="hidden" name="datakelas_id" value="{{ $datakelas->datakelas_id ?? '' }}">
                    <input type="hidden" name="tahunakademik_id" value="{{ $datakelas->tahunakademik_id ?? '' }}">
                    <input type="hidden" name="kurikulum_id" value="{{ $datakelas->tahun->kurikulum->kurikulum_id ?? '' }}">
                    
                       
                        <table class="table table-bordered" id="mataPelajaranTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Hari</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru Mata Pelajaran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datamengajars as $index =>$datamengajar)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $datamengajar->hari }}</td>
                                        <td>{{ $datamengajar->matpel->MataPelajaran }}</td>
                                        <td>{{ $datamengajar->guru->Nama }}</td>
                                        <td> 
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="datamengajar_id[]" value="{{ $datamengajar->datamengajar_id }}" id="matpel{{ $datamengajar->matpel }}">
                                            </div>
                                        </td>    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                       
                        <div class="text-left">
                           
                            @if (!is_null($datakelas) && isset($datamengajars) && count($datamengajars) > 0)
                            <button type="submit" class="btn btn-success">Daftar</button>
                        @else
                            <button class="btn btn-success" disabled>Daftar</button>
                            <span class="text-danger">Tidak ada data yang dapat didaftar.</span>
                        @endif
                        
                                <button type="button" class="btn btn-primary" id="checkAll">Check All</button>
                                <button type="button" class="btn btn-dark" id="uncheckAll">Uncheck All</button>
                                                        

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


   <script>
    $(document).ready(function() {
        // Check all checkboxes
        $('#checkAll').click(function() {
            $('input[type=checkbox]').prop('checked', true);
        });

        // Uncheck all checkboxes
        $('#uncheckAll').click(function() {
            $('input[type=checkbox]').prop('checked', false);
        });

        // Submit form with confirmation
        $('#jadwalForm').on('submit', function(e) {
            e.preventDefault(); // Menghentikan submit form agar tidak langsung terkirim

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan mendaftar mata pelajaran yang dipilih!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Daftar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, lanjutkan dengan mengirimkan formulir
                    this.submit();
                }
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#mataPelajaranTable').DataTable({
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
