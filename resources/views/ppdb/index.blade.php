@extends('index')
@section('title', 'Kesuma-GO | Data PPDB')
@section('content')
@include('ppdb.create')
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
                <h3><i class="fa fa-male" style="margin-right: 10px; margin-top: 15px;"></i>Data <small>PPDB</small></h3>
                <hr>
            </div>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-male" style="margin-right: 10px; "></i>Data Diri<small>Siswa</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="card-box table-responsive">
                            <table id="myDataTable"
                                class="table table-striped table-bordered dt-responsive nowrap user_datatable"
                                cellspacing="0" width="100%">
                                <thead>
                                    <th scope="col" style="text-align: center; font-size: 13px;"
                                        class="lebar-kolom"width="60" ;>
                                        No.
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="150">
                                        Foto
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="150">
                                        Nama Lengkap
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        NISN
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Jenis Kelamin
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Tanggal Lahir
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Agama
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Nomor Telephone
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Email
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Alamat
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Asal SMP
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Nomor Telephone Orang Tua / Wali
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Nama Orang Tua / Wali
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Username
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Tanggal Pendaftaran
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        No Pdf
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
                                <button type="button" name="bulk_update" id="bulk_update"
                                    class="btn btn-success btn-xs">Ubah Hak Akses</button>

                                    <button type="button" class="btn btn-primary" id="checkAll">Check All</button>
                                    <button type="button" class="btn btn-secondary" id="uncheckAll">Uncheck All</button>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            iForm('hal_index');

            function iForm(iv) {
                $('#hal_index').hide();
                $('#hal_edit').hide();
                $('#hal_eksten').hide();
                $('#' + iv).show();
            }
           
    document.getElementById('checkAll').addEventListener('click', function() {
        var checkboxes = document.getElementsByClassName('users_checkbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = true;
        }
    });

    document.getElementById('uncheckAll').addEventListener('click', function() {
        var checkboxes = document.getElementsByClassName('users_checkbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = false;
        }
    });


            



            function editAndShow(iv, id) {
                $.ajax({
                    url: "/ppdb-edit/" + id,
                    type: "GET",
                    success: function(data) {
                        // Mengisi nilai input dengan data yang ada
                        $('#txt_id').val(id);
                        if (data.foto) {
                            $('#previewFoto').attr('src', "{{ asset('fotosiswa/') }}" + '/' + data.foto);
                        } else {
                            $('#previewFoto').attr('src', '');
                        }
                        $('#NOPDF').val(data.NOPDF);
                        $('#NamaLengkap').val(data.NamaLengkap);
                        $('#NomorInduk').val(data.NomorInduk);

                        $('#NamaPanggilan').val(data.NamaPanggilan);
                        $('#JenisKelamin').val(data.JenisKelamin);
                        $('#NISN').val(data.NISN);
                        $('#TempatLahir').val(data.TempatLahir);
                        $('#TanggalLahir').val(data.TanggalLahir);
                        $('#Agama').val(data.Agama);
                        $('#Alamat').val(data.Alamat);
                        $('#RT').val(data.RT);
                        $('#RW').val(data.RW);
                        $('#Kelurahan').val(data.Kelurahan);
                        $('#Kecamatan').val(data.Kecamatan);
                        $('#KabKota').val(data.KabKota);
                        $('#Provinsi').val(data.Provinsi);
                        $('#KodePos').val(data.KodePos);
                        $('#Email').val(data.Email);
                        $('#NomorTelephone').val(data.NomorTelephone);
                        $('#Kewarganegaraan').val(data.Kewarganegaraan);
                        $('#NIK').val(data.NIK);
                        $('#GolDarah').val(data.GolDarah);
                        $('#TinggalDengan').val(data.TinggalDengan);

                        $('#StatusSiswa').val(data.StatusSiswa);
                        $('#AnakKe').val(data.AnakKe);
                        $('#SaudaraKandung').val(data.SaudaraKandung);
                        $('#SaudaraTiri').val(data.SaudaraTiri);

                        $('#Tinggicm').val(data.Tinggicm);
                        $('#Beratkg').val(data.Beratkg);
                        $('#RiwayatPenyakit').val(data.RiwayatPenyakit);

                        $('#AsalSMP').val(data.AsalSMP);
                        $('#AlamatSMP').val(data.AlamatSMP);
                        $('#NPSNSMP').val(data.NPSNSMP);
                        $('#KabKotaSMP').val(data.KabKotaSMP);
                        $('#ProvinsiSMP').val(data.ProvinsiSMP);
                        $('#NoIjasah').val(data.NoIjasah);
                        $('#NoSKHUN').val(data.NoSKHUN);
                        $('#LamaBelajarSMP').val(data.LamaBelajarSMP);
                        $('#DiterimaTanggal').val(data.DiterimaTanggal);
                        $('#DiterimaDiKelas').val(data.DiterimaDiKelas);
                        $('#DiterimaSemester').val(data.DiterimaSemester);
                        $('#MutasiAsalSMA').val(data.MutasiAsalSMA);
                        $('#AlasanPindah').val(data.AlasanPindah);
                        $('#NoPesertaUNSMP').val(data.NoPesertaUNSMP);
                        $('#TglIjasah').val(data.TglIjasah);
                        $('#NamaOrangTuaPadaIjasah').val(data.NamaOrangTuaPadaIjasah);
                        $('#NamaAyah').val(data.NamaAyah);
                        $('#TahunLahirAyah').val(data.TahunLahirAyah);

                        $('#AlamatAyah').val(data.AlamatAyah);
                        $('#NomorTelephoneAyah').val(data.NomorTelephoneAyah);
                        $('#AgamaAyah').val(data.AgamaAyah);

                        $('#PendidikanTerakhirAyah').val(data.PendidikanTerakhirAyah);
                        $('#PekerjaanAyah').val(data.PekerjaanAyah);
                        $('#PenghasilanAyah').val(data.PenghasilanAyah);


                        $('#NamaIbu').val(data.NamaIbu);
                        $('#TahunLahirIbu').val(data.TahunLahirIbu);
                        $('#AlamatIbu').val(data.AlamatIbu);
                        $('#NomorTelephoneIbu').val(data.NomorTelephoneIbu);
                        $('#AgamaIbu').val(data.AgamaIbu);
                        $('#KebangsaanIbu').val(data.KebangsaanIbu);
                        $('#PendidikanTerakhirIbu').val(data.PendidikanTerakhirIbu);
                        $('#PekerjaanIbu').val(data.PekerjaanIbu);
                        $('#PenghasilanIbu').val(data.PenghasilanIbu);
                        $('#IbuMasihHidupMeninggal').val(data.IbuMasihHidupMeninggal);
                        $('#NamaWali').val(data.NamaWali);
                        $('#TahunLahirWali').val(data.TahunLahirWali);
                        $('#AlamatWali').val(data.AlamatWali);
                        $('#NomorTelephoneWali').val(data.NomorTelephoneWali);
                        $('#AgamaWali').val(data.AgamaWali);
                        $('#KebangsaanWali').val(data.KebangsaanWali);
                        $('#PendidikanTerakhirWali').val(data.PendidikanTerakhirWali);
                        $('#PekerjaanWali').val(data.PekerjaanWali);
                        $('#WaliPenghasilan').val(data.WaliPenghasilan);
                        $('#StatusHubunganWali').val(data.StatusHubunganWali);

                        $('#MenerimaBeasiswaDari').val(data.MenerimaBeasiswaDari);
                        $('#TahunMeninggalkanSekolah').val(data.TahunMeninggalkanSekolah);
                        $('#AlasanSebab').val(data.AlasanSebab);
                        $('#TamatBelajarTahun').val(data.TamatBelajarTahun);
                        $('#TanggalNomorSTTB').val(data.TanggalNomorSTTB);
                        $('#MelanjutkanKe').val(data.MelanjutkanKe);
                        $('#BekerjaPada').val(data.BekerjaPada);
                        $('#InformasiLain').val(data.InformasiLain);
                        $('#cita').val(data.cita);
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

            
        </script>
        <script type="text/javascript">
            $(document).on('click', '#bulk_update', function() {
                // Menampilkan peringatan menggunakan SweetAlert
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Ini akan mengubah hak akses siswa yang dipilih menjadi 'Siswa'.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Lanjutkan",
                    cancelButtonText: "Tidak, Batal",
                }).then((result) => {
                    // Jika pengguna menekan tombol "Ya"
                    if (result.isConfirmed) {
                        // Lakukan pembaruan hak akses
                        performBulkUpdate();
                    }
                });
            });

            // Fungsi untuk melakukan pembaruan hak akses
            function performBulkUpdate() {
                var id = [];
                $('.users_checkbox:checked').each(function() {
                    id.push($(this).val());
                });

                if (id.length > 0) {
                    $.ajax({
                        url: "{{ route('ppdb.update') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        data: {
                            siswa_id: id
                        },
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                                title: "Hak Akses Berhasil Diubah!",
                                text: "Hak akses siswa telah diubah menjadi Siswa.",
                                icon: "success",
                            });
                            // Refresh data tabel setelah perubahan
                            $('.user_datatable').DataTable().ajax.reload();
                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Tidak Ada Data Yang Tercentang",
                        text: "Dicentang Dulu Baru Bisa Diubah Hak Aksesnya.",
                        icon: "warning",
                    });
                }
            }
        </script>



        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('.user_datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('ppdb.index') }}",
                        method: "GET"
                    },
                    columns: [{
                            data: 'siswa_id',
                            name: 'siswa_id',
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'foto',
                            name: 'foto',
                            render: function(data, type, full, meta) {
                                if (data) {
                                    return '<img src="{{ asset('storage/fotononsiswa/') }}/' + data +
                                        '" width="100" />';
                                } else {
                                    return 'Tidak Ada Foto';
                                }
                            }
                        },
                        
                        {
                            data: 'NamaLengkap',
                            name: 'NamaLengkap'
                        },
                        {
                            data: 'NISN',
                            name: 'NISN'
                        },
                        {
                            data: 'JenisKelamin',
                            name: 'JenisKelamin'
                        },
                        {
                            data: 'TanggalLahir',
                            name: 'TanggalLahir'
                        },
                        {
                            data: 'Agama',
                            name: 'Agama'
                        },
                        {
                            data: 'NomorTelephone',
                            name: 'NomorTelephone'
                        },
                        {
                            data: 'Email',
                            name: 'Email'
                        },
                        {
                            data: 'Alamat',
                            name: 'Alamat'
                        },
                        {
                            data: 'AsalSMP',
                            name: 'AsalSMP'
                        },
                        {
                            data: 'NomorTelephoneAyah',
                            name: 'NomorTelephoneAyah'
                        },
                        {
                            data: 'NamaAyah',
                            name: 'NamaAyah'
                        },
                        {
                            data: 'listakunsiswa.username',
                            name: 'listakunsiswa.username'
                        },
                        {
                            data: 'listakunsiswa.created_at',
                            name: 'listakunsiswa.created_at'
                        },
                        {
                            data: 'listakunsiswa.no_pdf',
                            name: 'listakunsiswa.no_pdf'
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
                                url: "{{ route('ppdb.removeall') }}",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                method: "get",
                                data: {
                                    siswa_id: id
                                },
                                success: function(data) {
                                    console.log(data);
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your data has been deleted.",
                                        icon: "success",
                                    });
                                    window.location.assign("ppdb");
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

@endsection
