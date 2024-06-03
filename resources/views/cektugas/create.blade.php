<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-calculator" style="margin-right: 10px; margin-top: 15px;"></i>Edit Tugas
                <small>Guru</small></h3>
            <hr>
            <form method="POST" action="/cektugas-update" enctype="multipart/form-data" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label label-input">Status</label>
                    <div class="col-sm-4">
                        <select class="form-control select-field" id="status" name="status" required>
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="Belum Diperiksa">Belum Diperiksa</option>
                            <option value="Sudah Diperiksa">Sudah Diperiksa</option>
                            
                        </select>
                    </div>
                </div>
                
              
                
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" onclick="window.location.href = '/cektugas'"
                        class="btn btn-danger">Kembali</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
