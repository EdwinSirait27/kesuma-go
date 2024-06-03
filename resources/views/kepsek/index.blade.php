@extends('index')
@section('title', 'Kesuma-GO | Data Kepala Sekolah')
@section('content')
    <style>
          <style>
        .col-form-label {
            font-size: 18px;
        }
    
        .dashboard_graph {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .x_title h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .x_title i {
            font-size: 32px;
        }

        .upload-form {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
            height: 100%;
        }

        .upload-form button {
            margin-bottom: 1rem;
        }

        .card-box {
            margin-top: 20px;
        }

        .table thead th {
            font-size: 14px;
        }

        .table tbody td {
            font-size: 13px;
        }

        .table thead th,
        .table tbody td {
            text-align: center;
        }

        .delete-btn {
            background-color: #d9534f;
            border-color: #d9534f;
        }

        .delete-btn:hover {
            background-color: #c9302c;
            border-color: #ac2925;
        }

        .upload-info {
            color: red;
        }
        .col-form-label {
            font-size: 18px;
        }
    </style>
    <div class="row">
        <div class="col-md-6">
            <!-- Bagian Form Input Data Kepala Sekolah -->
            <div class="dashboard_graph">
                <h3><i class="fa fa-bank"></i> Data Kepala <small>Sekolah</small></h3>
                <hr>
                <form action="{{ isset($data) ? route('kepsek.update', ['id' => $data->id]) : route('kepsek.storeOrUpdate') }}" method="post">
                    @csrf
                    <!-- Isi Formulir Input Data Kepala Sekolah -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (isset($data))
                        @method('PUT')
                    @endif
                    <!-- Form Input Data Kepala Sekolah -->
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama
                            Kepala Sekolah</label>
                        <div class="col-sm-4">
                           
                                <input type="text" class="form-control" name="nama" placeholder="Nama"
                                maxlength="40" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                              value="{{ isset($data) ? $data->nama : '' }}">
                        </div>
                        <label for="tempatlahir" class="col-sm-2 col-form-label"> Tempat Lahir </label>
                        <div class="col-sm-4">
                           
                                <input type="text" class="form-control" name="tempatlahir" placeholder="Tempat Lahir"
                                maxlength="20" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                              value="{{ isset($data) ? $data->tempatlahir : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ttl" class="col-sm-2 col-form-label">Tanggal Lahir </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="ttl" placeholder="Tanggal Lahir"
                                 value="{{ isset($data) ? $data->ttl : '' }}" required>
                        </div>
                        <label for="nomor" class="col-sm-2 col-form-label"> Nomor Telephone </label>
                        <div class="col-sm-4">
                           
                                <input type="text" class="form-control" name="nomor" placeholder="Nomor Telephone"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="13"
                                value="{{ isset($data) ? $data->nomor : '' }}"required>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label"> Email </label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                maxlength="50" value="{{ isset($data) ? $data->email : '' }}">
                        </div>
                        <label for="sd" class="col-sm-2 col-form-label"> Asal SD </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="sd" placeholder="Asal Sekolah Dasar" maxlength="50"
                                value="{{ isset($data) ? $data->sd : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahunlulussd" class="col-sm-2 col-form-label">Tahun Lulus SD</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="tahunlulussd" placeholder="Tahun Lulus SD"
                                 value="{{ isset($data) ? $data->tahunlulussd : '' }}">
                        </div>
                        <label for="smp" class="col-sm-2 col-form-label"> Asal SMP </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="smp" placeholder="Asal Sekolah Menengah Pertama" maxlength="40"
                                value="{{ isset($data) ? $data->smp : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahunlulussmp" class="col-sm-2 col-form-label">Tahun Lulus SMP </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="tahunlulussmp" placeholder="Tahun Lulus SMP"
                                 value="{{ isset($data) ? $data->tahunlulussmp : '' }}">
                        </div>
                        <label for="sma" class="col-sm-2 col-form-label"> Asal SMA </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="sma" placeholder="Asal SMA" maxlength="40"
                                value="{{ isset($data) ? $data->sma : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahunlulussma" class="col-sm-2 col-form-label">Tahun Lulus SMA</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="tahunlulussma" placeholder="Tahun Lulus Sma"
                                 value="{{ isset($data) ? $data->tahunlulussma : '' }}">
                        </div>
                        <label for="s1" class="col-sm-2 col-form-label"> Jurusan S1 </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="s1" placeholder="Jurusan S1" maxlength="40"
                                value="{{ isset($data) ? $data->s1 : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="institusis1" class="col-sm-2 col-form-label">Asal Institusi S1</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="institusis1" placeholder="Asal Institusi S1"
                                maxlength="30" value="{{ isset($data) ? $data->institusis1 : '' }}">
                        </div>
                        <label for="tahunluluss1" class="col-sm-2 col-form-label"> Tahun Lulus S1 </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="tahunluluss1" placeholder="Tahun Lulus S1" 
                                value="{{ isset($data) ? $data->tahunluluss1 : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="s2" class="col-sm-2 col-form-label">Jurusan S2</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="s2" placeholder="Jurusan S2"
                                maxlength="40" value="{{ isset($data) ? $data->s2 : '' }}">
                        </div>
                        <label for="institusis2" class="col-sm-2 col-form-label">Asal Institusi S2</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="institusis2" placeholder="Asal Institusi S2"
                                maxlength="30" value="{{ isset($data) ? $data->institusis2 : '' }}">
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="tahunluluss2" class="col-sm-2 col-form-label"> Tahun Lulus S2 </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="tahunluluss2" placeholder="Tahun Lulus S2" 
                                value="{{ isset($data) ? $data->tahunluluss2 : '' }}">
                        </div>
                        <label for="s2" class="col-sm-2 col-form-label">Jurusan S3</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="s3" placeholder="Jurusan S3"
                                maxlength="40" value="{{ isset($data) ? $data->s3 : '' }}">
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="institusis3" class="col-sm-2 col-form-label">Asal Institusi S3</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="institusis3" placeholder="Asal Institusi S3"
                                    maxlength="30" value="{{ isset($data) ? $data->institusis3 : '' }}">
                            </div>
                            <label for="tahunluluss3" class="col-sm-2 col-form-label"> Tahun Lulus S3 </label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="tahunluluss3" placeholder="Tahun Lulus S3" 
                                    value="{{ isset($data) ? $data->tahunluluss3 : '' }}">
                            </div>
                            </div>


                  
                   
                    <hr>
                    
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                           
                                @if (auth()->user()->hakakses == 'Admin')
                                <button type="button" onclick="window.location.href = '/AdminBeranda'"
                                class="btn btn-danger"><i class="fa fa-arrow-left"></i>Kembali</button>
                                @endif
                                @if (auth()->user()->hakakses == 'KepalaSekolah')
                                <button type="button" onclick="window.location.href = '/KepalaSekolahBeranda'"
                                class="btn btn-danger"><i class="fa fa-arrow-left"></i>Kembali</button>
                                @endif
                        
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                    </div>
                 
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Bagian Upload File dan Tampilkan Data -->
            <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                    <div class="row">
                        <div class="col-md-10 col-sm-12">
                            <h2><i class="fa fa-cloud" style="margin-right: 10px;"></i> Upload Data | <small>Kepala Sekolah</small></h2>
                        </div>
                        <div class="col-md-2 col-sm-12"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="upload-form d-flex align-items-center justify-content-center">
                    <div class="col-md-8">
                        <form action="{{ route('simpan-kep') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="dokumen" class="form-label">Choose File</label>
                                <div class="input-group">
                                    <input type="file" onchange="readdokumen(event)" class="form-control" id="dokumen" name="dokumen" value="{{ old('dokumen') }}">
                                    <div class="input-group-append">
                                        <button type="submit" id="submitBtn" class="btn btn-success">
                                            <i class="bi bi-plus-square"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                                <img id="output" style="width: 100px;" class="mt-3">
                                @error('dokumen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>
                        <div class="row"style="text-align: center;">
                            <h8 class="upload-info">*Jika Ingin Mengupload File Pengumuman Gunakan Ekstensi doc, docx, pdf, xls, xlsx</h8>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bullhorn" style="margin-right: 10px;"></i> Data | <small>Kepala Sekolah</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <!-- Tabel Data Kepala Sekolah -->
                                <table class="table table-striped table-bordered user_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center; width: 5px; font-size: 13px;">No.</th>
                                            <th scope="col" style="text-align: center; width: 50px; font-size: 13px;">File</th>
                                            <th scope="col" style="text-align: center; width: 50px; font-size: 13px;">Tanggal Upload</th>
                                            <th scope="col" style="text-align: center; width: 50px; font-size: 13px;">Action</th>
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
                            <h8 class="upload-info">*Jika Ingin Mengupload File, Download Terlebih Dulu Panduan Data Kepala Sekolah Yang Sudah Disediakan.</h8>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
      {{-- <div class="row">
        <div class="col-md-6">
            <!-- Bagian Form Input Data Kepala Sekolah -->
            <div class="dashboard_graph">
                <h3><i class="fa fa-bank"></i> Data Kepala <small>Sekolah</small></h3>
                <hr>
                <form action="{{ isset($data) ? route('kepsek.update', ['id' => $data->id]) : route('kepsek.storeOrUpdate') }}" method="post">
                    @csrf
                    <!-- Isi Formulir Input Data Kepala Sekolah -->
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Bagian Upload File dan Tampilkan Data -->
            <div class="x_panel tile fixed_height_320 overflow_hidden">
                <div class="x_title">
                    <div class="row">
                        <div class="col-md-10 col-sm-12">
                            <h2><i class="fa fa-cloud" style="margin-right: 10px;"></i> Upload Data | <small>Kepala Sekolah</small></h2>
                        </div>
                        <div class="col-md-2 col-sm-12"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="upload-form d-flex align-items-center justify-content-center">
                    <!-- Form Upload File -->
                </div>
            </div>
            <hr>
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bullhorn" style="margin-right: 10px;"></i> Data | <small>Kepala Sekolah</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <!-- Tabel Data Kepala Sekolah -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h8 class="upload-info">*Jika Ingin Mengupload File, Download Terlebih Dulu Panduan Data Kepala Sekolah Yang Sudah Disediakan.</h8>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    
      {{-- <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="dashboard_graph">
                <h3><i class="fa fa-bank"></i> Data  Kepala <small>Sekolah</small></h3>
                <hr>
                <form
                    action="{{ isset($data) ? route('kepsek.update', ['id' => $data->id]) : route('kepsek.storeOrUpdate') }}"
                    method="post">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (isset($data))
                        @method('PUT')
                    @endif
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama
                            Kepala Sekolah</label>
                        <div class="col-sm-4">
                           
                                <input type="text" class="form-control" name="nama" placeholder="Nama"
                                maxlength="40" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                              value="{{ isset($data) ? $data->nama : '' }}">
                        </div>
                        <label for="tempatlahir" class="col-sm-2 col-form-label"> Tempat Lahir </label>
                        <div class="col-sm-4">
                           
                                <input type="text" class="form-control" name="tempatlahir" placeholder="Tempat Lahir"
                                maxlength="20" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                              value="{{ isset($data) ? $data->tempatlahir : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ttl" class="col-sm-2 col-form-label">Tanggal Lahir </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="ttl" placeholder="Tanggal Lahir"
                                 value="{{ isset($data) ? $data->ttl : '' }}" required>
                        </div>
                        <label for="nomor" class="col-sm-2 col-form-label"> Nomor Telephone </label>
                        <div class="col-sm-4">
                           
                                <input type="text" class="form-control" name="nomor" placeholder="Nomor Telephone"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="13"
                                value="{{ isset($data) ? $data->nomor : '' }}"required>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label"> Email </label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                maxlength="50" value="{{ isset($data) ? $data->email : '' }}">
                        </div>
                        <label for="sd" class="col-sm-2 col-form-label"> Asal SD </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="sd" placeholder="Asal Sekolah Dasar" maxlength="50"
                                value="{{ isset($data) ? $data->sd : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahunlulussd" class="col-sm-2 col-form-label">Tahun Lulus SD</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="tahunlulussd" placeholder="Tahun Lulus SD"
                                 value="{{ isset($data) ? $data->tahunlulussd : '' }}">
                        </div>
                        <label for="smp" class="col-sm-2 col-form-label"> Asal SMP </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="smp" placeholder="Asal Sekolah Menengah Pertama" maxlength="40"
                                value="{{ isset($data) ? $data->smp : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahunlulussmp" class="col-sm-2 col-form-label">Tahun Lulus SMP </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="tahunlulussmp" placeholder="Tahun Lulus SMP"
                                 value="{{ isset($data) ? $data->tahunlulussmp : '' }}">
                        </div>
                        <label for="sma" class="col-sm-2 col-form-label"> Asal SMA </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="sma" placeholder="Asal SMA" maxlength="40"
                                value="{{ isset($data) ? $data->sma : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahunlulussma" class="col-sm-2 col-form-label">Tahun Lulus SMA</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="tahunlulussma" placeholder="Tahun Lulus Sma"
                                 value="{{ isset($data) ? $data->tahunlulussma : '' }}">
                        </div>
                        <label for="s1" class="col-sm-2 col-form-label"> Jurusan S1 </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="s1" placeholder="Jurusan S1" maxlength="40"
                                value="{{ isset($data) ? $data->s1 : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="institusis1" class="col-sm-2 col-form-label">Asal Institusi S1</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="institusis1" placeholder="Asal Institusi S1"
                                maxlength="30" value="{{ isset($data) ? $data->institusis1 : '' }}">
                        </div>
                        <label for="tahunluluss1" class="col-sm-2 col-form-label"> Tahun Lulus S1 </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="tahunluluss1" placeholder="Tahun Lulus S1" 
                                value="{{ isset($data) ? $data->tahunluluss1 : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="s2" class="col-sm-2 col-form-label">Jurusan S2</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="s2" placeholder="Jurusan S2"
                                maxlength="40" value="{{ isset($data) ? $data->s2 : '' }}">
                        </div>
                        <label for="institusis2" class="col-sm-2 col-form-label">Asal Institusi S2</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="institusis2" placeholder="Asal Institusi S2"
                                maxlength="30" value="{{ isset($data) ? $data->institusis2 : '' }}">
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="tahunluluss2" class="col-sm-2 col-form-label"> Tahun Lulus S2 </label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" name="tahunluluss2" placeholder="Tahun Lulus S2" 
                                value="{{ isset($data) ? $data->tahunluluss2 : '' }}">
                        </div>
                        <label for="s2" class="col-sm-2 col-form-label">Jurusan S3</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="s3" placeholder="Jurusan S3"
                                maxlength="40" value="{{ isset($data) ? $data->s3 : '' }}">
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="institusis3" class="col-sm-2 col-form-label">Asal Institusi S3</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="institusis3" placeholder="Asal Institusi S3"
                                    maxlength="30" value="{{ isset($data) ? $data->institusis3 : '' }}">
                            </div>
                            <label for="tahunluluss3" class="col-sm-2 col-form-label"> Tahun Lulus S3 </label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="tahunluluss3" placeholder="Tahun Lulus S3" 
                                    value="{{ isset($data) ? $data->tahunluluss3 : '' }}">
                            </div>
                            </div>


                  
                   
                    <hr>
                    
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                           
                                @if (auth()->user()->hakakses == 'Admin')
                                <button type="button" onclick="window.location.href = '/AdminBeranda'"
                                class="btn btn-danger"><i class="fa fa-arrow-left"></i>Kembali</button>
                                @endif
                                @if (auth()->user()->hakakses == 'KepalaSekolah')
                                <button type="button" onclick="window.location.href = '/KepalaSekolahBeranda'"
                                class="btn btn-danger"><i class="fa fa-arrow-left"></i>Kembali</button>
                                @endif
                        
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                    </div>
                 
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="x_panel tile fixed_height_320 overflow_hidden">

            <div class="x_title">
                <div class="row">
                    <div class="col-md-10 col-sm-12">
                        <h2>
                            <i class="fa fa-cloud" style="margin-right: 10px;"></i>
                            Upload Data | <small>Kepala Sekolah</small>
                        </h2>

                    </div>
                    <div class="col-md-2 col-sm-12"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="upload-form d-flex align-items-center justify-content-center">
                <div class="col-md-8">
                    <form action="{{ route('simpan-kep') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="dokumen" class="form-label">Choose File</label>
                            <div class="input-group">
                                <input type="file" onchange="readdokumen(event)" class="form-control" id="dokumen"
                                    name="dokumen" value="{{ old('dokumen') }}">
                                <div class="input-group-append">
                                    <button type="submit" id="submitBtn" class="btn btn-success">
                                        <i class="bi bi-plus-square"></i> Simpan
                                    </button>
                                </div>
                            </div>
                            <img id="output" style="width: 100px;" class="mt-3">
                            @error('dokumen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                    <div class="row"style="text-align: center;">
                        <h8 class="upload-info">*Jika Ingin Mengupload File Pengumuman Gunakan Ekstensi doc, docx, pdf, xls,
                            xlsx</h8>
                    </div>
                </div>
            </div>
        </div>
<hr>
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <i class="fa fa-bullhorn" style="margin-right: 10px;"></i>
                    Data | <small>Kepala Sekolah</small>
                </h2>
                <div class="clearfix"></div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <!-- ... (tabel data tetap sama) ... -->
                                <table class="table table-striped table-bordered user_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center; width: 5px; font-size: 13px;">No.
                                            </th>
                                            <th scope="col" style="text-align: center; width: 50px; font-size: 13px;">
                                                File
                                            </th>
                                            <th scope="col" style="text-align: center; width: 50px; font-size: 13px;">
                                                Tanggal
                                                Upload</th>
                                            <th scope="col" style="text-align: center; width: 50px; font-size: 13px;">
                                                Action</th>
                                            <th width="5px" style="text-align: center; font-size: 15px;">
                                                <button type="button" name="bulk_delete" id="bulk_delete"
                                                    class="btn btn-danger btn-xs">Delete</button>
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
                            <h8 class="upload-info">*Jika Ingin Mengupload File, Download Terlebih Dulu Panduan Data Kepala
                                Sekolah Yang Sudah Disediakan.</h8>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}



    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('kepsek.index') }}",
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
                        name: 'dokumen'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            // Format the date using a library like moment.js
                            return moment(data).format('DD-MM-YYYY');
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
    </script>
    <script>
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
                            url: "{{ route('kepsek.removeall') }}",
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
                                    title: "Deleted!",
                                    text: "Your data has been deleted.",
                                    icon: "success",
                                }).then(function() {
                                    // Reload the DataTable
                                    location.reload();
                                });
                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "No checkboxes selected",
                            text: "Please select at least one checkbox",
                            icon: "warning",
                        });
                    }
                }
            });
        });
    </script>


