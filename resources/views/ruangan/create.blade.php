<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-graduation-cap" style="margin-right: 10px; margin-top: 15px;"></i>Edit
                <small>Ruangan</small></h3>
            <hr>
            <form method="POST" action="/ruangan-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="txt_namaruangan" class="col-sm-2 col-form-label">Nama Ruangan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txt_namaruangan" name="txt_namaruangan"
                            placeholder="Nama Ruangan">
                        <h8 style="color: red;">*Contoh Input : Musik dll</h8>

                    </div>

                    <label for="txt_kapasitasbelajar" class="col-sm-2 col-form-label">Kapasitas Ruangan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txt_kapasitasruangan"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                            maxlength="4"name="txt_kapasitasruangan" placeholder="Kapasitas Ruangan">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txt_statusaktif" class="col-sm-2 col-form-label label-input">Status Aktif</label>
                    <div class="col-sm-4">
                        <select class="form-control form-control select-field" id="txt_statusaktif"
                            name="txt_statusaktif"required>
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    
                </div>
                
                <label for="txt_keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="txt_keterangan" name="txt_keterangan"
                        placeholder="Keterangan">

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
