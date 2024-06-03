<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Edit Data <small>Mengajar</small></h3>
            <hr>
            <form method="POST" action="/ekstrakulikuler-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                <label for="tahunakademik_id" class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-4">
                    <select class="form-control" id="tahunakademik_id" name="tahunakademik_id" required>
                        <option value="">Pilih Tahun </option>
                        @foreach($tahunakademik as $tahun)
                            <option value="{{ $tahun->tahunakademik_id }}">{{ $tahun->tahunakademik }} - {{ $tahun->semester }}</option>
                        @endforeach
                    </select>
                
                </div>
             
                <label for="ekskul_id" class="col-sm-2 col-form-label">ekstrakulikuler</label>
                <div class="col-sm-4">
                    <select class="form-control" id="ekskul_id" name="ekskul_id" required>
                        <option value="">Pilih Ekstrakulikuler</option>
                        @foreach($ekskuls as $ekstra)
                            <option value="{{ $ekstra->ekskul_id }}">{{ $ekstra->ekskul_id }} - {{ $ekstra->namaekskul }}</option>
                        @endforeach
                    </select>
                
                    
                </div>
                </div>
                <div class="form-group row">
                    <label for="guru_id" class="col-sm-2 col-form-label">Guru Pembina</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="guru_id" name="guru_id" required>
                            <option value="">Pilih Guru </option>
                            @foreach($gurus as $guru)
                                <option value="{{ $guru->guru_id }}">{{ $guru->guru_id }} - {{ $guru->Nama }}</option>
                            @endforeach
                        </select>
                   
                    </div>
                    
                   
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="keterangan"
                                name="keterangan" placeholder="Keterangan" required>
                        
                    </div>
                    </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" onclick="window.location.href = '/ekstrakulikuler'"
                                            class="btn btn-danger">Kembali</button>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