@endsection
{{-- <div class="form-group row">
    <label for="ttl" class="col-sm-2 col-form-label">Tanggal Lahir</label>
    <div class="col-sm-4">
        <input type="date" class="form-control" name="ttl" 
            placeholder="Tanggal Lahir" value="{{ isset($data) ? $data->ttl : '' }}">
    </div>
    <label for="nomor" class="col-sm-2 col-form-label">Nomor Telephone</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" name="nomor" placeholder="Nomor Telephone"
            oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="13"
            value="{{ isset($data) ? $data->nomor : '' }}"required>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-4">
        <input type="email" class="form-control" name="email" placeholder="Email"
            maxlength="30"
            value="{{ isset($data) ? $data->email : '' }}">
    </div>
    <label for="sd" class="col-sm-2 col-form-label">Kelurahan</label>
    <div class="col-sm-4">
        <input type="Kelurahan" class="form-control" name="Kelurahan" placeholder="Kelurahan"
            maxlength="30"
            value="{{ isset($data) ? $data->Kelurahan : '' }}"oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');">
    </div>
</div>

</div> --}}
{{-- @extends('index')
@section('title', 'Kesuma-GO | Data Kepala Sekolah')
@section('content')
    <style>
        .dashboard_graph {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .x_title h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .x_title i {
            font-size: 32px;
        }

        .upload-form {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
            height: 100%;
        }

        .upload-form button {
            margin-bottom: 1rem;
        }

        .card-box {
            margin-top: 20px;
        }

        .table thead th {
            font-size: 14px;
        }

        .table tbody td {
            font-size: 13px;
        }

        .table thead th,
        .table tbody td {
            text-align: center;
        }

        .delete-btn {
            background-color: #d9534f;
            border-color: #d9534f;
        }

        .delete-btn:hover {
            background-color: #c9302c;
            border-color: #ac2925;
        }

        .upload-info {
            color: red;
        }
    </style>
    <div class="col-md-12 col-sm-12">
        <div class="x_panel tile fixed_height_320 overflow_hidden">

            <div class="x_title">
                <div class="row">
                    <div class="col-md-10 col-sm-12">
                        <h2>
                            <i class="fa fa-cloud" style="margin-right: 10px;"></i>
                            Upload Data | <small>Kepala Sekolah</small>
                        </h2>

                    </div>
                    <div class="col-md-2 col-sm-12"></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="upload-form d-flex align-items-center justify-content-center">
                <div class="col-md-8">
                    <form action="{{ route('simpan-kep') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="dokumen" class="form-label">Choose File</label>
                            <div class="input-group">
                                <input type="file" onchange="readdokumen(event)" class="form-control" id="dokumen"
                                    name="dokumen" value="{{ old('dokumen') }}">
                                <div class="input-group-append">
                                    <button type="submit" id="submitBtn" class="btn btn-success">
                                        <i class="bi bi-plus-square"></i> Simpan
                                    </button>
                                </div>
                            </div>
                            <img id="output" style="width: 100px;" class="mt-3">
                            @error('dokumen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                    <div class="row"style="text-align: center;">
                        <h8 class="upload-info">*Jika Ingin Mengupload File Pengumuman Gunakan Ekstensi doc, docx, pdf, xls,
                            xlsx</h8>
                    </div>
                </div>
            </div>
        </div>
<hr>
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <i class="fa fa-bullhorn" style="margin-right: 10px;"></i>
                    Data | <small>Kepala Sekolah</small>
                </h2>
                <div class="clearfix"></div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <!-- ... (tabel data tetap sama) ... -->
                                <table class="table table-striped table-bordered user_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center; width: 5px; font-size: 13px;">No.
                                            </th>
                                            <th scope="col" style="text-align: center; width: 50px; font-size: 13px;">
                                                File
                                            </th>
                                            <th scope="col" style="text-align: center; width: 50px; font-size: 13px;">
                                                Tanggal
                                                Upload</th>
                                            <th scope="col" style="text-align: center; width: 50px; font-size: 13px;">
                                                Action</th>
                                            <th width="5px" style="text-align: center; font-size: 15px;">
                                                <button type="button" name="bulk_delete" id="bulk_delete"
                                                    class="btn btn-danger btn-xs">Delete</button>
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
                            <h8 class="upload-info">*Jika Ingin Mengupload File, Download Terlebih Dulu Panduan Data Kepala
                                Sekolah Yang Sudah Disediakan.</h8>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('kepsek.index') }}",
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
                        name: 'dokumen'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            // Format the date using a library like moment.js
                            return moment(data).format('DD-MM-YYYY');
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
    </script>
    <script>
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
                            url: "{{ route('kepsek.removeall') }}",
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
                                    title: "Deleted!",
                                    text: "Your data has been deleted.",
                                    icon: "success",
                                }).then(function() {
                                    // Reload the DataTable
                                    location.reload();
                                });
                            },
                            error: function(data) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "No checkboxes selected",
                            text: "Please select at least one checkbox",
                            icon: "warning",
                        });
                    }
                }
            });
        });
    </script>


@endsection --}}
