@extends('index')
@section('title', 'Kesuma-GO | Beranda')
@section('content')
<style>
    .table th,
    .table td {
        text-align: center;
    }

    /* ini dia */
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
        color: #007bff; /* Change the color on hover as an example */
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
        transform: scale(1.05); /* Scale up on hover as an example */
    }
    .table-active {
background-color: #f5f5f5; /* Ganti dengan warna yang diinginkan */

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
    </head>
    <div class="col-md-12 col-sm-12">
        <h1 style="color: black;">
            <img src="/../../images/Shield_Logos__SMAK_KESUMA (1).png" alt="Gambar" style="vertical-align: middle; margin-right: 10px;">
            Kesuma-Go | <small>Dashboard</small>
        </h1>
        <hr>
        <p class="paragraf" style="color: black; text-align: justify;">Selamat datang di Sistem Informasi Akademik SMAK Kesuma Mataram</p>
        <p2 class="paragraf2" style="color: black; text-align: justify;">
            Sistem Informasi Akademik Kesuma-Go adalah platform yang dirancang khusus untuk memfasilitasi data
            di lembaga pendidikan sekolah. Dengan menggunakan teknologi informasi dan komunikasi, sistem ini bertujuan
            untuk meningkatkan efisiensi dalam proses pendataan dan manajemen sekolah serta mendorong transparansi
            dan
            akuntabilitas dalam pengelolaan pendidikan. Dengan Sistem Informasi Akademik Kesuma-Go, sekolah dapat
            mengoptimalkan proses akademik, meningkatkan kualitas pendidikan, dan memperkuat hubungan antara siswa,
            dan pihak sekolah.
        </p2>
        <hr>
      
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="x_panel tile fixed_height_320 overflow_hidden" style="height: auto;">
                        <div class="x_title">
                            <h2><i class="fa fa-archive" style="margin-right: 10px;"></i>Grafik Siswa Menurut Agama Tahun Ajaran |   
                                @forelse($tahunAkademikAktif as $tahun)
                                    <h2>{{$tahun->tahunakademik}} Semester {{$tahun->semester}}.</h2>
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
                            <hr> 
                        </div>
                    </div>
                    <hr> 
                </div>
                </div>
                </div>
                </div>
    
        <div class="row">
            <br>
            <br>
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-bullhorn" style="margin-right: 10px;"></i>Pengumuman |<small>Sekolah</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="card-box table-responsive">
                                    <table class="table table-striped table-bordered user_datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="text-align: center; width: 5px; font-size: 13px;">No.</th>
                                                <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">Pengumuman</th>
                                                <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">Tanggal Pengumuman</th>
                                                <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">Diupload Oleh</th>
                                                <th scope="col" style="text-align: center; width: 100px; font-size: 13px;">Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h8 style="color: red;">*Perhatikan Tanggal Terbit Pengumuman Tahun-Bulan-Hari.</h8>
                            </div>
                        </div>
                    </div>
                </div>    
                <hr>
            </div>
        </div>
    
        </div>
    </div>
    
            









    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Pengumuman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe id="previewFrame" src=""></iframe>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    maintainAspectRatio: false // Menonaktifkan aspek rasio
                }
            });
        });
    </script>
    
    <script type="text/javascript">
        $(document).ready(function() {
             var table = $('.user_datatable').DataTable({
                 processing: true,
                 serverSide: true,
                 ajax: {
                     url: "{{ route('NonSiswaBeranda.index2') }}",
                     method: "GET"
                 },
                 columns: [
                     {
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
                             var formattedDate = day + '-' + month + '-' + year + ' ' + hours + ':' + minutes + ':' + seconds;
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
                     }
                 ]
             });
 
        
 
            
             $('body').on('click', '.btn-preview', function() {
                 var dokumen = $(this).data('dokumen');
                 var url = "{{ route('NonSiswaBeranda.preview', ':dokumen') }}";
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
 
                     // Set the CSS for body to center the image
                     body.css({
                         display: 'flex',
                         justifyContent: 'center',
                         alignItems: 'center',
                         height: '100%',
                         margin: 0
                     });
 
                     // Set the CSS for the image
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
     </script>
@endsection
