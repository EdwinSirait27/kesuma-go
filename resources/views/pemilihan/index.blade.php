@extends('index')

@section('title', 'Kesuma-GO | Pemilihan')

@section('content')

    <style>
        .thumbnail {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .caption {
            text-align: center;
        }

        input[type="checkbox"] {
            margin-top: 10px;
        }
    </style>
   <div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Pemilihan <small>Ketua Osis</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('pemilihan.ngetes') }}" id="voteForm">
                        @csrf
                        @foreach ($calonn as $calon)
                            <div class="col-md-3">
                                <div class="image view view-first">
                                    <img style="width: 100%; display: block;"
                                        src="{{ asset('storage/fotosiswa/' . $calon->foto) }}" alt="image" />
                                </div>
                                <div class="caption">
                                    <p>Nama Lengkap: {{ $calon->siswa->NamaLengkap }}</p>
                                    <p>Visi: {{ $calon->visi }}</p>
                                    <p>Misi: {{ $calon->misi }}</p>
                                    <input type="checkbox" name="osis_id[]" value="{{ $calon->osis_id }}"> Pilih
                                </div>
                            </div>
                        @endforeach
                        <div class="clearfix"></div>
                        <br>

                        <button type="submit" id="voteButton" class="btn btn-primary">Vote !</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Data Voting</h3>
                </div>
                <div class="table-responsive">
                    <form method="POST">
                        @csrf
                        <table id="ekstrakurikulerTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Voting</th>
                                    <th>Keterangan</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($votingg as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            @if ($data->users->guru)
                                                {{ $data->users->guru->Nama }}
                                            @else
                                                {{ $data->users->siswa->NamaLengkap }}
                                            @endif
                                        </td>
                                        <td>{{ $data->tanggal }}</td>
                                        <td>
                                            @if($data->users->hakakses === 'Admin' || $data->users->hakakses === 'Kurikulum')
                                                Guru
                                            @elseif($data->users->hakakses === 'Siswa')
                                                Siswa
                                            @else
                                                Hak akses tidak diketahui
                                            @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Data Voting</h3>
                </div>
                <div class="table-responsive">
                    <form method="POST"action="{{ route('hasilvoting.hapus') }}">
                        @csrf
                        <table id="ekstrakurikulerTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Nama</th>
                                    <th>Tanggal Voting</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($votingg as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            @if ($data->users->guru)
                                                {{ $data->users->guru->Nama }}
                                            @else
                                                {{ $data->users->siswa->NamaLengkap }}
                                            @endif
                                        </td>
                                        <td>{{ $data->tanggal }}</td>
                                        <td>{{ $data->users->hakakses }}</td>
                                        <td>
                                            <input type="checkbox" name="selected_ids[]" value="{{ $data->voting_id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<br>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-users" style="margin-right: 10px;"></i>Hasil Voting</h3>
                </div>
                <div class="table-responsive">
                    <form method="POST" >
                        @csrf
                        <table id="ekstrakurikulerTable1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Calon Ketua Osis</th>
                                    <th>Jumlah Suara</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($hasilvotingg as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->osis->siswa->NamaLengkap }}</td>
                                        <td>{{ $data->jumlahsuara }}</td>
                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (auth()->user()->hakakses == 'Guru')
                            <button type="button" onclick="window.location.href = '/GuruBeranda'"
                                class="btn btn-dark">Kembali</button>
                        @endif
                        @if (auth()->user()->hakakses == 'Siswa')
                            <button type="button" onclick="window.location.href = '/SiswaBeranda'"
                                class="btn btn-dark">Kembali</button>
                        @endif
                        @if (auth()->user()->hakakses == 'Kurikulum')
                            <button type="button" onclick="window.location.href = '/KurikulumBeranda'"
                                class="btn btn-dark">Kembali</button>
                        @endif
                        @if (auth()->user()->hakakses == 'KepalaSekolah')
                            <button type="button" onclick="window.location.href = '/KepalaSekolahBeranda'"
                                class="btn btn-dark">Kembali</button>
                        @endif
                        @if (auth()->user()->hakakses == 'Admin')
                            <button type="button" onclick="window.location.href = '/AdminBeranda'"
                                class="btn btn-dark">Kembali</button>
                        @endif
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>

    <script>
        // Misalnya, Anda ingin menambahkan efek ketika thumbnail dihover
        $(document).ready(function() {
            $('.thumbnail').hover(function() {
                $(this).css('box-shadow', '0px 0px 10px rgba(0,0,0,0.3)');
            }, function() {
                $(this).css('box-shadow', 'none');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#ekstrakurikulerTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "pageLength": 10,
                "dom": 'lBfrtip',
                "buttons": []
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#ekstrakurikulerTable1').DataTable({
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "pageLength": 10,
                "dom": 'lBfrtip',
                "buttons": []
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.getElementById('voteForm').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda akan memberikan suara untuk calon ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Vote',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna menekan "Ya", submit form
                    this.submit();
                }
            });
        });
    </script>
@endsection






{{-- @extends('index')
@section('title', 'Kesuma-GO | Pemilihan')
@section('content')

    <div class="container">
        <h1>Pemilihan Ketua OSIS</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('pemilihan.ngetes') }}">
            @csrf
            <div class="form-group">
                <label for="calon_id">Pilih Calon Ketua OSIS:</label>
                <select class="form-control" id="osis_id" name="osis_id">
                    @foreach ($calonn as $calon)
                        <option value="{{ $calon->osis_id }}">{{ $calon->siswa_id }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Vote</button>
        </form>
    </div>
@endsection --}}

{{-- @extends('index')
@section('title', 'Kesuma-GO | Pemilihan')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Media Gallery <small> gallery design </small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Settings 1</a>
              <a class="dropdown-item" href="#">Settings 2</a>
            </div>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6">
            <div class="thumbnail">
              <div class="image view view-first">
                <img style="width: 100%; display: block;" src="images/media.jpg" alt="image" />
                <div class="mask">
                  <p>Your Text</p>
                  <div class="tools tools-bottom">
                    <a href="#"><i class="fa fa-link"></i></a>
                    <a href="#"><i class="fa fa-pencil"></i></a>
                    <a href="#"><i class="fa fa-times"></i></a>
                  </div>
                </div>
              </div>
              <div class="caption">
                <p>Snow and Ice Incoming for the South</p>
              </div>
            </div>
          </div>
          <!-- Add more col-md-6 divs for additional thumbnails -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection --}}
