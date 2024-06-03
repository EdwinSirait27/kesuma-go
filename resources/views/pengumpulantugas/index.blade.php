@extends('index')
@section('title', 'Kesuma-GO | Data Tugas Siswa')
@section('content')
    @include('pengumpulantugas.create')
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
        <div class="card-header bg-dark text-white">
            <h3><i class="fa fa-users"style="margin-right: 10px; margin-top: 15px;"></i>Pengumpulan <small>Tugas</small></h3>

            {{-- <h5>Waktu Realtime : {{ $formattedDateTime }}</h5> --}}
            <div id="clock" data-formatted-datetime="{{ $formattedDateTime }}"></div>

        </div>
    </div>
    <hr>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart" style="margin-right: 10px; "></i>Pengumpulansss<small>Tugas</small></h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table class="table table-striped table-bordered user_datatable">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        style="text-align: center; width: 5px; font-size: 13px; max-width: 10px;">
                                        No.
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Nama Guru
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Mata Pelajaran
                                    </th>
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Keterangan Tugas
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Tugas Anda
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Tanggal Mengumpul
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Status
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
                        <div class=r"col-sm-10">
                            <button type="button" onclick="tambah()" class="btn btn-primary">Kumpul Tugas</button>
                            <button type="button" onclick="window.location.href = '/lihattugas'"
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

        function tambah() {
            $('#txt_id').val(0);
            $('#siswa_id').val('');
            $('#tugas_id').val('');
            $('#dokumen').val('');
            $('#tanggal').val('');

            iForm('hal_edit');
        }

        function editAndShow(iv, id) {
            $.ajax({
                url: "/pengumpulantugas-edit/" + id,
                type: "GET",
                success: function(data) {
                    $('#txt_id').val(id);
                    $('#tugas_id').val(data.tugas_id);
                    $('#siswa_id').val(data.siswa_id);

                    if (data.dokumen) {
                        $('#info_dokumen').text('Dokumen: ' + data.dokumen);
                    } else {
                        $('#info_dokumen').text('Tidak ada dokumen terlampir');
                    }
                    $('#tanggal').val(data.tanggal);
                    iForm('hal_edit');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('pengumpulantugas.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'pengumpulan_id',
                        name: 'pengumpulan_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },


                    {
                        data: 'tugas.datakelasdatamengajar.datamengajar.guru.Nama',
                        name: 'tugas.datakelasdatamengajar.datamengajar.guru.Nama'
                    },
                    {
                        data: 'tugas.datakelasdatamengajar.datamengajar.matpel.MataPelajaran',
                        name: 'tugas.datakelasdatamengajar.datamengajar.matpel.MataPelajaran'
                    },
                    {
                        data: 'tugas.keterangan',
                        name: 'tugas.keterangan'
                    },
                    {
                        data: 'dokumen',
                        name: 'dokumen'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
                            url: "{{ route('pengumpulantugas.removeall') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "get",
                            data: {
                                pengumpulan_id: id
                            },
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your data has been deleted.",
                                    icon: "success",
                                });
                                window.location.assign("pengumpulantugas");
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
    <script>
function updateClockAndDate() {
    var formattedDateTime = document.getElementById('clock').getAttribute('data-formatted-datetime');
    document.getElementById('clock').innerText = formattedDateTime;
}

    </script>
    {{-- <script>
        function updateClockAndDate() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            var timeString = hours + ":" + minutes + ":" + seconds;
            document.getElementById('clock').innerText = timeString;
            var month = now.getMonth() + 1;
            var day = now.getDate();
            var year = now.getFullYear();
            var dateString = day + "/" + month + "/" + year;
            document.getElementById('date').innerText = dateString;
        }
        setInterval(updateClockAndDate, 1000);
        updateClockAndDate();
    </script> --}}
@endsection
