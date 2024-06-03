<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Edit <small>PTK</small></h3>
            <hr>
            <form method="POST" action="/ptk-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="txt_namaptk" class="col-sm-2 col-form-label">Nama PTK</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txt_namaptk"
                            name="txt_namaptk" placeholder="Nama PTK" required>
                    
                </div>
                
                    <label for="txt_keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txt_keterangan"
                            name="txt_keterangan" placeholder="Keterangan" required>
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
