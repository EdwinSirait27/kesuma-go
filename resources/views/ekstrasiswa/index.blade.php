@extends('index')
@section('title', 'Kesuma-GO | Daftar Ekstrakulikuler')
@section('content')
<div class="col-md-12 col-sm-12">
  <h3><i class="fa fa-users" style="margin-right: 10px; margin-top: 15px;"></i>Daftar <small>Ekstrakulikuler </small></h3>
  <hr>
</div>
<div class="container">
  <div class="row mt-4">
      <div class="col-md-12">
              <div class="card">
                  <div class="card-header bg-dark text-white">
                      <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data <small>Ekstrakulikuler</small></h3>
                      <h2>Nama Siswa : {{ $siswa->NamaLengkap }}</h2>
                      
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
                                  <button type="button" onclick="history.back();" class="btn btn-danger btn-block">Kembali</button>
                                  <a href="{{ route('download-pdf', ['datakelasId' => $datakelasId]) }}" class="btn btn-primary btn-block" download="namafile.pdf">Cetak Absensi</a>

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
@endsection 
