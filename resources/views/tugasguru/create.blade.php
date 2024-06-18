<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h2><i class="fa fa-futbol-o" style="margin-right: 10px;"></i>Edit Pemberian Tugas</h2>
            <hr>
            <form method="POST" action="/tugasguru-update" enctype="multipart/form-data" onsubmit="return simpan()">
                @csrf
                <div class="alert alert-dark">
                    <ul>
                        Keterangan
                       <li> Jika guru menginput tugas kepada siswa, jika ingin diganti waktu dan tanggal, silahkan upload ulang dokumen file tugasnya</li>
                        
                    </ul>
                </div>
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="datakelas_datamengajar_id" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="datakelas_datamengajar_id" name="datakelas_datamengajar_id" required>
                            <option value="">Pilih </option>
                            @foreach($datakelasdatamengajars as $data)
                                <option value="{{ $data->datakelas_datamengajar_id }}">{{ $data->datamengajar->matpel->MataPelajaran}} Kelas : {{ $data->datakelas->kelas->namakelas}} </option>
                            @endforeach
                        </select>
               
                </div>
                
              
               
                    <label for="dokumen" class="col-sm-2 col-form-label">File Tugas</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control-file"  accept=".pdf,.doc,.docx" id="dokumen" name="dokumen">
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="tipe" class="col-sm-2 col-form-label">Tipe</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="tipe" name="tipe" required>
                            <option value="" selected disabled>Pilih Tipe</option>
                            <option value="Tugas">Tugas</option>
                            <option value="Materi">Materi</option>
                        </select>
               
                </div>
                
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="Keterangan"maxlength="30"required>
           
             
                
                </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Batas Awal Pengumpulan</label>
                    <div class="col-sm-4">
                        <input  class="date-picker form-control" name="created_at" id="created_at"
                            placeholder="Batas Awal Pengumpulan" required="required"
                            onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'"
                            onblur="this.type='text'" onmouseout="timeFunctionLong(this)"required>

                    </div>
                    
                    <label class="col-sm-2 col-form-label">Batas Akhir Pengumpulan</label>
                    <div class="col-sm-4">
                        <input  class="date-picker form-control" name="updated_at" id="updated_at"
                            placeholder="Batas Awal Pengumpulan" required="required"
                            onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'"
                            onblur="this.type='text'" onmouseout="timeFunctionLong(this)"required>

                    </div>
                    </div>

              
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" onclick="window.location.href = '/tugasguru'"
                        class="btn btn-danger">Kembali</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
