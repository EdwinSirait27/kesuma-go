


@extends('index')
@section('title', 'Kesuma-GO | Prestasi')
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

                        /* Styling untuk form */
                        #prestasiForm {
                            max-width: 400px;
                            margin: 0 auto;
                            padding: 20px;
                            background-color: #f9f9f9;
                            border-radius: 8px;
                            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                        }
                    
                        .form-group {
                            margin-bottom: 20px;
                        }
                    
                        label {
                            font-weight: bold;
                        }
                    
                        input[type="text"] {
                            width: 100%;
                            padding: 10px;
                            border: 1px solid #ccc;
                            border-radius: 4px;
                            box-sizing: border-box;
                        }
                    
                        button {
                            padding: 10px 20px;
                            background-color: #007bff;
                            color: #fff;
                            border: none;
                            border-radius: 4px;
                            cursor: pointer;
                            transition: background-color 0.3s ease;
                        }
                    
                        button:hover {
                            background-color: #0056b3;
                        }
                  
</style>

<div class="container">
  <div class="row mt-4">
      <div class="col-md-12">
              <div class="card">
                  <div class="card-header bg-dark text-white">
                      <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Prestasi <small>siswa</small></h3>
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
                    
                      <form id="prestasiForm" method="POST" action="{{ route('prestasi.store', $siswa_id) }}">
                        @csrf
       
                        <div class="form-group">
                            <label for="prestasi">Prestasi:</label>
                            <input type="text" id="prestasi" name="prestasi" class="form-control"maxlength="30">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan:</label>
                            <input type="text" id="keterangan" name="keterangan" class="form-control" minlength="175" maxlength="180">
                            @error('keterangan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        
                    </form>
                    
                 
                    
                  
                    
                   
                             
                  </div>
                  <div class="alert alert-dark">
                    <ul>
                        Keterangan
                       <li>Jikalau ingin menambahkan prestasi kepada siswa, untuk keterangannya diisi dengan minimum 175 huruf dan maximal 180 huruf agar rapi di raport siswa</li>
                       <li>Jikalau terjadi kendala saat penambahan prestasi siswa, coba menekan menu daftaar siswa kembali dan menekan tombol prestasi dari siswa yang akan diinput prestasinya</li>
                        
                    </ul>
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
        <script>
            // JavaScript untuk validasi form
            document.getElementById('prestasiForm').addEventListener('submit', function(event) {
                // Mengambil nilai input
                var prestasi = document.getElementById('prestasi').value.trim();
                var keterangan = document.getElementById('keterangan').value.trim();
        
                // Validasi input
                if (prestasi === '' || keterangan === '') {
                    // Menghentikan pengiriman form jika ada input yang kosong
                    event.preventDefault();
                    alert('isi semua ya.');
                }
            });
        </script>
        
@endsection 
                     