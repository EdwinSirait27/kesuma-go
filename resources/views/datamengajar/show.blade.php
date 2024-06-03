@extends('index')

@section('title', 'Kesuma-GO | Edit Data Mengajar')

@section('content')
<style>
    .dashboard_graph {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .dashboard_graph h3 {
        color: #333;
    }

    .form-group label {
        color: #555;
        font-weight: bold;
    }

    .form-control {
        border-radius: 4px;
        border: 1px solid #ccc;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    span.note {
        color: red;
        font-size: 0.875rem;
        font-style: italic;
    }
</style>

<div class="col-md-12 col-sm-12">
    <div class="dashboard_graph">
        <h3>
            <i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>
            Edit Data <small>Mengajar</small>
        </h3>
        <hr>
        <form method="POST" action="/datamengajar-update" onsubmit="return simpan()">
            @csrf
            <input type="hidden" name="txt_id" id="txt_id" />

            <div class="form-group row">
                <label for="matpel_id" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                <div class="col-sm-4">
                    <select class="form-control" id="matpel_id" name="matpel_id" value="{{ $datamengajar->matpel->MataPelajaran }}"required>
                        @foreach($matpels as $mata)
                            <option value="{{ $mata->matpel_id }}">{{ $mata->MataPelajaran }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="guru_id" class="col-sm-2 col-form-label">Nama Guru</label>
                <div class="col-sm-4">
                    <select class="form-control" id="guru_id" name="guru_id" value="{{ $datamengajar->guru->Nama }}"required>
                        @foreach($gurus as $guru)
                            <option value="{{ $guru->guru_id }}">{{ $guru->Nama }}</option>
                        @endforeach
                    </select>
                    <span class="note">
                        Note: Jikalau mengupdate Guru, Guru yang sudah terdaftar di jadwal yang dirubah segera dihapus (abaikan pesan ini jikalau menginput data baru)
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <label for="hari" class="col-sm-2 col-form-label label-input">Hari</label>
                <div class="col-sm-4">
                    <select class="form-control select-field" id="hari" name="hari" value="{{ $datamengajar->hari }}"required>
                       <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </select>
                </div>

                <label for="time_start" class="col-sm-2 col-form-label label-input">Awal Waktu Pelajaran</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="time_start" name="time_start" value="{{ $datamengajar->time_start }}"required>
                </div>
            </div>

            <div class="form-group row">
                <label for="time_end" class="col-sm-2 col-form-label label-input">Akhir Waktu Pelajaran</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="time_end" name="time_end" value="{{ $datamengajar->time_end }}"required>
                </div>

                <label for="time_start1" class="col-sm-2 col-form-label label-input">Awal Waktu Istirahat</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="time_start1" name="time_start1" value="{{ $datamengajar->time_start1 }}"required>
                </div>
            </div>

            <div class="form-group row">
                <label for="time_end1" class="col-sm-2 col-form-label label-input">Akhir Waktu Istirahat</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="time_end1" name="time_end1" value="{{ $datamengajar->time_end1 }}"required>
                </div>

                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ $datamengajar->keterangan }}"required>
                </div>
            </div>

            <div class="form-group row">
                <label for="kelas_id" class="col-sm-2 col-form-label">Pilih Kelas</label>
                <div class="col-sm-4">
                    <select class="form-control" id="kelas_id" value="{{ $datamengajar->kelas_id }}"name="kelas_id">
                        @foreach($kelass as $kelas)
                            <option value="{{ $kelas->kelas_id }}">{{ $kelas->kelas->namakelas }}</option>
                        @endforeach
                    </select>
                    <span class="note">
                        Note: Jikalau mengupdate kelas, matapelajaran yang sudah terdaftar di jadwal yang dirubah segera dihapus (abaikan pesan ini jikalau menginput data baru)
                    </span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    @if (auth()->user()->hakakses == 'Admin' || auth()->user()->hakakses == 'KepalaSekolah')
                        <button type="button" onclick="window.location.href = '/datamengajar'" class="btn btn-danger">Kembali</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


