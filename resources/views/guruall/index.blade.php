@extends('index')
@section('title', 'Kesuma-GO | Daftar Teenaga Pengajar')
@section('content')
@include('guruall.create')
    <style>
        .table th,
        .table td {
            text-align: center;
        }

        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }

        .hidden {
            display: none;
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
    @if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah')
    <div class="row" id="hal_indx">
        <div class="col-md-12 col-sm-12">
            <h3><i class="fa fa-eyedropper" style="margin-right: 10px; margin-top: 15px;"></i>Data <small>Guru</small></h3>
            <hr>
        </div>
    </div>

    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-eyedropper" style="margin-right: 10px; "></i>Data <small>Guru</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="myDataTable"
                            class="table table-striped table-bordered dt-responsive nowrap user_datatable" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        No.
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Foto Guru
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Nama Guru
                                    </th>
                                
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Agama
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Jenis Kelamin
                                    </th>
                                
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Tugas Mengajar
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Nomor Telephone
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Alamat
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Email
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Status Aktif
                                    </th>
                                   
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Action
                                    </th>
                                    <th width="50px" style="text-align: center; font-size: 15px;">
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
                                Guru </button>
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
            $('#Nama').val('');
            $('#TempatLahir').val('');
            $('#TanggalLahir').val('');
            $('#Agama').val('');
            $('#JenisKelamin').val('');
            $('#StatusPegawai').val('');
            $('#NipNips').val('');
            $('#Nuptk').val('');
            $('#Nik').val('');
            $('#Npwp').val('');
            $('#NomorSertifikatPendidik').val('');
            $('#TahunSertifikasi').val('');
            $('#pangkatgt' ).val('');
            $('#jadwalkenaikanpangkat' ).val('');
            $('#jadwalkenaikangaji' ).val('');
            $('#TMT').val('');
            $('#PendidikanAkhir').val('');
            $('#TahunTamat').val('');
            $('#Jurusan').val('');
            $('#TugasMengajar').val('');
            $('#TugasTambahan').val('');
            $('#JamPerMinggu').val('');
            $('#TahunPensiun').val('');
            // $('#Berkala').val('');
            // $('#Pangkat').val('');
            // $('#Jabatan').val('');
            $('#NomorTelephone').val('');
            $('#Alamat').val('');
            $('#Email').val('');
            $('#status').val('');
            $('#foto').val('');
            $('#username').val('');
            $('#password').val('');
            $('#hakakses').val('');
            iForm('hal_edit');
        }

        function editAndShow(iv, id) {
            $.ajax({
                url: "/guruall-edit/" + id,
                type: "GET",
                success: function(data) {
                    $('#txt_id').val(id);
                    if (data.foto) {
                        $('#previewFoto').attr('src', "{{ asset('storage/images/') }}" + '/' + data.foto);
                    } else {
                        $('#previewFoto').attr('src', '');
                    }
                    $('#Nama').val(data.Nama);
                    $('#TempatLahir').val(data.TempatLahir);
                    $('#TanggalLahir').val(data.TanggalLahir);
                    $('#Agama').val(data.Agama);
                    $('#JenisKelamin').val(data.JenisKelamin);
                    $('#StatusPegawai').val(data.StatusPegawai);
                    $('#NipNips').val(data.NipNips);
                    $('#Nuptk').val(data.Nuptk);
                    $('#Nik').val(data.Nik);
                    $('#Npwp').val(data.Npwp);
                    $('#NomorSertifikatPendidik').val(data.NomorSertifikatPendidik);
                    $('#TahunSertifikasi').val(data.TahunSertifikasi);
                    $('#pangkatgt').val(data.pangkatgt);
                    $('#jadwalkenaikanpangkat').val(data.jadwalkenaikanpangkat);
                    $('#jadwalkenaikangaji').val(data.jadwalkenaikangaji);
                    $('#TMT').val(data.TMT);
                    $('#PendidikanAkhir').val(data.PendidikanAkhir);
                    $('#TahunTamat').val(data.TahunTamat);
                    $('#Jurusan').val(data.Jurusan);
                    $('#TugasMengajar').val(data.TugasMengajar);
                    $('#TugasTambahan').val(data.TugasTambahan);
                    $('#JamPerMinggu').val(data.JamPerMinggu);
                    $('#TahunPensiun').val(data.TahunPensiun);
                    // $('#Berkala').val(data.Berkala);
                    // $('#Pangkat').val(data.Pangkat);
                    // $('#Jabatan').val(data.Jabatan);
                    $('#NomorTelephone').val(data.NomorTelephone);
                    $('#Alamat').val(data.Alamat);
                    $('#Email').val(data.Email);
                    $('#status').val(data.status);

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
            var formData = new FormData();
            var fotoInput = $('#foto')[0];

            if (fotoInput.files.length > 0) {
                formData.append('foto', fotoInput.files[0]);
            }

            var Nama = $('#Nama').val();
            var TempatLahir = $('#TempatLahir').val();
            var TanggalLahir = $('#TanggalLahir').val();
            var Agama = $('#Agama').val();
            var JenisKelamin = $('#JenisKelamin').val();
            var StatusPegawai = $('#StatusPegawai').val();
            var NipNips = $('#NipNips').val();
            var Nuptk = $('#Nuptk').val();
            var Nik = $('#Nik').val();
            var Npwp = $('#Npwp').val();
            var NomorSertifikatPendidik = $('#NomorSertifikatPendidik').val();
            var TahunSertifikasi = $('#TahunSertifikasi').val();
            var pangkatgt = $('#pangkatgt').val();
            var jadwalkenaikanpangkat = $('#jadwalkenaikanpangkat').val();
            var jadwalkenaikangaji = $('#jadwalkenaikangaji').val();
            var TMT = $('#TMT').val();
            var PendidikanAkhir = $('#PendidikanAkhir').val();
            var TahunTamat = $('#TahunTamat').val();
            var Jurusan = $('#Jurusan').val();
            var TugasMengajar = $('#TugasMengajar').val();
            var TugasTambahan = $('#TugasTambahan').val();
            var JamPerMinggu = $('#JamPerMinggu').val();
            var TahunPensiun = $('#TahunPensiun').val();
            // var Berkala = $('#Berkala').val();
            // var Pangkat = $('#Pangkat').val();
            // var Jabatan = $('#Jabatan').val();
            var NomorTelephone = $('#NomorTelephone').val();
            var Alamat = $('#Alamat').val();
            var Email = $('#Email').val();
            var status = $('#status').val();

            var username = $('#username').val();
            var password = $('#password').val();
            var hakakses = $('#hakakses').val();
            var data = {
                id: id,
                foto: foto,
                Nama: Nama,
                TempatLahir: TempatLahir,
                TanggalLahir: TanggalLahir,
                Agama: Agama,
                JenisKelamin: JenisKelamin,
                StatusPegawai: StatusPegawai,
                NipNips: NipNips,
                Nuptk: Nuptk,
                Nik: Nik,
                Npwp: Npwp,
                NomorSertifikatPendidik: NomorSertifikatPendidik,
                TahunSertifikasi: TahunSertifikasi,
                pangkatgt: pangkatgt,
                jadwalkenaikanpangkat: jadwalkenaikanpangkat,
                jadwalkenaikangaji: jadwalkenaikangaji,
                TMT: TMT,
                PendidikanAkhir: PendidikanAkhir,
                TahunTamat: TahunTamat,
                Jurusan: Jurusan,
                TugasMengajar: TugasMengajar,
                TugasTambahan: TugasTambahan,
                JamPerMinggu: JamPerMinggu,
                TahunPensiun: TahunPensiun,
                // Berkala: Berkala,
                // Pangkat: Pangkat,
                // Jabatan: Jabatan,
                NomorTelephone: NomorTelephone,
                Alamat: Alamat,
                Email: Email,
                status: status,

                username: username,
                password: password,
                hakakses: hakakses
            };
            $.ajax({
                url: "/guruall-save",
                type: "POST",
                data: data,
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function setData(data) {
            $('#txt_id').val(data.txt_id);

            $('#Nama').val(data.Nama);
            $('#TempatLahir').val(data.TempatLahir);
            $('#TanggalLahir').val(data.TanggalLahir);
            $('#Agama').val(data.Agama);
            $('#JenisKelamin').val(data.JenisKelamin);
            $('#StatusPegawai').val(data.StatusPegawai);
            $('#NipNips').val(data.NipNips);
            $('#Nuptk').val(data.Nuptk);
            $('#Nik').val(data.Nik);
            $('#Npwp').val(data.Npwp);
            $('#NomorSertifikatPendidik').val(data.NomorSertifikatPendidik);
            $('#TahunSertifikasi').val(data.TahunSertifikasi);
            $('#pangkatgt').val(data.pangkatgt);
            $('#jadwalkenaikanpangkat').val(data.jadwalkenaikanpangkat);
            $('#jadwalkenaikangaji').val(data.jadwalkenaikangaji);
            $('#TMT').val(data.TMT);
            $('#PendidikanAkhir').val(data.PendidikanAkhir);
            $('#TahunTamat').val(data.TahunTamat);
            $('#Jurusan').val(data.Jurusan);
            $('#TugasMengajar').val(data.TugasMengajar);
            $('#TugasTambahan').val(data.TugasTambahan);
            $('#JamPerMinggu').val(data.JamPerMinggu);
            $('#TahunPensiun').val(data.TahunPensiun);
            // $('#Berkala').val(data.Berkala);
            // $('#Pangkat').val(data.Pangkat);
            // $('#Jabatan').val(data.Jabatan);
            $('#NomorTelephone').val(data.NomorTelephone);
            $('#Alamat').val(data.Alamat);
            $('#Email').val(data.Email);
            $('#status').val(data.status);
            $('#foto').val(data.foto);
            $('#username').val(data.username);
            $('#password').val(data.password);
            $('#hakakses').val(data.hakakses);
            return $.Deferred().resolve().promise();
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('guruall.index1') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'guru_id',
                        name: 'guru_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
    data: 'foto',
    name: 'foto',
    render: function(data, type, full, meta) {
        if (data) {
            return '<img src="{{ asset('storage/fotoguru/') }}/' + data + '" width="100" />';
        } else {
            return 'Tidak Ada Foto';
        }
    }
},


                    {
                        data: 'Nama',
                        name: 'Nama'
                    },
                   
                    {
                        data: 'Agama',
                        name: 'Agama'
                    },
                    {
                        data: 'JenisKelamin',
                        name: 'JenisKelamin'
                    },
                 
                    {
                        data: 'TugasMengajar',
                        name: 'TugasMengajar'
                    },
                   
                    {
                        data: 'NomorTelephone',
                        name: 'NomorTelephone'
                    },
                    {
                        data: 'Alamat',
                        name: 'Alamat'
                    },
                    {
                        data: 'Email',
                        name: 'Email'
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
        var ids = []; // Menggunakan nama variable yang berbeda untuk menghindari konflik
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
                    ids.push($(this).val()); // Menggunakan array ids untuk menyimpan nilai
                });
                if (ids.length > 0) {
                    $.ajax({
                        url: "{{ route('guruall.removeall') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST", // Mengubah metode menjadi POST
                        data: {
                            ids: ids // Menggunakan nama parameter yang sesuai
                        },
                        success: function(data) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your data has been deleted.",
                                icon: "success",
                            });
                            window.location.assign("guruall"); // Pastikan URL ini benar
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
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('myDataTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ]
            });
            $('.dataTables_length select').append('<option value="-1">Semua</option>');
            $('.dataTables_length select option[value="-1"]').text('Semua');
            $('.dataTables_length select').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue == -1) {
                    table.page.len(-1).draw();
                } else {
                    table.page.len(selectedValue).draw();
                }
            });
        });
    </script>
