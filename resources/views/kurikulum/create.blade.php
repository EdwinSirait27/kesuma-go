<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-calculator" style="margin-right: 10px; margin-top: 15px;"></i>Data Kurikulum <small>Sekolah</small></h3>
            <hr>
            <form method="POST" action="/kurikulum-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="Nama_Kurikulum" class="col-sm-2 col-form-label">Nama Kurikulum</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="Nama_Kurikulum" name="Nama_Kurikulum"
                            placeholder="Nama Kurikulum" maxlength="30" oninput="this.value = this.value.replace(/[^A-Za-z0-9\s]/g, '');"required>
                    
                </div>
                
                    <label for="Status_Aktif" class="col-sm-2 col-form-label">Status Aktif</label>
                    <div class="col-sm-4">
                        <select class="form-control form-control select-field" id="Status_Aktif"
                            name="Status_Aktif"required>
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="Keterangan" maxlength="30" required>
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" onclick="window.location.href = '/kurikulum'"
                        class="btn btn-danger">Kembali</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
