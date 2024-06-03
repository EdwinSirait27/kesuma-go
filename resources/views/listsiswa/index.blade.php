 @extends('index')
  @section('title', 'Kesuma-GO | List Siswa Kelas')
@section('content')
<style>
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

        .input-list {
            list-style-type: none;
            padding-left: 0;
        }

        .input-list li {
            margin-bottom: 10px;
        }

        .input-field {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            width: 200px;
        }

        .input-field:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px #007bff;
        }

        .input-field {
            width: 50px;
        }

        .input-list1 {
            list-style-type: none;
            padding-left: 0;
        }

        .input-list1 li {
            margin-bottom: 10px;
        }

        .input-field1 {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            width: 200px;
        }




        .input-field1 {
    min-width: 100px; 
    width: 200px;
}
</style>
<div class="col-md-12 col-sm-12">
    <h3><i class="fa fa-users" style="margin-right: 10px; margin-top: 15px;"></i>List Siswa <small>Kelas </small></h3>
    <hr>
</div>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data <small>Kelas</small></h3>
                        <h2>Tahun Akademik : {{ $tahunakademik }}</h2>
                        <h2>Semester : {{ $semester }}</h2>
                        <h2>Wali Kelas : {{ $namaGuru }}</h2>
                        <h2>Kelas :  {{ $namakelas }}</h2>
                        <h2>Kapasitas :  {{ $kapasitas }}</h2>

                        <h2>Total jumlah siswa: {{ count($siswaIds) }}</h2>
                        
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif     
                        @if(isset($siswaIds) && count($siswaIds) > 0)
                        <table class="table table-striped table-bordered" id="siswaTable">
                            <thead class="thead-white">
                                <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Siswa</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($siswaIds as $index => $siswaId)
                                        @php
                                            $siswa = \App\Models\tbsiswa::where('siswa_id', $siswaId)->first();
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $siswa ? $siswa->NamaLengkap : 'Nama tidak ditemukan' }}</td>
                                          
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info">
                                Tidak ada siswa yang terdaftar dalam kelas ini.
                            </div>
                        @endif
                     
                                <div class="col-sm-1">
                                    <button type="button" onclick="window.location.href = '/datakelas'" class="btn btn-danger">Kembali</button>
                                    @if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah'||auth()->user()->hakakses == 'Guru')
                                    <a href="{{ route('download-pdf', ['kelasId' => $kelasId]) }}" class="btn btn-primary btn-block" download="namafile.pdf">Cetak Absensi</a>
                                    
                                    @endif
                                   
                        </div>
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
                   
                    
                    
                ]
            });
        });
        </script>
@endsection 