@endif
@if (auth()->user()->hakakses == 'Siswa'||auth()->user()->hakakses == 'Guru'||auth()->user()->hakakses == 'Kurikulum')
    <div class="row" id="hal_indx">
        <div class="col-md-12 col-sm-12">
            <h3><i class="fa fa-eyedropper" style="margin-right: 10px; margin-top: 15px;"></i>Data <small>Guru</small></h3>
            <hr>
        </div>
    </div>

    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-eyedropper" style="margin-right: 10px; "></i>Data <small>Guru</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="myDataTable"
                            class="table table-striped table-bordered dt-responsive nowrap user_datatable" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        No.
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Foto Guru
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Nama Guru
                                    </th>
                                
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Agama
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Jenis Kelamin
                                    </th>
                                
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Tugas Mengajar
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Nomor Telephone
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Alamat
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Email
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Status Aktif
                                    </th>
                                   
                                  
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                           
                              
                            @if (auth()->user()->hakakses == 'Guru')
                            <button type="button" onclick="window.location.href = '/GuruBeranda'"
                            class="btn btn-danger">Kembali</button>
                            @endif
                            @if (auth()->user()->hakakses == 'Siswa')
                            <button type="button" onclick="window.location.href = '/SiswaBeranda'"
                            class="btn btn-danger">Kembali</button>
                            @endif
                            @if (auth()->user()->hakakses == 'Kurikulum')
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
                    url: "{{ route('guruall.index1') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'guru_id',
                        name: 'guru_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
    data: 'foto',
    name: 'foto',
    render: function(data, type, full, meta) {
        if (data) {
            return '<img src="{{ asset('storage/fotoguru/') }}/' + data + '" width="100" />';
        } else {
            return 'Tidak Ada Foto';
        }
    }
},

                    {
                        data: 'Nama',
                        name: 'Nama'
                    },
                   
                    {
                        data: 'Agama',
                        name: 'Agama'
                    },
                    {
                        data: 'JenisKelamin',
                        name: 'JenisKelamin'
                    },
                 
                    {
                        data: 'TugasMengajar',
                        name: 'TugasMengajar'
                    },
                   
                    {
                        data: 'NomorTelephone',
                        name: 'NomorTelephone'
                    },
                    {
                        data: 'Alamat',
                        name: 'Alamat'
                    },
                    {
                        data: 'Email',
                        name: 'Email'
                    },
                    {
                data: 'status',
                name: 'status',
                render: function(data, type, full, meta) {
                    // Logika untuk memberikan warna
                    var colorClass = data === 'Aktif' ? 'text-success' : 'text-danger';
                    return '<span class="' + colorClass + '">' + data + '</span>';
                }
            }
                 
                ]
            });
        });
        
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('myDataTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ]
            });
            $('.dataTables_length select').append('<option value="-1">Semua</option>');
            $('.dataTables_length select option[value="-1"]').text('Semua');
            $('.dataTables_length select').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue == -1) {
                    table.page.len(-1).draw();
                } else {
                    table.page.len(selectedValue).draw();
                }
            });
        });
    </script>
