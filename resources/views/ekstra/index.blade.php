@extends('index')
@section('title', 'Kesuma-GO | Daftar Ekstrakulikuler')
@section('content')
    @include('ekstra.create')
    
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
    <div class="row" id="hal_index">
        <div class="col-md-12 col-sm-12">
            <h3><i class="fa fa-futbol" style="margin-right: 10px; margin-top: 15px;"></i>Data <small>Ekstrakulikuler</small></h3>
            <hr>
        </div>
    </div>
    
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-futbol" style="margin-right: 10px; margin-top: 15px;"></i>Data<small>Ekstrakulikuler</small></h2>
                    <div class="clearfix"></div>
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
                                        <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Ektrakulikuler
                                    </th>
                                        <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Kapasitas
                                    </th>
                                        <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Status Aktif
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
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
                                    <button type="button" onclick="tambah()" class="btn btn-primary">Tambah Ekstrakulikuler</button>
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
            $('#hal_daftar').hide();
            $('#' + iv).show();
        }

        function tambah() {
            $('#txt_id').val(0);
            $('#namaekskul').val('');
            $('#kapasitas').val('');
            $('#status').val('');
            
            $('#keterangan').val('');
            iForm('hal_edit');
        }

        function editAndShow(iv, id) {
            $.ajax({
                url: "/ekstra-edit/" + id,
                type: "GET",
                success: function(data) {
                    // Mengisi nilai input dengan data yang ada
                    $('#txt_id').val(id);
                    $('#namaekskul').val(data.namaekskul);
                    $('#kapasitas').val(data.kapasitas);
                    $('#status').val(data.status);
            
                    $('#keterangan').val(data.keterangan);
                    iForm('hal_edit');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }


        function saveChanges() {
            var id = $('#txt_id').val();
            var namaekskul = $('#namaekskul').val();
            var kapasitas = $('#kapasitas').val();
            var status = $('#status').val();
            
            var keterangan = $('#keterangan').val();

            var data = {
                id: id,
                namaekskul: namaekskul,
                kapasitas: kapasitas,
                status: status,
            
                keterangan: keterangan
            };

            $.ajax({
                url: "/ekstra-save",
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
            $('#namaekskul').val(data.namaekskul);
            $('#kapasitas').val(data.kapasitas);
            $('#status').val(data.status);
          
            $('#keterangan').val(data.keterangan);
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
                    url: "{{ route('ekstra.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'ekskul_id',
                        name: 'ekskul_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'namaekskul',
                        name: 'namaekskul'
                    },
                    {
                        data: 'kapasitas',
                        name: 'kapasitas'
                    },
                    {
                data: 'status',
                name: 'status',
                render: function(data, type, full, meta) {
                    // Logika untuk memberikan warna
                    var colorClass = data === 'Aktif' ? 'text-success' : 'text-danger';
                    return '<span class="' + colorClass + '">' + data + '</span>';
                }
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
                    $('.users_checkbox:checked').each(function() {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: "{{ route('ekstra.removeall') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "get",
                            data: {
                                ekskul_id: id
                            },
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your data has been deleted.",
                                    icon: "success",
                                });
                                window.location.assign("ekstra");
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
