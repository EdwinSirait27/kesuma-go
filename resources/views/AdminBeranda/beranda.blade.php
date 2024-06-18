@extends('index')
@section('title', 'Kesuma-GO | Beranda')
@section('content')
    <style>
        .table th,
        .table td {
            text-align: center;
        }

        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }

        .data tbody tr:hover {
            background-color: lightyellow;

        }

        .hidden {
            display: none;
        }

        .paragraf {
            font-size: 18px;
        }

        .paragraf2 {
            font-size: 15px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }

        .count {
            font-size: 24px;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        .count:hover {
            color: #007bff;
        }

        .count-top {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .count-bottom {
            font-size: 12px;
            color: #777;
            display: block;
        }

        .tile_stats_count {
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .tile_stats_count:hover {
            transform: scale(1.05);
        }

        .table-active {
            background-color: #f5f5f5;
    
        }

        .modal-dialog {
            max-width: 90%;
            width: auto;
        }

        .modal-content {
            width: 100%;
        }

        .modal-body {
            padding: 0;
        }

        #previewFrame {
            width: 100%;
            height: 500px;
            border: none;
        }
        




        
    </style>



<div class="col-md-12 col-sm-12">
    <h1 style="color: black;">
        <img src="/../../images/tes.ico" alt="images" width="55" height="55" style="vertical-align: middle; margin-right: 10px;">
        Kesuma-Go | <small>Dashboard</small>
    </h1>
    <hr>
    <p class="paragraf" style="color: black; text-align: justify;">Selamat datang di Sistem Informasi Akademik SMAK Kesuma Mataram</p>
    <p class="paragraf2" style="color: black; text-align: justify;">
        Sistem Informasi Akademik Kesuma-Go adalah platform yang dirancang khusus untuk memfasilitasi data di lembaga pendidikan sekolah. Dengan menggunakan teknologi informasi dan komunikasi, sistem ini bertujuan untuk meningkatkan efisiensi dalam proses pendataan dan manajemen sekolah serta mendorong transparansi dan akuntabilitas dalam pengelolaan pendidikan. Dengan Sistem Informasi Akademik Kesuma-Go, sekolah dapat mengoptimalkan proses akademik, meningkatkan kualitas pendidikan, dan memperkuat hubungan antara siswa, dan pihak sekolah.
    </p>
    <hr>

    <div class="row" style="display: inline-block;">
        <div class="tile_count">
            <div class="col-md-3 col-sm-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total User</span>
                <div class="count blue" id="totalUser">{{ $totalUser }}</div>
                <span class="count_bottom"><i class="blue">{{ $totalUser }}</i> Pengguna Aktif</span>
            </div>
            <div class="col-md-3 col-sm-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Laki-Laki</span>
                <div class="count blue" id="totalLakiLaki">{{ $totalLakiLaki }}</div>
                <span class="count_bottom"><i class="blue">{{ $totalLakiLaki }}</i> Siswa Laki-Laki</span>
            </div>
            <div class="col-md-3 col-sm-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Perempuan</span>
                <div class="count" id="totalPerempuan">{{ $totalPerempuan }}</div>
                <span class="count_bottom"><i class="red">{{ $totalPerempuan }}</i> Siswa Perempuan</span>
            </div>
            <div class="col-md-3 col-sm-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Guru dan Staff</span>
                <div class="count" id="totalGuru">{{ $totalGuru }}</div>
                <span class="count_bottom"><i class="green">{{ $totalGuru }}</i> Total Guru dan Staff</span>
            </div>
        </div>
    </div>
    <hr>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden" style="height: auto;">
                <div class="x_title">
                    <h2><i class="fa fa-archive" style="margin-right: 10px;"></i>Grafik Siswa Menurut Agama Tahun Ajaran |
                        @forelse($tahunAkademikAktif as $tahun)
                            <h2>{{ $tahun->tahunakademik }} Semester {{ $tahun->semester }}</h2>
                        @empty
                            <h2>Tidak ada Tahun Akademik aktif.</h2>
                        @endforelse
                    </h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <canvas id="grafikAgama" style="height: 400px;"></canvas>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered data" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Agama</th>
                                            <th>Presentase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Katolik</td>
                                            <td>{{ $persentaseAgamaKatolik }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Kristen Protestan</td>
                                            <td>{{ $persentaseAgamaKristenProtestan }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Islam</td>
                                            <td>{{ $persentaseAgamaIslam }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Hindu</td>
                                            <td>{{ $persentaseAgamaHindu }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Buddha</td>
                                            <td>{{ $persentaseAgamaBuddha }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Konghucu</td>
                                            <td>{{ $persentaseAgamaKonghucu }}%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
</div>

<div class="row">
    <br>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bullhorn" style="margin-right: 10px;"></i>Pengumuman |<small>Sekolah</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table class="table table-striped table-bordered user_datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center; width: 5px; font-size: 13px;">No.</th>
                                        <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">Pengumuman</th>
                                        <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">Tanggal Pengumuman</th>
                                        <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">Diupload Oleh</th>
                                        <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">Action</th>
                                        <th width="5px" style="text-align: center; font-size: 15px;">
                                            <button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs">Delete</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h8 style="color: red;">*Perhatikan Tanggal Terbit Pengumuman Hari-Bulan-Tahun-Jam.</h8>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="x_panel tile fixed_height_320 overflow_hidden">
            <div class="x_title">
                <div class="row">
                    <div class="col-md-10 col-sm-12">
                        <h2><i class="fa fa-cloud" style="margin-right: 10px;"></i>Upload Pengumuman | <small>Sekolah</small></h2>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <form action="{{ route('simpan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" id="submitBtn" class="btn btn-success"><i class="bi bi-plus-square"></i> Simpan</button>
                        
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-8" style="display: flex; flex-direction: column; align-items: flex-end; justify-content: center; height: 100%;">
                <div class="d-flex justify-content-end align-items-center" style="height: 100%; margin-left: auto;">
                    <div class="text-center">
                        <label for="dokumen" class="form-label">Choose File</label>
                        <input type="file" onchange="readdokumen(event)" class="form-control" id="dokumen" name="dokumen" value="{{ old('dokumen') }}">
                    </div>
                </div>
                <img id="output" style="width: 100px;">
                @error('dokumen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </form>
            </div>
        </div>
        <h8 style="color: red;">*Jika Ingin Mengupload File Pengumuman Gunakan Ekstensi doc, docx, pdf, xls, xlsx, ppt, pptx</h8>
     
    </div>

      <div class="container">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Grafik Pendaftaran Ppdb</h2>
              <div class="col-md-4 float-right">
                <select id="tamat" class="form-control">
                    <option value="">Pilih Tahun PPDB</option>
                    @foreach($availableYears as $tama)
                        <option value="{{ $tama }}">{{ $tama }}</option>
                    @endforeach
                </select>
                
            </div>
              <div class="clearfix"></div>
            </div>
           
              <div class="col-md-12">
                <canvas id="myChart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
     
               
    
   
    
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/aterrien/jQuery-Knob/master/js/jquery.knob.js"></script>
    <script>
        $('#tamat').on('change', function() {
            var selectedYear = $(this).val(); 
            table.ajax.url("{{ route('AdminBeranda') }}?tahundaftar=" + selectedYear).load();
        });
    </script>
    
    <script>
        $(document).ready(function() {
            $('#tamat').on('change', function() {
                var selectedYear = $(this).val();
                $.ajax({
                    url: "{{ route('AdminBeranda') }}",
                    data: { tahundaftar: selectedYear },
                    success: function(data) {
                        updateChart(data);
                    }
                });
            });
    
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jumlah Mendaftar', 'Laki-Laki', 'Perempuan', 'Agama Katolik', 'Agama Kristen Protestan', 'Agama Buddha', 'Agama Hindu', 'Agama Islam', 'Agama Konghucu'],
                    datasets: [{
                        label: 'Presentase',
                        data: [{{ $totalnon }}, {{ $totallak }}, {{ $totalper }}, {{ $totalkat }}, {{ $totalkris }}, {{ $totalbud }}, {{ $totalhin }}, {{ $totalis }}, {{ $totalko }}],
                        backgroundColor: 'rgba(38, 185, 154, 0.2)',
                        borderColor: 'rgba(38, 185, 154, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
    
            function updateChart(data) {
                myChart.data.datasets[0].data = [
                    data.totalnon,
                    data.totallak,
                    data.totalper,
                    data.totalkat,
                    data.totalkris,
                    data.totalbud,
                    data.totalhin,
                    data.totalis,
                    data.totalko
                ];
                myChart.update();
            }
        });
    </script>
    </div>

<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="previewFrame" src="" style="width: 100%; height: 80vh; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>


            <script>
                $(document).ready(function() {
                    $(".count").each(function() {
                        $(this).prop('Counter', 0).animate({
                            Counter: $(this).text()
                        }, {
                            duration: 1000,
                            easing: 'swing',
                            step: function(now) {
                                $(this).text(Math.ceil(now));
                            }
                        });
                    });
                });
            </script>

        <script>
            $(document).ready(function() {
                $('table.data tbody tr').hover(
                    function() {
                        $(this).addClass('table-active');
                    },
                    function() {
                        $(this).removeClass('table-active');
                    }
                );
            });
        </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/aterrien/jQuery-Knob/master/js/jquery.knob.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('grafikAgama').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Katolik', 'Kristen Protestan', 'Islam', 'Buddha', 'Hindu', 'Konghucu'],
                    datasets: [{
                        data: [{{ $persentaseAgamaKatolik }}, {{ $totalAgamaKristenProtestan }},
                            {{ $totalAgamaIslam }}, {{ $totalAgamaBuddha }},
                            {{ $totalAgamaHindu }}, {{ $totalAgamaKonghucu }}
                        ],
                        backgroundColor: ['#FF6384', '#36A2EB', '#035F38', '#FF9F40', '#4BC0C0',
                            '#8A2BE2'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'bottom',
                    },
                    maintainAspectRatio: false 
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('AdminBeranda.index2') }}",
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
                        data: 'dokumen',
                        name: 'dokumen',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            var date = new Date(data);
                            var day = date.getDate();
                            var month = date.getMonth() + 1;
                            var year = date.getFullYear();
                            var hours = date.getHours();
                            var minutes = date.getMinutes();
                            var seconds = date.getSeconds();
                            var formattedDate = day + '-' + month + '-' + year + ' ' + hours + ':' +
                                minutes + ':' + seconds;
                            return formattedDate;
                        }
                    },
                    {
                        data: 'oleh',
                        name: 'oleh',
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



            $('body').on('click', '.btn-preview', function() {
                var dokumen = $(this).data('dokumen');
                var url = "{{ route('AdminBeranda.preview', ':dokumen') }}";
                url = url.replace(':dokumen', dokumen);
                var iframe = $('#previewFrame');
                iframe.attr('src', url);
                $('#previewModal').modal('show');

                iframe.on('load', function() {
                    iframe.css({
                        width: '100%',
                        height: '500px'
                    });
                    var body = iframe.contents().find('body');
                    var image = body.find('img');

                    body.css({
                        display: 'flex',
                        justifyContent: 'center',
                        alignItems: 'center',
                        height: '100%',
                        margin: 0
                    });

                    image.css({
                        maxWidth: '100%',
                        maxHeight: '100%',
                        width: 'auto',
                        height: 'auto'
                    });

                    image.on('load', function() {
                        var width = this.naturalWidth;
                        var height = this.naturalHeight;
                        var maxHeight = $(window).height() * 0.8;
                        height = height > maxHeight ? maxHeight : height;
                        iframe.css({
                            height: height + 'px'
                        });
                        $('.modal-dialog').css({
                            width: 'auto'
                        });
                    });
                });
            });

        });
        $(document).on('click', '#bulk_delete', function() {
            var id = [];
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Sudah Yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.users_checkbox:checked').each(function() {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: "{{ route('AdminBeranda.removeall') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "get",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Terhapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    window.location.assign("AdminBeranda");
                                });
                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    } else {
                        Swal.fire('Anda Belum Mengisi Checkbox');
                    }
                }
            });
        });
    </script>

 
@endsection

{{-- @extends('index')
@section('title', 'Kesuma-GO | Beranda')
@section('content')
    <style>
        .table th,
        .table td {
            text-align: center;
        }

        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }

        .data tbody tr:hover {
            background-color: lightyellow;

        }

        .hidden {
            display: none;
        }

        .paragraf {
            font-size: 18px;
        }

        .paragraf2 {
            font-size: 15px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }

        .count {
            font-size: 24px;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        .count:hover {
            color: #007bff;
        }

        .count-top {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .count-bottom {
            font-size: 12px;
            color: #777;
            display: block;
        }

        .tile_stats_count {
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
        }

        .tile_stats_count:hover {
            transform: scale(1.05);
        }

        .table-active {
            background-color: #f5f5f5;
    
        }

        .modal-dialog {
            max-width: 90%;
            width: auto;
        }

        .modal-content {
            width: 100%;
        }

        .modal-body {
            padding: 0;
        }

        #previewFrame {
            width: 100%;
            height: 500px;
            border: none;
        }
        




        
    </style>



<div class="col-md-12 col-sm-12">
    <h1 style="color: black;">
        <img src="/../../images/tes.ico" alt="images" width="55" height="55" style="vertical-align: middle; margin-right: 10px;">
        Kesuma-Go | <small>Dashboard</small>
    </h1>
    <hr>
    <p class="paragraf" style="color: black; text-align: justify;">Selamat datang di Sistem Informasi Akademik SMAK Kesuma Mataram</p>
    <p class="paragraf2" style="color: black; text-align: justify;">
        Sistem Informasi Akademik Kesuma-Go adalah platform yang dirancang khusus untuk memfasilitasi data di lembaga pendidikan sekolah. Dengan menggunakan teknologi informasi dan komunikasi, sistem ini bertujuan untuk meningkatkan efisiensi dalam proses pendataan dan manajemen sekolah serta mendorong transparansi dan akuntabilitas dalam pengelolaan pendidikan. Dengan Sistem Informasi Akademik Kesuma-Go, sekolah dapat mengoptimalkan proses akademik, meningkatkan kualitas pendidikan, dan memperkuat hubungan antara siswa, dan pihak sekolah.
    </p>
    <hr>

    <div class="row" style="display: inline-block;">
        <div class="tile_count">
            <div class="col-md-3 col-sm-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total User</span>
                <div class="count blue" id="totalUser">{{ $totalUser }}</div>
                <span class="count_bottom"><i class="blue">{{ $totalUser }}</i> Pengguna Aktif</span>
            </div>
            <div class="col-md-3 col-sm-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Laki-Laki</span>
                <div class="count blue" id="totalLakiLaki">{{ $totalLakiLaki }}</div>
                <span class="count_bottom"><i class="blue">{{ $totalLakiLaki }}</i> Siswa Laki-Laki</span>
            </div>
            <div class="col-md-3 col-sm-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Perempuan</span>
                <div class="count" id="totalPerempuan">{{ $totalPerempuan }}</div>
                <span class="count_bottom"><i class="red">{{ $totalPerempuan }}</i> Siswa Perempuan</span>
            </div>
            <div class="col-md-3 col-sm-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total Guru dan Staff</span>
                <div class="count" id="totalGuru">{{ $totalGuru }}</div>
                <span class="count_bottom"><i class="green">{{ $totalGuru }}</i> Total Guru dan Staff</span>
            </div>
        </div>
    </div>
    <hr>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="x_panel tile fixed_height_320 overflow_hidden" style="height: auto;">
                <div class="x_title">
                    <h2><i class="fa fa-archive" style="margin-right: 10px;"></i>Grafik Siswa Menurut Agama Tahun Ajaran |
                        @forelse($tahunAkademikAktif as $tahun)
                            <h2>{{ $tahun->tahunakademik }} Semester {{ $tahun->semester }}</h2>
                        @empty
                            <h2>Tidak ada Tahun Akademik aktif.</h2>
                        @endforelse
                    </h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <canvas id="grafikAgama" style="height: 400px;"></canvas>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered data" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Agama</th>
                                            <th>Presentase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Katolik</td>
                                            <td>{{ $persentaseAgamaKatolik }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Kristen Protestan</td>
                                            <td>{{ $persentaseAgamaKristenProtestan }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Islam</td>
                                            <td>{{ $persentaseAgamaIslam }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Hindu</td>
                                            <td>{{ $persentaseAgamaHindu }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Buddha</td>
                                            <td>{{ $persentaseAgamaBuddha }}%</td>
                                        </tr>
                                        <tr>
                                            <td>Konghucu</td>
                                            <td>{{ $persentaseAgamaKonghucu }}%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
</div>

<div class="row">
    <br>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bullhorn" style="margin-right: 10px;"></i>Pengumuman |<small>Sekolah</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table class="table table-striped table-bordered user_datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center; width: 5px; font-size: 13px;">No.</th>
                                        <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">Pengumuman</th>
                                        <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">Tanggal Pengumuman</th>
                                        <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">Diupload Oleh</th>
                                        <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">Action</th>
                                        <th width="5px" style="text-align: center; font-size: 15px;">
                                            <button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs">Delete</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h8 style="color: red;">*Perhatikan Tanggal Terbit Pengumuman Hari-Bulan-Tahun-Jam.</h8>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="x_panel tile fixed_height_320 overflow_hidden">
            <div class="x_title">
                <div class="row">
                    <div class="col-md-10 col-sm-12">
                        <h2><i class="fa fa-cloud" style="margin-right: 10px;"></i>Upload Pengumuman | <small>Sekolah</small></h2>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <form action="{{ route('simpan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button type="submit" id="submitBtn" class="btn btn-success"><i class="bi bi-plus-square"></i> Simpan</button>
                        
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-8" style="display: flex; flex-direction: column; align-items: flex-end; justify-content: center; height: 100%;">
                <div class="d-flex justify-content-end align-items-center" style="height: 100%; margin-left: auto;">
                    <div class="text-center">
                        <label for="dokumen" class="form-label">Choose File</label>
                        <input type="file" onchange="readdokumen(event)" class="form-control" id="dokumen" name="dokumen" value="{{ old('dokumen') }}">
                    </div>
                </div>
                <img id="output" style="width: 100px;">
                @error('dokumen')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </form>
            </div>
        </div>
        <h8 style="color: red;">*Jika Ingin Mengupload File Pengumuman Gunakan Ekstensi doc, docx, pdf, xls, xlsx, ppt, pptx</h8>
     
    </div>

      <div class="container">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Grafik Pendaftaran Ppdb</h2>
              <div class="col-md-4 float-right">
                <select id="tamat" class="form-control">
                    <option value="">Pilih Tahun PPDB</option>
                    @foreach($availableYears as $tama)
                        <option value="{{ $tama }}">{{ $tama }}</option>
                    @endforeach
                </select>
                
            </div>
              <div class="clearfix"></div>
            </div>
           
              <div class="col-md-12">
                <canvas id="myChart" width="400" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
     
               
    
   
    
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/aterrien/jQuery-Knob/master/js/jquery.knob.js"></script>
    <script>
        $('#tamat').on('change', function() {
            var selectedYear = $(this).val(); 
            table.ajax.url("{{ route('AdminBeranda') }}?tahundaftar=" + selectedYear).load();
        });
    </script>
    
    <script>
        $(document).ready(function() {
            $('#tamat').on('change', function() {
                var selectedYear = $(this).val();
                $.ajax({
                    url: "{{ route('AdminBeranda') }}",
                    data: { tahundaftar: selectedYear },
                    success: function(data) {
                        updateChart(data);
                    }
                });
            });
    
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jumlah Mendaftar', 'Laki-Laki', 'Perempuan', 'Agama Katolik', 'Agama Kristen Protestan', 'Agama Buddha', 'Agama Hindu', 'Agama Islam', 'Agama Konghucu'],
                    datasets: [{
                        label: 'Presentase',
                        data: [{{ $totalnon }}, {{ $totallak }}, {{ $totalper }}, {{ $totalkat }}, {{ $totalkris }}, {{ $totalbud }}, {{ $totalhin }}, {{ $totalis }}, {{ $totalko }}],
                        backgroundColor: 'rgba(38, 185, 154, 0.2)',
                        borderColor: 'rgba(38, 185, 154, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
    
            function updateChart(data) {
                myChart.data.datasets[0].data = [
                    data.totalnon,
                    data.totallak,
                    data.totalper,
                    data.totalkat,
                    data.totalkris,
                    data.totalbud,
                    data.totalhin,
                    data.totalis,
                    data.totalko
                ];
                myChart.update();
            }
        });
    </script>
    </div>

<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="previewFrame" src="" style="width: 100%; height: 80vh; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>


            <script>
                $(document).ready(function() {
                    $(".count").each(function() {
                        $(this).prop('Counter', 0).animate({
                            Counter: $(this).text()
                        }, {
                            duration: 1000,
                            easing: 'swing',
                            step: function(now) {
                                $(this).text(Math.ceil(now));
                            }
                        });
                    });
                });
            </script>

        <script>
            $(document).ready(function() {
                $('table.data tbody tr').hover(
                    function() {
                        $(this).addClass('table-active');
                    },
                    function() {
                        $(this).removeClass('table-active');
                    }
                );
            });
        </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/aterrien/jQuery-Knob/master/js/jquery.knob.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('grafikAgama').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Katolik', 'Kristen Protestan', 'Islam', 'Buddha', 'Hindu', 'Konghucu'],
                    datasets: [{
                        data: [{{ $persentaseAgamaKatolik }}, {{ $totalAgamaKristenProtestan }},
                            {{ $totalAgamaIslam }}, {{ $totalAgamaBuddha }},
                            {{ $totalAgamaHindu }}, {{ $totalAgamaKonghucu }}
                        ],
                        backgroundColor: ['#FF6384', '#36A2EB', '#035F38', '#FF9F40', '#4BC0C0',
                            '#8A2BE2'
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'bottom',
                    },
                    maintainAspectRatio: false 
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('AdminBeranda.index2') }}",
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
                        data: 'dokumen',
                        name: 'dokumen',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            var date = new Date(data);
                            var day = date.getDate();
                            var month = date.getMonth() + 1;
                            var year = date.getFullYear();
                            var hours = date.getHours();
                            var minutes = date.getMinutes();
                            var seconds = date.getSeconds();
                            var formattedDate = day + '-' + month + '-' + year + ' ' + hours + ':' +
                                minutes + ':' + seconds;
                            return formattedDate;
                        }
                    },
                    {
                        data: 'oleh',
                        name: 'oleh',
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



            $('body').on('click', '.btn-preview', function() {
                var dokumen = $(this).data('dokumen');
                var url = "{{ route('AdminBeranda.preview', ':dokumen') }}";
                url = url.replace(':dokumen', dokumen);
                var iframe = $('#previewFrame');
                iframe.attr('src', url);
                $('#previewModal').modal('show');

                iframe.on('load', function() {
                    iframe.css({
                        width: '100%',
                        height: '500px'
                    });
                    var body = iframe.contents().find('body');
                    var image = body.find('img');

                    body.css({
                        display: 'flex',
                        justifyContent: 'center',
                        alignItems: 'center',
                        height: '100%',
                        margin: 0
                    });

                    image.css({
                        maxWidth: '100%',
                        maxHeight: '100%',
                        width: 'auto',
                        height: 'auto'
                    });

                    image.on('load', function() {
                        var width = this.naturalWidth;
                        var height = this.naturalHeight;
                        var maxHeight = $(window).height() * 0.8;
                        height = height > maxHeight ? maxHeight : height;
                        iframe.css({
                            height: height + 'px'
                        });
                        $('.modal-dialog').css({
                            width: 'auto'
                        });
                    });
                });
            });

        });
        $(document).on('click', '#bulk_delete', function() {
            var id = [];
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Sudah Yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.users_checkbox:checked').each(function() {
                        id.push($(this).val());
                    });
                    if (id.length > 0) {
                        $.ajax({
                            url: "{{ route('AdminBeranda.removeall') }}",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "get",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Terhapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function() {
                                    window.location.assign("AdminBeranda");
                                });
                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    } else {
                        Swal.fire('Anda Belum Mengisi Checkbox');
                    }
                }
            });
        });
    </script>

 
@endsection
 --}}
