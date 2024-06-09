<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Edit Data <small>Mengajar</small></h3>
            <hr>
            <form method="POST" action="/organisasisiswaall-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                <label for="tahunakademik_id" class="col-sm-2 col-form-label">Tahun Akademik</label>
                <div class="col-sm-4">
                    <select class="form-control" id="tahunakademik_id" name="tahunakademik_id" required>
                        <option value="">Pilih Tahun</option>
                        @foreach($tahunakademiks as $tahunakademik)
                            <option value="{{ $tahunakademik->tahunakademik_id }}">{{ $tahunakademik->tahunakademik }} - {{ $tahunakademik->semester }}</option>
                        @endforeach
                    </select>
                
                </div>
                
                <label for="organisasi_id" class="col-sm-2 col-form-label">Organisasi</label>
                <div class="col-sm-4">
                    <select class="form-control" id="organisasi_id" name="organisasi_id" required>
                        <option value="">Pilih Organisasi</option>
                        @foreach($organisasis as $organisasi)
                            <option value="{{ $organisasi->organisasi_id }}">{{ $organisasi->organisasi_id }} - {{ $organisasi->nama }}</option>
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
                       =
                            @if (auth()->user()->hakakses == 'Admin')
                            <button type="button" onclick="window.location.href = '/organisasisiswaall'"
                            class="btn btn-danger">Kembali</button>
                            @endif
                            @if (auth()->user()->hakakses == 'KepalaSekolah')
                            <button type="button" onclick="window.location.href = '/organisasisiswaall'"
                            class="btn btn-danger">Kembali</button>
                            @endif
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
