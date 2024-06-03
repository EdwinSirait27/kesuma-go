<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-calculator" style="margin-right: 10px; margin-top: 15px;"></i>Edit Tahun
                <small>Akademik</small></h3>
            <hr>
            <form method="POST" action="/tahunakademik-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="kodetahunakademik" class="col-sm-2 col-form-label">Tahun Akademik</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="tahunakademik"
                            maxlength="4"oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="tahunakademik"
                            placeholder="Tahun Akademik">
                        <h8 style="color: red;">*Contoh Input : 2023</h8>
                    </div>
                <label for="kurikulum_id" class="col-sm-2 col-form-label">Kurikulum</label>
                <div class="col-sm-4">
                    <select class="form-control" id="kurikulum_id" name="kurikulum_id" required>
                        <option value="">Pilih Kurikulum</option>
                        @foreach($kurs as $kurikulum)
                            <option value="{{ $kurikulum->kurikulum_id }}">{{ $kurikulum->kurikulum_id }} - {{ $kurikulum->Nama_Kurikulum }}</option>
                        @endforeach
                    </select>
                </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Awal Penetapan</label>
                    <div class="col-sm-4">
                        <input id="tahun1" class="date-picker form-control" name="tahun1"
                            placeholder="Tanggal Awal Penetapan" type="tahun1" required="required" type="tahun1"
                            onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'"
                            onblur="this.type='text'" onmouseout="timeFunctionLong(this)"required>

                    </div>

                    <label class="col-sm-2 col-form-label">Tanggal Berkahir</label>
                    <div class="col-sm-4">
                        <input id="tahun2" class="date-picker form-control" name="tahun2"
                            placeholder="Tanggal Awal Penetapan" type="tahun1" required="required" type="tahun2"
                            onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'"
                            onblur="this.type='text'" onmouseout="timeFunctionLong(this)"required>

                    </div>
                </div>
                <div class="form-group row">
                    <label for="semester" class="col-sm-2 col-form-label label-input">Semester</label>
                    <div class="col-sm-4">
                        <select class="form-control form-control select-field" id="semester" name="semester"required>
                            <option value="" selected disabled>Pilih Semester</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>

                    </div>
                    {{-- <label for="statusaktif" class="col-sm-2 col-form-label label-input">Status Aktif</label>
                    <div class="col-sm-4">
                        <select class="form-control form-control select-field" id="statusaktif"
                            name="statusaktif">
                            <option value="" NUll>Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div> --}}
               
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="Keterangan"maxlength="30"required>
           
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" onclick="window.location.href = '/tahunakademik'"
                        class="btn btn-danger">Kembali</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
