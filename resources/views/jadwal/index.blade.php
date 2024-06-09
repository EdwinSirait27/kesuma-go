@extends('index')
@section('title', 'Kesuma-GO | Data Mata Pelajaran')
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
@if (auth()->user()->hakakses == 'Admin')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Data Jadwal Mata Pelajaran</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Tahun Akademik : {{ $datakelas->tahun->tahunakademik }}</h5>
                            <h5>Semester : {{ $datakelas->tahun->semester }}</h5>
                           
                    {{-- <h5>Wali Kelas : {{ $datakelas->guru->Nama }}</h5> --}}
                    @php
                    $namaGuru = $datakelas?->guru?->Nama;
                @endphp
                
                @if (!is_null($namaGuru))
                    <h2>Wali Kelas : {{ $namaGuru }}</h2>
                @else
                    <h2>Wali Kelas : Belum Di Set</h2>
                @endif
                    <h2>Kelas : {{ $datakelas->kelas->namakelas }}</h2>
                   
                
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-danger" onclick="confirmDelete(event)">Hapus</button>
                   
                    @if (!is_null($namaGuru) && isset($datamengajars) && count($datamengajars) > 0)
                    <a href="{{ route('download-pdff', ['datakelasId' => $datakelasId]) }}" class="btn btn-success" download="namafile.pdf">Cetak Jadwal</a>
                @else
                <button class="btn btn-success" disabled>Cetak Jadwal</button>
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

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif 
                    <div class="table-responsive">
                        <form method="POST"id="deleteForm" action="{{ route('hapus') }}">
                            @csrf
                            @method('DELETE')
                            <table id="jadwalTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>
                                            Hari
                                        </th>
                                        <th>Mata Pelajaran</th>
                                        <th>Nama Guru</th>
                                        <th>Waktu Mulai Pelajaran</th>
                                        <th>Waktu Akhir Pelajaran</th>
                                        <th>Waktu Mulai Istirahat</th>
                                        <th>Waktu Akhir Istirahat</th>
                                        <th>Keterangan</th>
                                       
                                        <th style="width: 5%;">Pilih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datamengajars as $index => $datamengajar)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $datamengajar->hari }}</td> 
                                        <td>{{ $datamengajar->matpel->MataPelajaran }}</td>
                                        <td>{{ $datamengajar->guru->Nama }}</td> 
                                        <td>{{ $datamengajar->time_start }}</td> 
                                        <td>{{ $datamengajar->time_end }}</td> 
                                        <td>{{ $datamengajar->time_start1 }}</td> 
                                        <td>{{ $datamengajar->time_end1 }}</td> 
                                        <td>{{ $datamengajar->keterangani }}</td> 
                                      
                                        
                                        <td>
                                            <input type="checkbox" name="datamengajar_ids[]" value="{{ $datamengajar->datamengajar_id }}">
                                        </td>
                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" name="datakelasId" value="{{ $datakelasId }}"> 
                            
                           
                            <button type="button" onclick="window.location.href = '/datakelasadmin'" class="btn btn-danger">Kembali</button>

                          
                           

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
  function confirmDelete(event) {
    event.preventDefault(); // Mencegah perilaku default form
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm').submit();
        }
    })
}

    $(document).ready(function() {
        $('#jadwalTable').DataTable({
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
@endif
@if (auth()->user()->hakakses == 'KepalaSekolah')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Data Jadwal Mata Pelajaran</h3>
                    <h5>Wali Kelas : {{ $datakelas->guru->Nama }}</h5>
                    <h5>Kelas : {{ $datakelas->kelas->namakelas }}</h5>
                    <h5>Tahun Akademik : {{ $datakelas->tahun->tahunakademik }}</h5>
                    <h5>Semester : {{ $datakelas->tahun->semester }}</h5>
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
                        <form method="POST"id="deleteForm" action="{{ route('hapus') }}">
                            @csrf
                            @method('DELETE')
                            <table id="jadwalTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>
                                            Hari
                                        </th>
                                        <th>Mata Pelajaran</th>
                                        <th>Nama Guru</th>
                                        <th>Waktu Mulai Pelajaran</th>
                                        <th>Waktu Akhir Pelajaran</th>
                                        <th>Waktu Mulai Istirahat</th>
                                        <th>Waktu Akhir Istirahat</th>
                                        <th>Keterangan</th>
                                        <th style="width: 5%;">Pilih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datamengajars as $index => $datamengajar)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $datamengajar->hari }}</td> 
                                        <td>{{ $datamengajar->matpel->MataPelajaran }}</td>
                                        <td>{{ $datamengajar->guru->Nama }}</td> 
                                        <td>{{ $datamengajar->time_start }}</td> 
                                        <td>{{ $datamengajar->time_end }}</td> 
                                        <td>{{ $datamengajar->time_start1 }}</td> 
                                        <td>{{ $datamengajar->time_end1 }}</td> 
                                        <td>{{ $datamengajar->keterangani }}</td> 
                                        <td>
                                            <input type="checkbox" name="selected[]" value="{{ $datamengajar->datamengajar_id }}"> <!-- Checkbox untuk memilih item -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" name="datakelasId" value="{{ $datakelasId }}"> 
                            <button type="button" class="btn btn-danger" onclick="confirmDelete(event)">Hapus</button>
                           
                        </form>
                    </div>
                    <div class="button-container mt-3">
                        <button type="button" onclick="window.location.href = '/datakelasadmin'"
                        class="btn btn-danger">Kembali</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(event) {
    event.preventDefault(); // Mencegah perilaku default form
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm').submit();
        }
    })
}

    $(document).ready(function() {
        $('#jadwalTable').DataTable({
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
                }
            ]
        });
    });
    
