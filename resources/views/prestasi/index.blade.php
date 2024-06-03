
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
  <h3><i class="fa fa-users" style="margin-right: 10px; margin-top: 15px;"></i>List Prestasi <small>Siswa </small></h3>
  <hr>
</div>
<div class="container">
  <div class="row mt-4">
      <div class="col-md-12">
              <div class="card">
                  <div class="card-header bg-dark text-white">
                      <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Prestasi <small>siswa</small></h3>
                      <div class="row">
                        <div class="col-md-6">
                            @foreach($prestasis->unique('siswa_id') as $prestasi)
                            <h2>Nama Lengkap : {{ $prestasi->siswa->NamaLengkap }}</h2>     
                        @endforeach
                        
                      
                  </div>
                  <div class="col-md-6 text-right">
                    @if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah'||auth()->user()->hakakses == 'Guru')
                    <button type="button" onclick="window.location.href = '/siswaall'" class="btn btn-danger">Kembali</button>
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
                    
                      <table class="table table-striped table-bordered" id="siswaTable">
                          <thead class="thead-white">
                              <tr>
                                      <th scope="col">No</th>
                                      <th scope="col">Prestasi</th>
                                      <th scope="col">Deskripsi</th>
                                   
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($prestasis as $index => $prestasi)
                               
                                     
                                      <tr>
                                          <th scope="row">{{ $index + 1 }}</th>
                                          <td>{{ $prestasi ? $prestasi->prestasi : 'Nama tidak ditemukan' }}</td>
                                          <td>{{ $prestasi ? $prestasi->keterangan : 'Nama tidak ditemukan' }}</td>
                                         
                                  
                                          
                                      </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        
                            <a href="{{ route('prestasi.create', $siswa_id) }}" class="btn btn-dark">Tambah Prestasi</a>
                   
                             
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
                     