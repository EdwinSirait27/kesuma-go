<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Edit Data <small>Calon Ketua</small></h3>
            <hr>
            <form method="POST" action="/osis-update" enctype="multipart/form-data" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                <label for="siswa_id" class="col-sm-2 col-form-label">Nama Siswa</label>
                <div class="col-sm-4">
                  <select class="form-control" id="siswa_id" name="siswa_id[]" required>
    <option value="">Pilih Siswa</option>
    @foreach($siswas as $siswa)
        <option value="{{ $siswa->siswa_id }}">{{ $siswa->siswa_id }} - {{ $siswa->NamaLengkap }}</option>
    @endforeach
</select>

                    
                
                </div>
                <label for="foto" class="col-sm-2 col-form-label">Foto Siswa</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control" id="foto" name="foto" >
                </div>
            </div>
          
             <div class="form-group row">
                        <label for="visi" class="col-sm-2 col-form-label">Visi</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="visi"
                                name="visi" placeholder="Visi" required>
                        
                    </div>
                        <label for="misi" class="col-sm-2 col-form-label">Misi</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="misi"
                                name="misi" placeholder="Misi" required>
                        
                    </div>
                    </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      
                            @if (auth()->user()->hakakses == 'Admin')
                            <button type="button" onclick="window.location.href = '/datamengajar'"
                            class="btn btn-danger">Kembali</button>
                            @endif
                            @if (auth()->user()->hakakses == 'KepalaSekolah')
                            <button type="button" onclick="window.location.href = '/datamengajar'"
                            class="btn btn-danger">Kembali</button>
                            @endif
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const fotoInput = document.getElementById('foto-input');
    const fotoLabel = document.getElementById('foto-label');

    fotoLabel.addEventListener('click', function() {
        fotoInput.click();
    });

    fotoInput.addEventListener('change', function() {
        if (fotoInput.files.length > 0) {
            const file = fotoInput.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                fotoLabel.innerHTML =
                    `<img src="${e.target.result}" alt="Foto Biodata" style="max-width: 200px; max-height: 200px;">`;
            };
            reader.readAsDataURL(file);
        } else {
            fotoLabel.innerHTML = 'Choose File';
        }
    });
</script>