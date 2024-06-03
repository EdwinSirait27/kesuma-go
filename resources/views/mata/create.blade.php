<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Edit <small>Mata Pelajaran</small></h3>
            <hr>
            <form method="POST" action="/mata-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="MataPelajaran" class="col-sm-2 col-form-label">Nama Mata Pelajaran</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="MataPelajaran" name="MataPelajaran"
                            placeholder="Nama Mata Pelajaran" maxlength="50" required oninput="validateInput(this)"required>
                   
                </div>
                
                <script>
                function validateInput(inputElement) {
                    // Hanya izinkan huruf (A-Z, a-z) dan spasi
                    inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                }
                </script>
                
                
               
                    <label for="status" class="col-sm-2 col-form-label label-input">Status Aktif</label>
                    <div class="col-sm-4">
                        <select class="form-control form-control select-field" id="status"
                            name="status"required>
                            <option value="" selected disabled>Pilih Status </option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                </div>
                </div>
                <div class="form-group row">   
                <label for="status" class="col-sm-2 col-form-label label-input">Status Aktif</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="KKM"  id="KKM" placeholder="KKM"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="3"
                        required>
                </div>








                                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="keterangan"
                            name="keterangan" placeholder="Keterangan" maxlength="30"required>
                </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" onclick="window.location.href = '/mata'"
                        class="btn btn-danger">Kembali</button>
                        
                
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
