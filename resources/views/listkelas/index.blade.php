@extends('index')
@section('title', 'Kesuma-GO | List Kelas')
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
                      <div class="row">
                        <div class="col-md-6">
                      <h2>Tahun Akademik : {{ $tahunakademik }}</h2>
                      <h2>Semester : {{ $semester }}</h2>
                      @php
                      $namaGuru = $datakelas?->guru?->Nama;
                  @endphp
                  
                  @if (!is_null($namaGuru))
                      <h2>Wali Kelas : {{ $namaGuru }}</h2>
                  @else
                      <h2>Wali Kelas : Belum Di Set</h2>
                  @endif
                     
                    
                      <h2>Kelas :  {{ $namakelas }}</h2>
                      <h2>Kapasitas :  {{ $kapasitas }}</h2>

                      <h2>Total jumlah siswa: {{ count($siswaIds) }}</h2>
                      
                  </div>
                  <div class="col-md-6 text-right">
                    @if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah'||auth()->user()->hakakses == 'Guru')
                    <button type="button" onclick="window.location.href = '/datakelasadmin'" class="btn btn-danger">Kembali</button>
                    @endif
                    @if (!is_null($namaGuru))
                          <a href="{{ route('download-pdf', ['datakelasId' => $datakelasId]) }}" class="btn btn-success" download="namafile.pdf">Cetak Absensi</a>
                      
                  @endif
                    {{-- <a href="{{ route('download-pdf', ['datakelasId' => $datakelasId]) }}" class="btn btn-success" download="namafile.pdf">Cetak Absensi</a> --}}
                </div>
                </div>
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
                            <input type="hidden" name="datakelasId" value="{{ $datakelasId }}"> 
                      @else
                          <div class="alert alert-info">
                              Tidak ada siswa yang terdaftar dalam kelas ini.
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
              ]
          });
      });
      </script>
@endsection 
                     