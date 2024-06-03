<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <style>
                .col-form-label {
                    font-size: 18px;
                    /* Ganti dengan ukuran font yang Anda inginkan */
                }
            </style>
            <h2><i class="fa fa-users" style="margin-right: 10px; "></i>Edit Data<small>Ekstrakulikuler</small></h2>
            <hr>
            <form method="POST" action="/ekstra-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />

                <div class="form-group row">
                    <label for="ekstrakulikuler" class="col-sm-2 col-form-label">Ekstrakulikuler</label>
                    <div class="col-sm-4">

                        <input type="text" class="form-control" id="namaekskul" name="namaekskul"
                            placeholder="Nama Ekstrakulikuler" maxlength="30" required
                            oninput="validateInput(this)"required>
                    </div>
                    <script>
                        function validateInput(inputElement) {
                            // Hanya izinkan huruf (A-Z, a-z) dan spasi
                            inputElement.value = inputElement.value.replace(/[^A-Za-z\s]/g, '');
                        }
                    </script>


                    <label for="kapasitas" class="col-sm-2 col-form-label">Kapasitas</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="kapasitas" name="kapasitas"
                            placeholder="Kapasitas"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="2" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label label-input">Status Aktif</label>
                    <div class="col-sm-4">
                        <select class="form-control form-control select-field" id="status" name="status"required>
                            <option value="" selected disabled>Pilih Status </option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>

                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="Keterangan" maxlength="30"required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                       
                       
                        <button type="button" onclick="window.location.href = '/ekstra'"
                        class="btn btn-danger">Kembali</button>
                      
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