</script>
@endif
@if (auth()->user()->hakakses == 'Siswa'||auth()->user()->hakakses == 'Kurikulum'||auth()->user()->hakakses == 'Guru')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Data Jadwal Mata Pelajaran</h3>
                    @php
                    $namaGuru = $datakelas?->guru?->Nama;
                @endphp
                
                @if (!is_null($namaGuru))
                    <h2>Wali Kelas : {{ $namaGuru }}</h2>
                @else
                    <h2>Wali Kelas : Belum Di Set</h2>
                @endif
                   
                    <h5>Kelas : {{ $datakelas->kelas->namakelas }}</h5>
                    <h5>Tahun Akademik : {{ $datakelas->tahun->tahunakademik }}</h5>
                    <h5>Semester : {{ $datakelas->tahun->semester }}</h5>
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
                        <form method="POST"id="deleteForm" action="{{ route('hapus') }}">
                            @csrf
                            @method('DELETE')
                            <table id="jadwalTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>
                                            Hari
                                        </th>
                                        <th>Mata Pelajaran</th>
                                        <th>Nama Guru</th>
                                        <th>Waktu Mulai Pelajaran</th>
                                        <th>Waktu Akhir Pelajaran</th>
                                        <th>Waktu Mulai Istirahat</th>
                                        <th>Waktu Akhir Istirahat</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datamengajars as $index => $datamengajar)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $datamengajar->hari }}</td> 
                                        <td>{{ $datamengajar->matpel->MataPelajaran }}</td>
                                        <td>{{ $datamengajar->guru->Nama }}</td> 
                                        <td>{{ $datamengajar->time_start }}</td> 
                                        <td>{{ $datamengajar->time_end }}</td> 
                                        <td>{{ $datamengajar->time_start1 }}</td> 
                                        <td>{{ $datamengajar->time_end1 }}</td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" name="datakelasId" value="{{ $datakelasId }}"> 
                            
                        </form>
                    </div>
                    <div class="button-container mt-3">
                        <button type="button" onclick="window.location.href = '/datakelas'" class="btn btn-dark">Kembali</button>
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
        $('#jadwalTable').DataTable({
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
@endif

@endsection
