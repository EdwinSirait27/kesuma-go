@extends('index')
@section('title', 'Kesuma-GO | Data Kelas')
@section('content')
    @include('datakelas.create')

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
        }
        .text-success {
            color: rgb(255, 0, 0);
            background-color: rgb(0, 0, 0);
            padding: 5px 10px;
            border-radius: 5px;
        }
.text-danger {
            background-color: rgb(0, 0, 0);
            color: rgb(255, 0, 0);
            padding: 5px 10px;
            border-radius: 5px;
        }
        <style>
    /* Tambahkan animasi saat hover */
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Ganti warna latar belakang saat hover pada baris tabel */
    .user_datatable tbody tr:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    /* Ganti ikon logout dengan ikon yang lebih menarik */
    .fa-sign-out-alt {
        color: #FF5733; /* Ganti warna ikon */
    }
</style>

    
@if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah')
    <div class="row" id="hal_index">
        <div class="col-md-12 col-sm-12">
            <h3><i class="fa fa-calculator" style="margin-right: 10px; margin-top: 15px;"></i>Data <small>Kelas</small></h3>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="row g-3 align-items-center">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-calculator" style="margin-right: 10px; "></i>Data <small>Kelas</small></h2>

                       
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
                                                Ruang Kelas
                                            </th>
                                            <th scope="col"
                                                style="text-align: center; font-size: 13px; max-width: 200px;">
                                                Wali Kelas
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px; width: 20px;">
                                                Kapasitas Max
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px; width: 20px;">
                                                Kapasitas Tersedia
                                            </th>
                                            

                                            <th scope="col" style="text-align: center; width: 20px; font-size: 13px;">
                                                Keterangan
                                            </th>
                                            <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">
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
                                            Data Kelas</button>
                                            @if (auth()->user()->hakakses =='Admin')
                                            <button type="button" onclick="window.location.href = '/AdminBeranda'"
                                                class="btn btn-danger">Kembali</button>
                                                @endif
                            @if (auth()->user()->hakakses =='KepalaSekolah')
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
            $('#hal_edit1').hide();
            $('#' + iv).show();
        }

        function tambah() {
            $('#txt_id').val(0);
            $('#kelas_id').val('');
            $('#guru_id').val('');
            $('#keterangan').val('');
            $('#tahunakademik_id').val('');
            iForm('hal_edit');
        }
        // Di dalam file JavaScript Anda

        function editAndShow(iv, id) {
            $.ajax({
                url: "/datakelas-edit/" + id,
                type: "GET",
                success: function(data) {
                    $('#txt_id').val(id);
                    $('#kelas_id').val(data.kelas_id);
                    $('#guru_id').val(data.guru_id);
                    $('#keterangan').val(data.keterangan);
                    $('#kapasitas').val(data.kapasitas);
                    $('#tahunakademik_id').val(data.tahunakademik_id);
                    showSiswaInTable(data.kelas_id);
           iForm('hal_edit');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
        function editAndShow1(iv, id) {
    $.ajax({
        url: "/datakelas-edit1/" + id,
        type: "GET",
        success: function(data) {
            $('#kelas_id').val(data.kelas_id);
            $('#kapasitas').val(data.kapasitas);
            // Asumsikan bahwa iForm adalah fungsi yang sudah ada dan berfungsi dengan benar
            iForm('hal_edit1');
            // Alternatif jika iForm tidak berfungsi:
            // $('#hal_edit1').show(); // Atau $('#hal_edit1').css('display', 'block');
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            // Tambahkan penanganan error di sini, misalnya:
            // alert('Terjadi kesalahan saat memuat data. Silakan coba lagi.');
        }
    });
}

    
        function showSiswaInTable(kelas_id) {
            $.ajax({
                url: "/datakelas-edit/" + kelas_id,
                type: "GET",
                success: function(siswas) {
                    $('#siswaTerdaftarTable tbody').empty();
                    $.each(siswas, function(index, siswa) {
                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + siswa.NamaLengkap + '</td>' +
                            '<td>' + (siswa.kelas ? siswa.kelas.namakelas :
                                'Tidak terkait dengan kelas') + '</td>' +
                            '<td><input type="checkbox" class="select-checkbox" name="selected_siswa[]" value="' +
                            siswa.siswa_id + '"></td>' +
                            '</tr>';
                        $('#siswaTerdaftarTable tbody').append(row);
                    });

                    // Perbarui DataTable dengan mengirim perintah draw
                    $('#siswaTerdaftarTable').DataTable().draw(false);
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }
        function showSiswaInTable1(kelas_id) {
            $.ajax({
                url: "/datakelas-edit1/" + kelas_id,
                type: "GET",
                success: function(siswas) {
                    $('#siswaTerdaftarTable tbody').empty();
                    $.each(siswas, function(index, siswa) {
                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + siswa.NamaLengkap + '</td>' +
                            '<td>' + (siswa.kelas ? siswa.kelas.namakelas :
                                'Tidak terkait dengan kelas') + '</td>' +
                            '<td><input type="checkbox" class="select-checkbox" name="selected_siswa[]" value="' +
                            siswa.siswa_id + '"></td>' +
                            '</tr>';
                        $('#siswaTerdaftarTable tbody').append(row);
                    });

                    // Perbarui DataTable dengan mengirim perintah draw
                    $('#siswaTerdaftarTable').DataTable().draw(false);
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        function saveChanges() {
            var id = $('#txt_id').val();
            var kelas_id = $('#kelas_id').val();
            var guru_id = $('#guru_id').val();

            var keterangan = $('#keterangan').val();

            var tahunakademik_id = $('#tahunakademik_id').val();
            var data = {
                id: id,
                kelas_id: kelas_id,
                guru_id: guru_id,

                keterangan: keterangan,
                tahunakademik_id: tahunakademik_id
            };
            $.ajax({
                url: "/datakelas-save",
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
            $('#kelas_id').val(data.kelas_id);
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
                    url: "{{ route('datakelas.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'datakelas_id',
                        name: 'datakelas_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                    {
                        data: 'tahun.tahunakademik',
                        name: 'tahun.tahunakademik '
                    },
                    {
                        data: 'tahun.semester',
                        name: 'tahun.semester '
                    },
                    {
                        data: 'kelas.namakelas',
                        name: 'kelas.namakelas '
                    },
                    {
                    data: 'guru.Nama',
                    name: 'guru.Nama',
                    render: function(data, type, row) {
                        return data ? data : 'Tidak Di Set';
                    }
                },
                    {
                        data: 'kelas.kapasitas',
                        name: 'kelas.kapasitas '
                    },
                    {
    data: 'jumlah_siswa', // Nama kolom virtual yang akan kita buat
    name: 'jumlah_siswa',
    render: function (data, type, row) {
        return data; // Untuk menampilkan data yang sudah kita siapkan di controller
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
                            url: "{{ route('datakelas.removeall') }}", // Hapus 'kurikulum_id' => ''
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "get",
                            data: {
                                datakelas_id: id 
                            },
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your data has been deleted.",
                                    icon: "success",
                                });
                                window.location.assign("datakelasadmin");
                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Tidak Ada Data Yang Tercentang",
                            text: "Dicentang Dulu Baru Bisa Dihapus Ya Adminku:)",
                            icon: "warning",
                        });
                    }
                }
            });
        });
    </script>

@endif
@if (auth()->user()->hakakses == 'Guru'||auth()->user()->hakakses == 'Kurikulum')
    <div class="row" id="hal_index">
        <div class="card-header bg-dark text-white">
            <h3><i class="fa fa-users"style="margin-right: 10px; margin-top: 15px;"></i>Data <small> Kelas</small></h3>
            @forelse($kurs as $kurikulum)
            <h2>Kurikulum: {{ $kurikulum->Nama_Kurikulum }}</h2>
        @empty
            <h2>Tidak ada data kurikulum aktif.</h2>
        @endforelse
    
        @forelse($taon as $taun)
            <h2>Tahun Akademik Aktif: {{ $taun->tahunakademik }}</h2>
            <h2>Semester: {{ $taun->semester }}</h2>
        @empty
            <h2>Tidak ada data tahun akademik aktif.</h2>
        @endforelse
    </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title row">
                    <div class="col-md-8">
                    <h2><i class="fa fa-bar-chart" style="margin-right: 10px;"></i> Data <small> Kelas </small></h2>
                 
                </div>
                <div class="col-md-4">
                    <select id="tahun_akademik_filter" class="form-control">
                        <option value="">Pilih Tahun Akademik</option>
                        @foreach($tahuns as $tahunAkademik)
                            <option value="{{ $tahunAkademik->tahunakademik_id }}">{{ $tahunAkademik->tahunakademik }} - {{ $tahunAkademik->semester }}</option>
                        @endforeach
                    </select>
                 
                </div>
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
                                                Kurikulum
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
                                                Ruang Kelas
                                            </th>
                                            <th scope="col"
                                                style="text-align: center; font-size: 13px; max-width: 200px;">
                                                Wali Kelas
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px; width: 20px;">
                                                Kapasitas Max
                                            </th>
                                           

                                            <th scope="col" style="text-align: center; width: 20px; font-size: 13px;">
                                                Keterangan
                                            </th>
                                            <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">
                                                Action
                                            </th>
                                           
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                      

                                        
                                            @if (auth()->user()->hakakses =='Guru')
                                            <button type="button" onclick="window.location.href = '/GuruBeranda'"
                                                class="btn btn-danger">Kembali</button>
                                                @endif
                            @if (auth()->user()->hakakses =='Siswa')
                                            <button type="button" onclick="window.location.href = '/SiswaBeranda'"
                                                class="btn btn-danger">Kembali</button>
                                                @endif
                            @if (auth()->user()->hakakses =='Kurikulum')
                                            <button type="button" onclick="window.location.href = '/KurikulumBeranda'"
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

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('datakelas.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'datakelas_id',
                        name: 'datakelas_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                    {
                        data: 'tahun.kurikulum.Nama_Kurikulum',
                        name: 'tahun.kurikulum.Nama_Kurikulum '
                    },

                    {
                        data: 'tahun.tahunakademik',
                        name: 'tahun.tahunakademik '
                    },
                    {
                        data: 'tahun.semester',
                        name: 'tahun.semester '
                    },
                    {
                        data: 'kelas.namakelas',
                        name: 'kelas.namakelas '
                    },
                    {
                    data: 'guru.Nama',
                    name: 'guru.Nama',
                    render: function(data, type, row) {
                        return data ? data : 'Tidak Di Set';
                    }
                },
                    {
                        data: 'kelas.kapasitas',
                        name: 'kelas.kapasitas '
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
            $('#tahun_akademik_filter').on('change', function() {
                var tahunAkademikId = $(this).val(); // Mendapatkan nilai tahun akademik yang dipilih
                table.ajax.url("{{ route('datakelas.index') }}?tahunakademik_id=" + tahunAkademikId).load(); // Mengubah URL Ajax dan memuat ulang tabel
            });
        });
    
    </script>
    @endif
@if (auth()->user()->hakakses == 'Siswa')
    <div class="row" id="hal_index">
        <div class="card-header bg-dark text-white">
            <h3><i class="fa fa-users"style="margin-right: 10px; margin-top: 15px;"></i>Data <small> Kelas</small></h3>
            @forelse($kurs as $kurikulum)
            <h2>Kurikulum: {{ $kurikulum->Nama_Kurikulum }}</h2>
        @empty
            <h2>Tidak ada data kurikulum aktif.</h2>
        @endforelse
    
        @forelse($taon as $taun)
            <h2>Tahun Akademik Aktif: {{ $taun->tahunakademik }}</h2>
            <h2>Semester: {{ $taun->semester }}</h2>
        @empty
            <h2>Tidak ada data tahun akademik aktif.</h2>
        @endforelse
    </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title row">
                    <div class="col-md-8">
                    <h2><i class="fa fa-bar-chart" style="margin-right: 10px;"></i> Data <small> Kelas </small></h2>
                 
                </div>
                <div class="col-md-4">
                    <select id="tahun_akademik_filter" class="form-control">
                        <option value="">Pilih Tahun Akademik</option>
                        @foreach($tahuns as $tahunAkademik)
                            <option value="{{ $tahunAkademik->tahunakademik_id }}">{{ $tahunAkademik->tahunakademik }} - {{ $tahunAkademik->semester }}</option>
                        @endforeach
                    </select>
                 
                </div>
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
                                            Kurikulum
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
                                                Ruang Kelas
                                            </th>
                                            <th scope="col"
                                                style="text-align: center; font-size: 13px; max-width: 200px;">
                                                Wali Kelas
                                            </th>
                                            <th scope="col" style="text-align: center; font-size: 13px; width: 20px;">
                                                Kapasitas Max
                                            </th>
                                           

                                           
                                            <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">
                                                Action
                                            </th>
                                           
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                      

                                        
                                            @if (auth()->user()->hakakses =='Guru')
                                            <button type="button" onclick="window.location.href = '/GuruBeranda'"
                                                class="btn btn-danger">Kembali</button>
                                                @endif
                            @if (auth()->user()->hakakses =='Siswa')
                                            <button type="button" onclick="window.location.href = '/SiswaBeranda'"
                                                class="btn btn-danger">Kembali</button>
                                                @endif
                            @if (auth()->user()->hakakses =='Kurikulum')
                                            <button type="button" onclick="window.location.href = '/KurikulumBeranda'"
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

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('datakelas.index') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'datakelas_id',
                        name: 'datakelas_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                  
                    {
                        data: 'tahun.kurikulum.Nama_Kurikulum',
                        name: 'tahun.kurikulum.Nama_Kurikulum '
                    },

                    {
                        data: 'tahun.tahunakademik',
                        name: 'tahun.tahunakademik '
                    },
                    {
                        data: 'tahun.semester',
                        name: 'tahun.semester '
                    },

                    {
                        data: 'kelas.namakelas',
                        name: 'kelas.namakelas '
                    },
                    {
                    data: 'guru.Nama',
                    name: 'guru.Nama',
                    render: function(data, type, row) {
                        return data ? data : 'Tidak Di Set';
                    }
                },
                    {
                        data: 'kelas.kapasitas',
                        name: 'kelas.kapasitas '
                    },
                   
                    
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#tahun_akademik_filter').on('change', function() {
                var tahunAkademikId = $(this).val(); // Mendapatkan nilai tahun akademik yang dipilih
                table.ajax.url("{{ route('datakelas.index') }}?tahunakademik_id=" + tahunAkademikId).load(); // Mengubah URL Ajax dan memuat ulang tabel
            });
        });
    
    </script>
    @endif
@endsection