{{-- @extends('index')
@section('title', 'Kesuma-GO | Edit Data Mengajar')
@section('content')
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Edit Data <small>Mengajar</small></h3>
            <hr>
            <form method="POST" action="/datamengajar-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                <label for="matpel_id" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                <div class="col-sm-4">
                    <select class="form-control" id="matpel_id" name="matpel_id" required>
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach($matpels as $mata)
                            <option value="{{ $mata->matpel_id }}">{{ $mata->matpel_id }} - {{ $mata->MataPelajaran }}</option>
                        @endforeach
                    </select>
                
                </div>
                
                    <label for="guru_id" class="col-sm-2 col-form-label">Nama Guru</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="guru_id" name="guru_id" required>
                            <option value="">Pilih Guru</option>
                            @foreach($gurus as $guru)
                                <option value="{{ $guru->guru_id }}">{{ $guru->guru_id }} - {{ $guru->Nama }}</option>
                            @endforeach
                        </select>
                        <span style="color: red;">Note : Jikalau mengupdate Guru , Guru yang sudah terdaftar di jadwal yang dirubah segera dihapus (abaikan pesan ini jikalau menginput data baru)</span>

                    </div>
                    </div>

                    <div class="form-group row">
                        <label for="hari" class="col-sm-2 col-form-label label-input">Hari</label>
                        <div class="col-sm-4">
                            <select class="form-control select-field" id="hari" name="hari" required>
                                <option value="" selected disabled>Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                        </div>
                        
                     
                            <label for="time_start" class="col-sm-2 col-form-label label-input">Awal Waktu Pelajaran</label>
                            <div class="col-sm-4">
                                <input type="time" class="form-control" id="time_start" name="time_start" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="time_end" class="col-sm-2 col-form-label label-input">Akhir Waktu Pelajaran</label>
                            <div class="col-sm-4">
                                <input type="time" class="form-control" id="time_end" name="time_end" required>
                          
                        </div>
                        
                        <label for="time_start" class="col-sm-2 col-form-label label-input">Awal Waktu Istirahat</label>
                        <div class="col-sm-4">
                            <input type="time" class="form-control" id="time_start1" name="time_start1" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="time_end" class="col-sm-2 col-form-label label-input">Akhir Waktu Istirahat</label>
                        <div class="col-sm-4">
                            <input type="time" class="form-control" id="time_end1" name="time_end1" required>
                      
                  
               
                    </div>
                       
                  
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="keterangan"
                                name="keterangan" placeholder="Keterangan" required>
                        
                    </div>
                    </div>

                    <div class="form-group row">
                        <label for="kelas_id" class="col-sm-2 col-form-label">Pilih Kelas</label>
                        <div class="col-sm-4">
                    <select class="form-control" id="kelas_id" name="kelas_id" >
                        <option value="">Pilih Kelas</option>
                        @foreach($kelass as $kelas)
                            <option value="{{ $kelas->kelas_id }}">{{ $kelas->kelas_id }} - {{ $kelas->kelas->namakelas }}</option>
                            @endforeach
                        </select>
                        <span style="color: red;">Note : Jikalau mengupdate kelas, matapelajaran yang sudah terdaftar di jadwal yang dirubah segera dihapus (abaikan pesan ini jikalau menginput data baru)</span>

                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      
                            @if (auth()->user()->hakakses == 'Admin')
                            <button type="button" onclick="window.location.href = '/datamengajar'"
                            class="btn btn-danger">Kembali</button>
                            @endif
                            @if (auth()->user()->hakakses == 'KepalaSekolah')
                            <button type="button" onclick="window.location.href = '/datamengajar'"
                            class="btn btn-danger">Kembali</button>
                            @endif
                        
                    </div>
                </div>
            </form>
        </div>
</div> --}}
