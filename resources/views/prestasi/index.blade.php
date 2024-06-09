
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
                    
                      <div class="card-box table-responsive">
                        <table id="myDataTable"
                            class="table table-striped table-bordered dt-responsive nowrap user_datatable"
                            cellspacing="0" width="100%">
                          <thead class="thead-white">
                              <tr>
                                      <th scope="col">No</th>
                                      <th scope="col">Prestasi</th>
                                      <th scope="col">Deskripsi</th>
                                      <th width="50px" style="text-align: center; font-size: 15px;">
                                        <button type="button" name="bulk_delete" id="bulk_delete"
                                            class="btn btn-danger btn-xs">Delete</button>
                                    </th>
                                  </tr>
                              </thead>
                              <tbody>
                             
                                </tbody>
                            </table>
                        
                            <a href="{{ route('prestasi.create', ['encodedId' => base64_encode($siswa_id)]) }}" class="btn btn-dark">Tambah Prestasi</a>

                             
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
     <script type="text/javascript">
        $(document).ready(function() {
            var encodedId = "{{ request()->route('encodedId') }}"; // Ambil encodedId dari rute
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('/prestasi') }}/" + encodedId,
                    method: "GET"
                },
                columns: [
                    {
                        data: 'prestasi_id',
                        name: 'prestasi_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'prestasi',
                        name: 'prestasi'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
    
       {{-- <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('prestasi.indexx') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'prestasi_id',
                        name: 'prestasi_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'prestasi',
                        name: 'prestasi'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    }
                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
        </script> --}}
        <script>
            $(document).on('click', '#bulk_delete', function() {
            var id = [];
            Swal.fire({
                title: "Apakah Yakin?",
                text: "Data Tidak Bisa Kembali",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus",
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = [];
                    $('.users_checkbox:checked').each(function() {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            
                            url: "{{ route('prestasi.removeall1') }}", // Hapus 'kurikulum_id' => ''
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "get",
                            data: {
                                prestasi_id: id 
                            },
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your data has been deleted.",
                                    icon: "success",
                                });
                                var encodedId = "{{ request()->route('encodedId') }}"; // Ambil encodedId dari rute
    
                                window.location.assign("prestasi");
                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Tidak Ada Data Yang Tercentang",
                            text: "Dicentang Dulu Baru Bisa Dihapus Ya Admin:)",
                            icon: "warning",
                        });
                    }
                }
            });
        });
    </script>
       
        
@endsection 
{{-- // @foreach($prestasis as $index => $prestasi)
                               
                                     
// <tr>
//     <th scope="row">{{ $index + 1 }}</th>
//     <td>{{ $prestasi ? $prestasi->prestasi : 'Nama tidak ditemukan' }}</td>
//     <td>{{ $prestasi ? $prestasi->keterangan : 'Nama tidak ditemukan' }}</td>
   

    
// </tr>
// @endforeach --}}