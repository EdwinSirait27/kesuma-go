<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h1><i class="fa fa-futbol-o" style="margin-right: 10px;"></i>Edit Status Pegawai</h1>
            <hr>
            <hr>
            <form method="POST" action="/statuspegawai-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">        
                    <label for="txt_statuspegawai" class="col-sm-2 col-form-label">Status Pegawai</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txt_statuspegawai"
                            name="txt_statuspegawai" placeholder="Status Pegawai"  maxlength="10"required>
                         
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txt_keterangan"
                            name="txt_keterangan" placeholder="Keterangan">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" onclick="iForm('hal_index')" class="btn btn-danger">Batal</button>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
