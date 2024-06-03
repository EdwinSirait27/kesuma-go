

@extends('index')
@section('title', 'Kesuma-GO | Identitas Sekolah')
@section('content')
    <style>
        .col-form-label {
            font-size: 18px;
        }
    </style>
        @if (auth()->user()->hakakses == 'Admin'||auth()->user()->hakakses == 'KepalaSekolah')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="dashboard_graph">
                <h3><i class="fa fa-bank"></i> Identitas <small>Sekolah</small></h3>
                <hr>
                <form
                    action="{{ isset($data) ? route('identitas.update', ['id' => $data->id]) : route('identitas.storeOrUpdate') }}"
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
                        <label for="Nama_Sekolah" class="col-sm-2 col-form-label"><i class="fa fa-university"></i> Nama
                            Sekolah</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="Nama_Sekolah" placeholder="Nama Sekolah"
                                maxlength="60" value="{{ isset($data) ? $data->Nama_Sekolah : '' }}">
                        </div>
                        <label for="NPSN" class="col-sm-2 col-form-label"><i class="fa fa-id-card"></i> NPSN</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="NPSN" placeholder="NPSN" maxlength="8"
                                value="{{ isset($data) ? $data->NPSN : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Alamat_Sekolah" class="col-sm-2 col-form-label">Alamat Sekolah</label>
                        <div class="col-sm-4">
                            <input type="Alamat_Sekolah" class="form-control" name="Alamat_Sekolah" maxlength="40"
                                placeholder="Alamat Sekolah" value="{{ isset($data) ? $data->Alamat_Sekolah : '' }}">
                        </div>
                        <label for="Kode_Pos" class="col-sm-2 col-form-label">Kode Pos</label>
                        <div class="col-sm-4">
                            <input type="Kode_Pos" class="form-control" name="Kode_Pos" placeholder="Kode Pos"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="5"
                                value="{{ isset($data) ? $data->Kode_Pos : '' }}"required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Nomor_Telephone" class="col-sm-2 col-form-label">Nomor Telephone</label>
                        <div class="col-sm-4">
                            <input type="Nomor_Telephone" class="form-control" name="Nomor_Telephone" maxlength="13"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="Nomor Telephone"
                                value="{{ isset($data) ? $data->Nomor_Telephone : '' }}">
                        </div>
                        <label for="Kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
                        <div class="col-sm-4">
                            <input type="Kelurahan" class="form-control" name="Kelurahan" placeholder="Kelurahan"
                                maxlength="30"
                                value="{{ isset($data) ? $data->Kelurahan : '' }}"oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-sm-4">
                            <input type="Kecamatan" class="form-control" name="Kecamatan" placeholder="Kecamatan"
                                maxlength="30"
                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"value="{{ isset($data) ? $data->Kecamatan : '' }}">
                        </div>
                        <label for="Kabupaten_Kota" class="col-sm-2 col-form-label">Kabupaten Kota</label>
                        <div class="col-sm-4">
                            <input type="Kabupaten_Kota" class="form-control" name="Kabupaten_Kota" maxlength="15"
                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');" placeholder="Kabupaten Kota"
                                value="{{ isset($data) ? $data->Kabupaten_Kota : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                        <div class="col-sm-4">
                            <input type="Provinsi" class="form-control" name="Provinsi" placeholder="Provinsi"
                                maxlength="20" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                              value="{{ isset($data) ? $data->Provinsi : '' }}">
                        </div>
                        <label for="Website" class="col-sm-2 col-form-label">Website</label>
                        <div class="col-sm-4">
                            <input type="Website" class="form-control" name="Website" placeholder="Website"
                                maxlength="50" value="{{ isset($data) ? $data->Website : '' }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-4">
                            <input type="Email" class="form-control" name="Email" placeholder="Email"
                                maxlength="50"value="{{ isset($data) ? $data->Email : '' }}">
                        </div>
                        <label for="akreditasi" class="col-sm-2 col-form-label">Akreditasi</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="akreditasi" placeholder="Akreditasi"
                                maxlength="1" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                value="{{ isset($data) ? $data->akreditasi : '' }}">
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-6">
                        <!-- Button to visit website -->
                        <a href="https://www.smak-kesuma.sch.id/" class="btn btn-success" target="_blank"><i class="fa fa-globe"></i> Kunjungi Website</a>
                    </div>
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
    @endif


   
    @if (auth()->user()->hakakses == 'Siswa'||auth()->user()->hakakses == 'Guru'||auth()->user()->hakakses == 'Kurikulum')
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="dashboard_graph">
                <h3><i class="fa fa-bank"></i> Identitas <small>Sekolah</small></h3>
                <hr>
               
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="form-group row">
                        <label for="Nama_Sekolah" class="col-sm-2 col-form-label"><i class="fa fa-university"></i> Nama
                            Sekolah</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="Nama_Sekolah" placeholder="Nama Sekolah"
                                maxlength="60" value="{{ isset($data) ? $data->Nama_Sekolah : '' }}"disabled>
                        </div>
                        <label for="NPSN" class="col-sm-2 col-form-label"><i class="fa fa-id-card"></i> NPSN</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="NPSN" placeholder="NPSN" maxlength="8"
                                value="{{ isset($data) ? $data->NPSN : '' }}"disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Alamat_Sekolah" class="col-sm-2 col-form-label">Alamat Sekolah</label>
                        <div class="col-sm-4">
                            <input type="Alamat_Sekolah" class="form-control" name="Alamat_Sekolah" maxlength="40"
                                placeholder="Alamat Sekolah" value="{{ isset($data) ? $data->Alamat_Sekolah : '' }}"disabled>
                        </div>
                        <label for="Kode_Pos" class="col-sm-2 col-form-label">Kode Pos</label>
                        <div class="col-sm-4">
                            <input type="Kode_Pos" class="form-control" name="Kode_Pos" placeholder="Kode Pos"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="5"
                                value="{{ isset($data) ? $data->Kode_Pos : '' }}"disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Nomor_Telephone" class="col-sm-2 col-form-label">Nomor Telephone</label>
                        <div class="col-sm-4">
                            <input type="Nomor_Telephone" class="form-control" name="Nomor_Telephone" maxlength="13"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="Nomor Telephone"
                                value="{{ isset($data) ? $data->Nomor_Telephone : '' }}"disabled>
                        </div>
                        <label for="Kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
                        <div class="col-sm-4">
                            <input type="Kelurahan" class="form-control" name="Kelurahan" placeholder="Kelurahan"
                                maxlength="30"
                                value="{{ isset($data) ? $data->Kelurahan : '' }}"oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-sm-4">
                            <input type="Kecamatan" class="form-control" name="Kecamatan" placeholder="Kecamatan"
                                maxlength="30"
                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"value="{{ isset($data) ? $data->Kecamatan : '' }}"disabled>
                        </div>
                        <label for="Kabupaten_Kota" class="col-sm-2 col-form-label">Kabupaten Kota</label>
                        <div class="col-sm-4">
                            <input type="Kabupaten_Kota" class="form-control" name="Kabupaten_Kota" maxlength="15"
                                oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');" placeholder="Kabupaten Kota"
                                value="{{ isset($data) ? $data->Kabupaten_Kota : '' }}"disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                        <div class="col-sm-4">
                            <input type="Provinsi" class="form-control" name="Provinsi" placeholder="Provinsi"
                                maxlength="20" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                              value="{{ isset($data) ? $data->Provinsi : '' }}"disabled>
                        </div>
                        <label for="Website" class="col-sm-2 col-form-label">Website</label>
                        <div class="col-sm-4">
                            <input type="Website" class="form-control" name="Website" placeholder="Website"
                                maxlength="50" value="{{ isset($data) ? $data->Website : '' }}"disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-4">
                            <input type="Email" class="form-control" name="Email" placeholder="Email"
                                maxlength="50"value="{{ isset($data) ? $data->Email : '' }}"disabled>
                        </div>
                        <label for="akreditasi" class="col-sm-2 col-form-label">Akreditasi</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="akreditasi" placeholder="Akreditasi"
                                maxlength="1" oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '');"
                                value="{{ isset($data) ? $data->akreditasi : '' }}"disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-6">
                        <!-- Button to visit website -->
                        <a href="https://www.smak-kesuma.sch.id/" class="btn btn-success" target="_blank"><i class="fa fa-globe"></i> Kunjungi Website</a>
                    </div>
                 
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                           
                            <a href="javascript:history.back();" class="btn btn-danger"><i class="fa fa-arrow-left"></i>
                                Kembali</a>
                            </div>
                    </div>
                    
            </div>
        </div>
    </div>
    @endif
@endsection


