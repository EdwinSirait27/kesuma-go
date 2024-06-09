<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-calculator" style="margin-right: 10px; margin-top: 15px;"></i>Edit Tugas
                <small>Guru</small></h3>
            <hr>
            <form method="POST" action="/pengumpulantugas-update" enctype="multipart/form-data" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="tugas_id" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="tugas_id" name="tugas_id" required>
                            <option value="">Pilih </option>
                            @foreach($tugas as $data)
                                <option value="{{ $data->tugas_id }}">{{ $data->datakelasdatamengajar->datamengajar->matpel->MataPelajaran}} - {{ $data->dokumen}} - {{ $data->keterangan}}</option>
                            @endforeach
                        </select>
               
                </div>
                
              
               
                    <label for="dokumen" class="col-sm-2 col-form-label">File Tugas</label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control-file"  accept=".pdf,.doc,.docx" id="dokumen" name="dokumen">
                    </div>
                    </div>
                
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" onclick="window.location.href = '/pengumpulantugas'"
                        class="btn btn-danger">Kembali</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