@endif
{{-- 

@if (auth()->user()->hakakses == 'Siswa')
    <div class="row" id="hal_indx">
        <div class="col-md-12 col-sm-12">
            <h3><i class="fa fa-eyedropper" style="margin-right: 10px; margin-top: 15px;"></i>Data <small>Guru</small></h3>
            <hr>
        </div>
    </div>

    <div class="x_panel">
        <div class="x_title">
            <h2><i class="fa fa-eyedropper" style="margin-right: 10px; "></i>Data Diri<small>Guru</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="myDataTable"
                            class="table table-striped table-bordered dt-responsive nowrap user_datatable" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        No.
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Foto Guru
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Nama Guru
                                    </th>
                                
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Agama
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Jenis Kelamin
                                    </th>
                                
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Tugas Mengajar
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Nomor Telephone
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Alamat
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Email
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        Status Aktif
                                    </th>
                                   
                                   
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            @if (auth()->user()->hakakses =='Siswa')
                                    <button type="button" onclick="window.location.href = '/SiswaBeranda'"
                                        class="btn btn-danger">Kembali</button>
                                        @endif
                            @if (auth()->user()->hakakses =='Guru')
                                    <button type="button" onclick="window.location.href = '/GuruBeranda'"
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
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('guruall.index1') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'guru_id',
                        name: 'guru_id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
    data: 'foto',
    name: 'foto',
    render: function(data, type, full, meta) {
        if (data) {
            return '<img src="{{ asset('fotoguru/') }}/' + data + '" width="100" />';
        } else {
            return 'Tidak Ada Foto';
        }
    }
},

                    {
                        data: 'Nama',
                        name: 'Nama'
                    },
                   
                    {
                        data: 'Agama',
                        name: 'Agama'
                    },
                    {
                        data: 'JenisKelamin',
                        name: 'JenisKelamin'
                    },
                 
                    {
                        data: 'TugasMengajar',
                        name: 'TugasMengajar'
                    },
                   
                    {
                        data: 'NomorTelephone',
                        name: 'NomorTelephone'
                    },
                    {
                        data: 'Alamat',
                        name: 'Alamat'
                    },
                    {
                        data: 'Email',
                        name: 'Email'
                    },
                    {
                data: 'status',
                name: 'status',
                render: function(data, type, full, meta) {
                    // Logika untuk memberikan warna
                    var colorClass = data === 'Aktif' ? 'text-success' : 'text-danger';
                    return '<span class="' + colorClass + '">' + data + '</span>';
                }
            }
                  
                ]
            });
        });
      
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('myDataTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ]
            });
            $('.dataTables_length select').append('<option value="-1">Semua</option>');
            $('.dataTables_length select option[value="-1"]').text('Semua');
            $('.dataTables_length select').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue == -1) {
                    table.page.len(-1).draw();
                } else {
                    table.page.len(selectedValue).draw();
                }
            });
        });
    </script>
    @endif --}}
@endsection
