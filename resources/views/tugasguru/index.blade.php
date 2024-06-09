@extends('index')
@section('title', 'Kesuma-GO | Data Tugas Guru')
@section('content')
    @include('tugasguru.create')
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
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Tugas <small>Guru</small></h3>
            <hr>
        </div>
    </div>
    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-bar-chart" style="margin-right: 10px; "></i>Tugas<small>Guru</small></h2>
            
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
                                        Mata Pelajaran
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        File
                                    </th>

                                    <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                        Kelas
                                    </th>

                                  
                                <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                    width="60";>
                                    Tipe
                                </th>
                                <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                    width="60";>
                                    Keterangan Tugas
                                </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Batas Awal Pengumpulan
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Batas Akhir Pengumpulan
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
                            <button type="button" onclick="tambah()" class="btn btn-primary">Tambah
                                Tugas</button>
                                <button type="button" onclick="window.location.href = '/cektugas'"
                                class="btn btn-dark">Lihat Pengumpulan</button>
                             @if (auth()->user()->hakakses == 'Admin')
                                            <button type="button" onclick="window.location.href = '/tugas'"
                                            class="btn btn-danger">Kembali</button>
                                            @endif
                                            @if (auth()->user()->hakakses == 'KepalaSekolah')
                                            <button type="button" onclick="window.location.href = '/tugas'"
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
            $('#datakelas_datamengajar_id').val('');
            $('#tipe').val('');
            $('#keterangan').val('');
            $('#dokumen').val('');
           $('#created_at').val('');
            $('#updated_at').val('');

            iForm('hal_edit');
        }

        function editAndShow(iv, id) {
    $.ajax({
        url: "/tugasguru-edit/" + id,
        type: "GET",
        success: function(data) {
            $('#txt_id').val(id);
            $('#datakelas_datamengajar_id').val(data.datakelas_datamengajar_id);
            $('#tipe').val(data.tipe);
            // Menampilkan informasi dokumen jika ada
            if (data.dokumen) {
                // Anda dapat menyesuaikan cara menampilkan informasi dokumen sesuai dengan kebutuhan
                $('#info_dokumen').text('Dokumen: ' + data.dokumen);
            } else {
                $('#info_dokumen').text('Tidak ada dokumen terlampir');
            }
            $('#keterangan').val(data.keterangan);
            $('#created_at').val(data.created_at);
            $('#updated_at').val(data.updated_at);


            iForm('hal_edit');
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}


//         function editAndShow(iv, id) {
//     $.ajax({
//         url: "/tugasguru-edit/" + id,
//         type: "GET",
//         success: function(data) {
//             $('#txt_id').val(id);
//             $('#datakelas_datamengajar_id').val(data.datakelas_datamengajar_id);
//             $('#keterangan').val(data.keterangan);
//             $('#created_at').val(data.created_at);
//             $('#updated_at').val(data.updated_at);

//             // Menampilkan informasi dokumen jika ada
//             if (data.dokumen) {
//                 // Anda dapat menyesuaikan cara menampilkan informasi dokumen sesuai dengan kebutuhan
//                 $('#info_dokumen').text('Dokumen: ' + data.dokumen);
//             } else {
//                 $('#info_dokumen').text('Tidak ada dokumen terlampir');
//             }

//             iForm('hal_edit');
//         },
//         error: function(xhr, status, error) {
//             console.log(xhr.responseText);
//         }
//     });
// }





        function saveChanges() {
            var id = $('#txt_id').val();
            var datakelas_datamengajar_id = $('#datakelas_datamengajar_id').val();
            var tipe = $('#tipe').val();
            
            var keterangan = $('#keterangan').val();
            var created_at = $('#created_at').val();
            var updated_at = $('#updated_at').val();


            var data = {
                id: id,

                datakelas_datamengajar_id: datakelas_datamengajar_id,
                keterangan: keterangan,
                created_at: created_at,
                updated_at: updated_at
            };

            $.ajax({
                url: "/tugasguru-save",
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
            $('#datakelas_datamengajar_id').val(data.datakelas_datamengajar_id);
            $('#tipe').val(data.tipe);
            $('#keterangan').val(data.keterangan);
            $('#created_at').val(data.created_at);
            $('#updated_at').val(data.updated_at);
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
                    url: "{{ route('tugasguru.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'tugas_id',
                        name: 'tugas_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                  
                 
                    {
                        data: 'datakelasdatamengajar.datamengajar.matpel.MataPelajaran',
                        name: 'datakelasdatamengajar.datamengajar.matpel.MataPelajaran'
                    },
                    
                    {
                        data: 'dokumen',
                        name: 'dokumen'
                    },
                    {
                        data: 'datakelasdatamengajar.datakelas.kelas.namakelas',
                        name: 'datakelasdatamengajar.datakelas.kelas.namakelas'
                    },
                    {
                        data: 'tipe',
                        name: 'tipe'
                    },

                    
                  
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
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
                            url: "{{ route('tugasguru.removeall') }}", // Hapus 'kurikulum_id' => ''
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "get",
                            data: {
                                tugas_id: id // Ganti 'kurikulum_id' dengan 'id_kur'
                            },
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your data has been deleted.",
                                    icon: "success",
                                });
                                window.location.assign("tugasguru");
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
