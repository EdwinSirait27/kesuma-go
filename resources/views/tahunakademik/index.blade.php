@extends('index')
@section('title', 'Kesuma-GO | Data Tahun Akademik')
@section('content')
    @include('tahunakademik.create')

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
            color: rgb(255, 0, 0);
            /* Warna teks putih untuk kontras */
            background-color: rgb(0, 0, 0);
            /* Warna latar belakang hitam (tanpa opasitas) */
            padding: 5px 10px;
            /* Padding untuk estetika */
            border-radius: 5px;
            /* Sudut bulat untuk estetika */
        }


        .text-danger {
            background-color: rgb(0, 0, 0);
            /* Warna latar belakang merah (tanpa opasitas) */
            color: rgb(255, 0, 0);
            /* Warna teks untuk kontras */
            padding: 5px 10px;
            /* Padding untuk estetika */
            border-radius: 5px;
            /* Sudut bulat untuk estetika */
        }
    </style>
    <div class="row" id="hal_index">
        <div class="col-md-12 col-sm-12">
            <h3><i class="fa fa-book" style="margin-right: 10px; margin-top: 15px;"></i>Data Tahun <small>Akademik</small>
            </h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-book" style="margin-right: 10px; "></i>Data Tahun<small>Akademik</small></h2>
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
                                        <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                            Tahun Akademik
                                        </th>
                                        <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                            Kurikulum
                                        </th>
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Semester
                                    </th>
                                        <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                            width="60";>
                                            Tanggal Mulai
                                        </th>
                                        <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                            width="60";>
                                            Tanggal Akhir

                                        <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                            width="60";>
                                            Status Aktif
                                        </th>
                                        <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                            width="60";>
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
                                    <button type="button" onclick="tambah()" class="btn btn-primary">Tambah Data </button>
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
            $('#tahunakademik').val('');
            $('#kurikulum_id').val('');
            $('#semester').val('');
            $('#tahun1').val('');
            $('#tahun2').val('');
            $('#statusaktif').val('');
            $('#keterangan').val('');
            iForm('hal_edit');
        }

        function editAndShow(iv, id) {
            $.ajax({
                url: "/tahunakademik-edit/" + id,
                type: "GET",
                success: function(data) {
                    // Mengisi nilai input dengan data yang ada
                    $('#txt_id').val(id);
                    $('#tahunakademik').val(data.tahunakademik);
                    $('#kurikulum_id').val(data.kurikulum_id);
                    $('#semester').val(data.semester);

                    $('#tahun1').val(data.tahun1);
                    $('#tahun2').val(data.tahun2);
                    $('#statusaktif').val(data.statusaktif);
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
            var tahunakademik = $('#tahunakademik').val();

            var kurikulum_id = $('#kurikulum_id').val();
            var semester = $('#semester').val();
            var tahun1 = $('#tahun1').val();
            var tahun2 = $('#tahun2').val();
            var statusaktif = $('#statusaktif').val();
            var keterangan = $('#keterangan').val();

            var data = {
                id: id,
                tahunakademik: tahunakademik,
                kurikulum_id: kurikulum_id,
                semester: semester,
                tahun1: tahun1,
                tahun2: tahun2,
                statusaktif: statusaktif,
                keterangan: keterangan

            };

            $.ajax({
                url: "/tahunakademik-save",
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
            $('#txt_id').val(data.txt_id);
            $('#tahunakademik').val(data.tahunakademik);
            $('#kurikulum_id').val(data.kurikulum_id);
            $('#semester').val(data.semester);
            $('#tahun1').val(data.tahun1);
            $('#tahun2').val(data.tahun2);
            $('#statusaktif').val(data.statusaktif);
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
                    url: "{{ route('tahunakademik.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'tahunakademik_id',
                        name: 'tahunakademik_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'tahunakademik',
                        name: 'tahunakademik'
                    },
                    {
                        data: 'kurikulum.Nama_Kurikulum',
                        name: 'kurikulum.Nama_Kurikulum'
                    },
                    {
                        data: 'semester',
                        name: 'semester'
                    },
                    {
                        data: 'tahun1',
                        name: 'tahun1'
                    },
                    {
                        data: 'tahun2',
                        name: 'tahun2'
                    },
                    {
                        data: 'statusaktif',
                        name: 'statusaktif',
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
                    var id = [];
                    $('.users_checkbox:checked').each(function() {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: "{{ route('tahunakademik.removeall') }}", // Hapus 'kurikulum_id' => ''
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "get",
                            data: {
                                tahunakademik_id: id // Ganti 'kurikulum_id' dengan 'id_kur'
                            },
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your data has been deleted.",
                                    icon: "success",
                                });
                                window.location.assign("tahunakademik");
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
