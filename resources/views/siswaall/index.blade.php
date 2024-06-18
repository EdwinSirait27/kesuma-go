@extends('index')
@section('title', 'Kesuma-GO | Data Siswa')
@section('content')
    @include('siswaall.create')
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
    @if (auth()->user()->hakakses == 'Admin' || auth()->user()->hakakses == 'KepalaSekolah')
    <div class="row" id="hal_index">
        <div class="card-header bg-dark text-white">
            <h3><i class="fa fa-male"style="margin-right: 10px; margin-top: 15px;"></i>Data <small> siswa</small></h3>
           
    </div>
    </div>
    <hr>
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-male" style="margin-right: 10px; "></i>List Data<small>Siswa</small></h2>
                <div class="clearfix"></div>
            </div>
            <button type="button" onclick="tambah()" class="btn btn-primary">Tambah
                Siswa</button>
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
                                        width="60">
                                        Foto Siswa
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="150">
                                        Nama Lengkap
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Nomor Induk
                                    </th>

                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Jenis Kelamin
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        NISN
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
                                        Status Aktif
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Kelas
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
                                class="btn btn-success btn-xs">Ubah Status</button>
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
        {{-- <iframe id="preview-frame" width="400" height="300" frameborder="0"></iframe> --}}
        {{-- <iframe id="preview-frame" width="400" height="300" frameborder="0"></iframe> --}}

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


            function tambah() {
                $('#txt_id').val(0);
                $('#NOPDF').val('');
                $('#NamaLengkap').val('');
                $('#NomorInduk').val('');

                $('#NamaPanggilan').val('');
                $('#JenisKelamin').val('');
                $('#NISN').val('');
                $('#TempatLahir').val('');
                $('#TanggalLahir').val('');
                $('#Agama').val('');
                $('#Alamat').val('');
                $('#RT').val('');
                $('#RW').val('');
                $('#Kelurahan').val('');
                $('#Kecamatan').val('');
                $('#KabKota').val('');
                $('#Provinsi').val('');
                $('#KodePos').val('');
                $('#Email').val('');
                $('#NomorTelephone').val('');
                $('#Kewarganegaraan').val('');
                $('#NIK').val('');
                $('#GolDarah').val('');
                $('#TinggalDengan').val('');

                $('#StatusSiswa').val('');
                $('#AnakKe').val('');
                $('#SaudaraKandung').val('');
                $('#SaudaraTiri').val('');

                $('#Tinggicm').val('');
                $('#Beratkg').val('');
                $('#RiwayatPenyakit').val('');

                $('#AsalSMP').val('');
                $('#AlamatSMP').val('');
                $('#NPSNSMP').val('');
                $('#KabKotaSMP').val('');
                $('#ProvinsiSMP').val('');
                $('#NoIjasah').val('');
                $('#NoSKHUN').val('');
                $('#LamaBelajarSMP').val('');
                $('#DiterimaTanggal').val('');
                $('#DiterimaDiKelas').val('');
                $('#DiterimaSemester').val('');
                $('#MutasiAsalSMA').val('');
                $('#AlasanPindah').val('');
                $('#NoPesertaUNSMP').val('');
                $('#TglIjasah').val('');
                $('#NamaOrangTuaPadaIjasah').val('');
                $('#NamaAyah').val('');
                $('#TahunLahirAyah').val('');

                $('#AlamatAyah').val('');
                $('#NomorTelephoneAyah').val('');
                $('#AgamaAyah').val('');
                $('#KebangsaanAyah').val('');
                $('#PendidikanTerakhirAyah').val('');
                $('#PekerjaanAyah').val('');
                $('#PenghasilanAyah').val('');
                $('#AyahMasihHidupMeninggal').val('');
                $('#NIKAyah').val('');
                $('#NamaIbu').val('');
                $('#TahunLahirIbu').val('');
                $('#AlamatIbu').val('');
                $('#NomorTelephoneIbu').val('');
                $('#AgamaIbu').val('');

                $('#PendidikanTerakhirIbu').val('');
                $('#PekerjaanIbu').val('');
                $('#PenghasilanIbu').val('');

                $('#NamaWali').val('');
                $('#TahunLahirWali').val('');
                $('#AlamatWali').val('');
                $('#NomorTelephoneWali').val('');
                $('#AgamaWali').val('');

                $('#PendidikanTerakhirWali').val('');
                $('#PekerjaanWali').val('');
                $('#WaliPenghasilan').val('');
                $('#StatusHubunganWali').val('');

                $('#MenerimaBeasiswaDari').val('');
                $('#TahunMeninggalkanSekolah').val('');
                $('#AlasanSebab').val('');
                $('#TamatBelajarTahun').val('');
                $('#TanggalNomorSTTB').val('');
                $('#MelanjutkanKe').val('');
                $('#BekerjaPada').val('');
                $('#InformasiLain').val('');
                $('#cita').val('');
                $('#status').val('');

                $('#foto').val('');
                $('#username').val('');
                $('#password').val('');
                $('#hakakses').val('');

                iForm('hal_edit');
            }



            function editAndShow(iv, id) {
                $.ajax({
                    url: "/siswaall-edit/" + id,
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
            $(document).ready(function() {
                var table = $('.user_datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('siswaall.index1') }}",
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
            return '<img src="{{ asset('storage/fotosiswa/') }}/' + data + '" width="100" />';
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
                            data: 'NomorInduk',
                            name: 'NomorInduk'
                        },



                        {
                            data: 'JenisKelamin',
                            name: 'JenisKelamin'
                        },
                        {
                            data: 'NISN',
                            name: 'NISN'
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
                            data: 'status',
                            name: 'status',
                            render: function(data, type, full, meta) {
                                // Logika untuk memberikan warna
                                var colorClass = data === 'Aktif' ? 'text-success' : 'text-danger';
                                return '<span class="' + colorClass + '">' + data + '</span>';
                            }
                        },
                        {
                            data: 'kelas.namakelas',
                            name: 'kelas.namakelas',
                            defaultContent: 'Belum ada kelas'
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
          


            // $(document).on('click', '#bulk_delete', function() {
            //     var id = [];
            //     Swal.fire({
            //         title: "Apakah Yakin?",
            //         text: "Data Tidak Bisa Kembali",
            //         icon: "warning",
            //         showCancelButton: true,
            //         confirmButtonColor: "#3085d6",
            //         cancelButtonColor: "#d33",
            //         confirmButtonText: "Ya, Hapus",
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             var id = [];
            //             $('.users_checkbox:checked').each(function() {
            //                 id.push($(this).val());
            //             });
            //             if (id.length > 0) {
            //                 $.ajax({
            //                     url: "{{ route('siswaall.removeall') }}", // Hapus 'kurikulum_id' => ''
            //                     headers: {
            //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                     },
            //                     method: "get",
            //                     data: {
            //                         siswa_id: id // Ganti 'kurikulum_id' dengan 'id_kur'
            //                     },
            //                     success: function(data) {
            //                         console.log(data);
            //                         Swal.fire({
            //                             title: "Deleted!",
            //                             text: "Your data has been deleted.",
            //                             icon: "success",
            //                         });
            //                         window.location.assign("siswaall");
            //                     },
            //                     error: function(data) {
            //                         var errors = data.responseJSON;
            //                         console.log(errors);
            //                     }
            //                 });
            //             } else {
            //                 Swal.fire({
            //                     title: "Tidak Ada Data Yang Tercentang",
            //                     text: "Dicentang Dulu Baru Bisa Dihapus Ya Admin:)",
            //                     icon: "warning",
            //                 });
            //             }
            //         }
            //     });
            // });
        </script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('myDataTable').DataTable({
                    "pageLength": 10, // Menampilkan 10 data per halaman secara default
                    "lengthMenu": [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "Semua"]
                    ]
                });

                // Menambahkan opsi "Semua" ke dalam dropdown "Show entries"
                $('.dataTables_length select').append('<option value="-1">Semua</option>');

                // Mengubah tampilan "Semua" menjadi teks yang lebih jelas
                $('.dataTables_length select option[value="-1"]').text('Semua');

                // Mengatur agar tabel menampilkan semua entri saat "Semua" dipilih
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
<script>
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
                        url: "{{ route('siswaall.removeall') }}",
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
                            window.location.assign("siswaall"); // Pastikan URL ini benar
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
        $(document).on('click', '#bulk_update', function() {
            // Menampilkan peringatan menggunakan SweetAlert
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Ini akan mengubah Status siswa yang dipilih menjadi 'Lulus'.",
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
                    url: "{{ route('siswaall.updatesiswa') }}",
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

@endif


    @if (auth()->user()->hakakses == 'Siswa' ||
            auth()->user()->hakakses == 'Kurikulum' ||
            auth()->user()->hakakses == 'Guru')
        <div class="row" id="hal_index">
            <div class="col-md-12 col-sm-12">
                <h3><i class="fa fa-male" style="margin-right: 10px; margin-top: 15px;"></i>Data <small>Siswa</small></h3>
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
                                        width="60">
                                        Foto Siswa
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="150">
                                        Nama Lengkap
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Nomor Induk
                                    </th>

                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Jenis Kelamin
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        NISN
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
                                        Status Aktif
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom"
                                        width="120">
                                        Kelas
                                    </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                @if (auth()->user()->hakakses == 'Siswa')
                                    <button type="button" onclick="window.location.href = '/SiswaBeranda'"
                                        class="btn btn-danger">Kembali</button>
                                @endif
                                @if (auth()->user()->hakakses == 'Guru')
                                    <button type="button" onclick="window.location.href = '/GuruBeranda'"
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

        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('.user_datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('siswaall.index1') }}",
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
            return '<img src="{{ asset('storage/fotosiswa/') }}/' + data + '" width="100" />';
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
                            data: 'NomorInduk',
                            name: 'NomorInduk'
                        },



                        {
                            data: 'JenisKelamin',
                            name: 'JenisKelamin'
                        },
                        {
                            data: 'NISN',
                            name: 'NISN'
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
                            data: 'status',
                            name: 'status',
                            render: function(data, type, full, meta) {
                                // Logika untuk memberikan warna
                                var colorClass = data === 'Aktif' ? 'text-success' : 'text-danger';
                                return '<span class="' + colorClass + '">' + data + '</span>';
                            }
                        },
                        {
                            data: 'kelas.namakelas',
                            name: 'kelas.namakelas',
                            defaultContent: 'Belum ada kelas'
                        }
                    ]
                });
            });
        </script>
            
            <script type = "text/javascript" >
                $(document).ready(function() {
                    var table = $('myDataTable').DataTable({
                        "pageLength": 10, // Menampilkan 10 data per halaman secara default
                        "lengthMenu": [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "Semua"]
                        ]
                    });

                    // Menambahkan opsi "Semua" ke dalam dropdown "Show entries"
                    $('.dataTables_length select').append('<option value="-1">Semua</option>');

                    // Mengubah tampilan "Semua" menjadi teks yang lebih jelas
                    $('.dataTables_length select option[value="-1"]').text('Semua');

                    // Mengatur agar tabel menampilkan semua entri saat "Semua" dipilih
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
@endsection
