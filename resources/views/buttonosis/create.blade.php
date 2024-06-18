<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h2><i class="fa fa-futbol-o" style="margin-right: 10px;"></i>Edit Button Osis</h2>
            <hr>
            
            <form method="POST" action="/buttonosis-update3" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                
           
                
                <div class="form-group row">        
                    <label for="text" class="col-sm-2 col-form-label">Url</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="url"
                            name="url" placeholder="Url"  maxlength="30"disabled>
                         
                
                </div>
          
                    <label for="start_date" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                    <div class="col-sm-4">
                        <input type="datetime-local" class="form-control" id="start_date"
                            name="start_date" placeholder="Tanggal Mulai">
                    
                </div>
                </div>
                <div class="form-group row">        
               
                    <label for="end_date" class="col-sm-2 col-form-label">Tanggal Berakhir</label>
                    <div class="col-sm-4">
                        <input type="datetime-local" class="form-control" id="end_date"
                            name="end_date" placeholder="Tanggal Berakhir">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-SM-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                       
                                        
                                            <button type="button" onclick="window.location.href = '/buttonppdb'"
                                            class="btn btn-danger">Kembali</button>
                                           
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
