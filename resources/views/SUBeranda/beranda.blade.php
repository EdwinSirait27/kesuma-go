@extends('index')
@section('title', 'Kesuma-GO | Data Hak Akses & Role')
@section('content')
    @include('SUBeranda.berandacreate')

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
            <h3><i class="fa fa-users" style="margin-right: 10px; margin-top: 15px;"></i>Role & <small>Hak Akses</small></h3>
            <hr>
        </div>
    </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-users" style="margin-right: 10px; "></i>Role & <small>Hak Akses</small></h2>
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
                                                Role
                                            </th>
                                            {{-- <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Halaman
                                            </th> --}}

                                            <th scope="col" style="text-align: center; font-size: 13px;"
                                                class="lebar-kolom"width="60" ;>
                                                Action
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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
                url: "/SUBeranda-edit/" + id,
                type: "GET",
                success: function(data) {
                    // Mengisi nilai input dengan data yang ada
                    $('#txt_id').val(id);
                    $('#txt_Nama').val(data.txt_Nama);
                    $('#username').val(data.username);
                    $('#password').val(data.password);
                    $('#hakakses').val(data.hakakses);
                    $('#role').val(data.role);
                    // $('#halaman').val(data.halaman);
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
            var role = $('#role').val();
            // var halaman = $('#halaman').val();

            var data = {
                id: id,
                Nama: Nama,
                username: username,
                password: password,
                hakakses: hakakses,
                role: role
                // halaman: halaman
            };

            $.ajax({
                url: "/SUBeranda-save",
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

       
    </script>
    <script>
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('SUBeranda.beranda') }}",
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
                        data: 'listakun.role',
                        name: 'listakun.role'
                    },
                    // {
                    //     data: 'listakun.halaman',
                    //     name: 'listakun.halaman'
                    // },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
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
