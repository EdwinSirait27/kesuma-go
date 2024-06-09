<style>
  #info_txt_namakelas {
            color: red !important; /* Gunakan !important jika perlu mengatasi aturan lain */
        }
    
</style>
<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-cubes" style="margin-right: 4px; margin-top: 15px;"></i>Edit <small>Kelas</small></h3>
            <hr>
            <form method="POST" action="/kelas-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="txt_namakelas" class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txt_namakelas" name="txt_namakelas"
                            placeholder="Nama kelas" maxlength="3" required>
                            <small id="info_txt_namakelas" class="form-text text-muted">*Contoh: 10A</small>

                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var txtNamaKelas = document.getElementById('txt_namakelas');
                            txtNamaKelas.addEventListener('input', function() {
                                this.value = this.value.replace(/[^A-Z0-9]/g, '');
                            });
                        });
                    </script>


                    <label for="txt_kapasitas" class="col-sm-2 col-form-label">Kapasitas Max</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txt_kapasitas" name="txt_kapasitas"
                            placeholder="Kapasitas" oninput="this.value = this.value.replace(/[^0-9]/g, '');"maxlength="2"required>


                    </div>
                </div>

                <div class="form-group row">
                    <label for="txt_keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txt_keterangan" name="txt_keterangan"
                            placeholder="Keterangan"maxlength="30"required>


                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                       
                       
                        <button type="button" onclick="window.location.href = '/kelas'"
                        class="btn btn-danger">Kembali</button>
                        

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
