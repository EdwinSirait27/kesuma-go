@extends('index')
@section('title', 'Kesuma-GO | Ekstrakulikuler')
@section('content')
    @include('ekstrakulikuler.create')

    <style>
        .table th,
        .table td {

            text-align: center;

        }
        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }
        .col-form-label {
                        font-size: 18px;
                        /* Ganti dengan ukuran font yang Anda inginkan */
                    }
                    .text-success {
    color: rgb(255, 0, 0); /* Warna teks putih untuk kontras */
    background-color: rgb(0, 0, 0); /* Warna latar belakang hitam (tanpa opasitas) */
    padding: 5px 10px; /* Padding untuk estetika */
    border-radius: 5px; /* Sudut bulat untuk estetika */
}


.text-danger {
    background-color: rgb(0, 0, 0); /* Warna latar belakang merah (tanpa opasitas) */
    color: rgb(255, 0, 0); /* Warna teks untuk kontras */
    padding: 5px 10px; /* Padding untuk estetika */
    border-radius: 5px; /* Sudut bulat untuk estetika */
}



    </style>
       @if (auth()->user()->hakakses == 'Admin' || auth()->user()->hakakses == 'KepalaSekolah')
       <div class="row" id="hal_index">
        <div class="card-header bg-dark text-white">
            <h3><i class="fa fa-calculator"style="margin-right: 10px; margin-top: 15px;"></i>Detail <small> Ekstrakulikuler</small></h3>
           
    </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="row g-3 align-items-center">
                <div class="x_panel">
                    <div class="x_title" style="display: flex; justify-content: space-between; align-items: center;">
                        <h2 style="margin: 0;"><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data <small>ekstrakulikuler</small></h2>
                     
                   
                    </div>
                    
                    
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered user_datatable">
                                        <thead>
                                            <th scope="col"
                                                style="text-align: center; width: 5px; font-size: 13px; max-width: 10px;">
                                                No.
                                            </th>
                                            <th scope="col" style="text-align: center;  font-size: 13px;"
                                            class="lebar-kolom" width="60";>
                                          Tahun Akademik
                                        </th>
                                        <th scope="col" style="text-align: center;  font-size: 13px;"
                                            class="lebar-kolom" width="60";>
                                          Semester
                                        </th>
                                            <th scope="col" style="text-align: center;  font-size: 13px;"
                                                class="lebar-kolom" width="60";>
                                              Ekstrakulikuler
                                            </th>
                                            <th scope="col"
                                                style="text-align: center; font-size: 13px; max-width: 200px;">
                                                Guru Pembina
                                            </th>
                                            <th scope="col"
                                                style="text-align: center; font-size: 13px; max-width: 200px;">
                                                Kapasitas
                                            </th>
                                            
                                            <th scope="col" style="text-align: center;  font-size: 13px;"
                                                class="lebar-kolom" width="60";>
                                              Keterangan
                                            </th>
                                           
                                            <th scope="col" style="text-align: center; width: 10px; font-size: 13px;">
                                                Action
                                            </th>
                                            <th width="50px" style="text-align: center; font-size: 13px;">
                                                <button type="button" name="bulk_delete" id="bulk_delete"
                                                    class="btn btn-danger btn-xs">Delete</button>
                                            </th>   
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="button" onclick="tambah()" class="btn btn-primary">Tambah
                                            Data Ekstrakulikuler</button>
                                            @if (auth()->user()->hakakses == 'Admin')
                                            <button type="button" onclick="window.location.href = '/AdminBeranda'"
                                            class="btn btn-danger">Kembali</button>
                                            @endif
                                            @if (auth()->user()->hakakses == 'KepalaSekolah')
                                            <button type="button" onclick="window.location.href = '/KepalaSekolahBeranda'"
                                            class="btn btn-danger">Kembali</button>
                                            @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        iForm('hal_index');

        function iForm(iv) {
            $('#hal_index').hide();
            $('#hal_edit').hide();
            $('#' + iv).show();
        }

        function tambah() {
            $('#txt_id').val(0);
            $('#ekskul_id').val('');
            $('#guru_id').val('');
            $('#keterangan').val('');
            $('#tahunakademik_id').val('');
           
            iForm('hal_edit');
        }

        function editAndShow(iv, id) {
            $.ajax({
                url: "/ekstrakulikuler-edit/" + id,
                type: "GET",
                success: function(data) {
                    // Mengisi nilai input dengan data yang ada
                    $('#txt_id').val(id);
                    $('#ekskul_id').val(data.ekskul_id);
                    $('#guru_id').val(data.guru_id);
                    $('#keterangan').val(data.keterangan);
                    $('#tahunakademik_id').val(data.tahunakademik_id);
                    
                    iForm('hal_edit');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }


        function saveChanges() {
            var id = $('#txt_id').val();
            var ekskul_id = $('#ekskul_id').val();
            var guru_id = $('#guru_id').val();
            var keterangan = $('#keterangan').val();
            var tahunakademik_id = $('#tahunakademik_id').val();
            

            var data = {
                id: id,
                ekskul_id: ekskul_id,
                guru_id: guru_id,
                keterangan: keterangan,
                tahunakademik_id: tahunakademik_id
            };

            $.ajax({
                url: "/ekstrakulikuler-save",
                type: "POST",
                data: data,
                success: function(response) {
                    // Tindakan setelah berhasil menyimpan perubahan
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }


        function setData(data) {
            // Kode pengisian data yang lain...
            $('#txt_id').val(data.txt_id);
            $('#ekskul_id').val(data.ekskul_id);
            $('#guru_id').val(data.guru_id);
            $('#keterangan').val(data.keterangan);
            $('#tahunakademik_id').val(data.tahunakademik_id);
            // Mengembalikan deferred object agar $.when() mengetahui bahwa pengisian data selesai
            return $.Deferred().resolve().promise();
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('ekstrakulikuler.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'ekstra_guru_id',
                        name: 'ekstra_guru_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'tahun1.tahunakademik',
                        name: 'tahun1.tahunakademik'
                    },
                    {
                        data: 'tahun1.semester',
                        name: 'tahun1.semester'
                    },
                    {
                        data: 'ekskul.namaekskul',
                        name: 'ekskul.namaekskul '
                    },
                    {
                        data: 'guru.Nama',
                        name: 'guru.Nama'
                    },
                    {
                        data: 'ekskul.kapasitas',
                        name: 'ekskul.kapasitas'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                   
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
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
                            url: "{{ route('ekstrakulikuler.removeall') }}", // Hapus 'kurikulum_id' => ''
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "get",
                            data: {
                                ekstra_guru_id: id // Ganti 'kurikulum_id' dengan 'id_kur'
                            },
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your data has been deleted.",
                                    icon: "success",
                                });
                                window.location.assign("ekstrakulikuler");
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
@endif



@if (auth()->user()->hakakses == 'Siswa' || auth()->user()->hakakses == 'Guru'|| auth()->user()->hakakses == 'Kurikulum')
    <div class="row" id="hal_index">
        <div class="col-md-12 col-sm-12">
            <h3><i class="fa fa-calculator" style="margin-right: 10px; margin-top: 15px;"></i>Data  <small>ekstrakulikuler</small></h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="row g-3 align-items-center">
                <div class="x_panel">
                    <div class="x_title" style="display: flex; justify-content: space-between; align-items: center;">
                        <h2 style="margin: 0;"><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data <small>ekstrakulikuler</small></h2>
                     
                   
                    </div>
                    
                    
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered user_datatable">
                                        <thead>
                                            <th scope="col"
                                                style="text-align: center; width: 5px; font-size: 13px; max-width: 10px;">
                                                No.
                                            </th>
                                            <th scope="col" style="text-align: center;  font-size: 13px;"
                                            class="lebar-kolom" width="60";>
                                          Tahun Akademik
                                        </th>
                                        <th scope="col" style="text-align: center;  font-size: 13px;"
                                            class="lebar-kolom" width="60";>
                                          Semester
                                        </th>
                                            <th scope="col" style="text-align: center;  font-size: 13px;"
                                                class="lebar-kolom" width="60";>
                                              Ekstrakulikuler
                                            </th>
                                            <th scope="col"
                                                style="text-align: center; font-size: 13px; max-width: 200px;">
                                                Guru Pembina
                                            </th>
                                            <th scope="col"
                                                style="text-align: center; font-size: 13px; max-width: 200px;">
                                                Kapasitas
                                            </th>
                                            
                                            <th scope="col" style="text-align: center;  font-size: 13px;"
                                                class="lebar-kolom" width="60";>
                                              Keterangan
                                            </th>
                                          
                                            <th scope="col" style="text-align: center; width: 10px; font-size: 13px;">
                                                Action
                                            </th>
                                           
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        @if (auth()->user()->hakakses == 'Guru' || auth()->user()->hakakses == 'Siswa'|| auth()->user()->hakakses == 'Kurikulum')
                                            <button type="button" onclick="goBack()" class="btn btn-danger">Kembali</button>
                                            <script>
                                              function goBack() {
                                                window.history.back();
                                              }
                                            </script>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        iForm('hal_index');

        function iForm(iv) {
            $('#hal_index').hide();
            $('#hal_edit').hide();
            $('#' + iv).show();
        }

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('ekstrakulikuler.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'ekstra_guru_id',
                        name: 'ekstra_guru_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'tahun1.tahunakademik',
                        name: 'tahun1.tahunakademik'
                    },
                    {
                        data: 'tahun1.semester',
                        name: 'tahun1.semester'
                    },
                    {
                        data: 'ekskul.namaekskul',
                        name: 'ekskul.namaekskul '
                    },
                    {
                        data: 'guru.Nama',
                        name: 'guru.Nama'
                    },
                    {
                        data: 'ekskul.kapasitas',
                        name: 'ekskul.kapasitas'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                  
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
      
    </script>
    @endif
@endsection
