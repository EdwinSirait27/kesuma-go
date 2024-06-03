<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-bell" style="margin-right: 10px; margin-top: 15px;"></i>Edit <small>Jurusan</small></h3>
            <hr>
            <form method="POST" action="/jurusan-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">        
                    <label for="txt_namajurusan" class="col-sm-2 col-form-label">Nama jurusan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txt_namajurusan"
                            name="txt_namajurusan" placeholder="Nama jurusan"maxlength="30"required>
                            <h8 style="color: red;">*Contoh Input : Ipa Teknik</h8>
                    
                </div>
            
                    <label for="txt_status" class="col-sm-2 col-form-label label-input">Status Aktif</label>
                    <div class="col-sm-4">
                        <select class="form-control form-control select-field" id="txt_status"
                            name="txt_status">
                            <option value="" selected disabled>Pilih Status </option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>        
                </div>
                </div>
                <div class="form-group row">  
                    <label for="txt_keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-4">
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
