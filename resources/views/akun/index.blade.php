@extends('index')
@section('title', 'Kesuma-GO | Data Akun Tenaga Pengajar')
@section('content')
    @include('akun.create')

    <style>
        .table th,
        .table td {

            text-align: center;
        }

        /* ini dia */
        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }

        .hidden {
            display: none;
        }
    </style>
    <div class="row" id="hal_index">
        <div class="col-md-12 col-sm-12">
            <h3><i class="fa fa-users" style="margin-right: 10px; margin-top: 15px;"></i>Daftar <small>Akun Tenaga Pengajar</small></h3>
            <hr>
        </div>
    </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-users" style="margin-right: 10px; "></i>Daftar Data Akun<small>Tenaga Pengajar</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="myDataTable" class="table table-striped table-bordered dt-responsive nowrap user_datatable" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                No.
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Nama Tenaga Pengajar
                                            </th>

                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Tugas Mengajar
                                            </th>

                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                username
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                password
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                hakakses
                                            </th>

                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Action
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="button" onclick="window.location.href = '/beranda'"
                                        class="btn btn-danger">Kembali</button>
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

        function editAndShow(iv, id) {
            $.ajax({
                url: "/akun-edit/" + id,
                type: "GET",
                success: function(data) {
                    // Mengisi nilai input dengan data yang ada
                    $('#txt_id').val(id);
                    $('#txt_Nama').val(data.txt_Nama);
                    $('#username').val(data.username);
                    $('#password').val(data.password);
                    $('#hakakses').val(data.hakakses);
                    iForm('hal_edit');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function saveChanges() {
            var id = $('#txt_id').val();
            var Nama = $('#txt_Nama').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var hakakses = $('#hakakses').val();

            var data = {
                id: id,
                Nama: Nama,
                username: username,
                password: password,
                hakakses: hakakses
            };

            $.ajax({
                url: "/akun-save",
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
            $('#txt_Nama').val(data.txt_Nama);
            $('#username').val(data.username);
            $('#password').val(data.password);
            $('#hakakses').val(data.hakakses);
            // Mengembalikan deferred object agar $.when() mengetahui bahwa pengisian data selesai
            return $.Deferred().resolve().promise();
        }
    </script>
    <script>
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('akun.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'Nama',
                        name: 'Nama',
                    },
                    {
                        data: 'TugasMengajar',
                        name: 'TugasMengajar'
                    },
                    {
                        data: 'listakun.username',
                        name: 'listakun.username'
                    },
                    {
                        data: 'listakun.password',
                        name: 'listakun.password'
                    },
                    {
                        data: 'listakun.hakakses',
                        name: 'listakun.hakakses'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });
            @if (session('success'))
                table.ajax.reload();
            @endif
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
                            url: "{{ route('akun.removeall') }}", // Hapus 'kurikulum_id' => ''
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "get",
                            data: {
                                id: id // Ganti 'kurikulum_id' dengan 'id_kur'
                            },
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your data has been deleted.",
                                    icon: "success",
                                });
                                window.location.assign("akun");
                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "No checkboxes selected",
                            text: "Please select at least one checkbox",
                            icon: "warning",
                        });
                    }
                }
            });
        });
    </script>
      <script type="text/javascript">
        $(document).ready(function() {
            var table = $('myDataTable').DataTable({
                "pageLength": 10, // Menampilkan 10 data per halaman secara default
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]]
            });
    
            // Menambahkan opsi "Semua" ke dalam dropdown "Show entries"
            $('.dataTables_length select').append('<option value="-1">Semua</option>');
    
            // Mengubah tampilan "Semua" menjadi teks yang lebih jelas
            $('.dataTables_length select option[value="-1"]').text('Semua');
    
            // Mengatur agar tabel menampilkan semua entri saat "Semua" dipilih
            $('.dataTables_length select').change(function () {
                var selectedValue = $(this).val();
                if (selectedValue == -1) {
                    table.page.len(-1).draw();
                } else {
                    table.page.len(selectedValue).draw();
                }
            });
        });
    </script>

@endsection
