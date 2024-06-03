<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <style>
                .col-form-label {
                    font-size: 18px; /* Ganti dengan ukuran font yang Anda inginkan */
                }

                .dashboard_graph h2 {
                    font-size: 24px;
                    color: #333;
                    margin-bottom: 15px;
                }

                .dashboard_graph hr {
                    border-color: #ddd;
                    margin-top: 5px;
                    margin-bottom: 20px;
                }

                .btn-primary,
                .btn-danger {
                    margin-right: 10px;
                }

                .btn-danger {
                    background-color: #d9534f;
                    border-color: #d9534f;
                }

                .btn-danger:hover {
                    background-color: #c9302c;
                    border-color: #ac2925;
                }
            </style>

            <h2><i class="fa fa-users" style="margin-right: 10px;"></i>Edit Data Hak Akses<small>& Role</small></h2>
            <hr>
            <form method="POST" action="/SUBeranda-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="txt_Nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="txt_Nama" name="txt_Nama" placeholder="Nama" maxlength="50" readonly>
                    </div>
                </div>
              
         
                    <label for="roles" class="col-sm-2 col-form-label">Roles:</label>
                    <div class="col-sm-4">
                        @foreach($availableRoles as $role)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="roles[]" id="roles[]" value="{{ $role }}"> {{ $role }}
                        </div>
                        @endforeach
                    </div>
                
                   
                <div class="form-group row">
                    <div class="col-sm-4 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" onclick="window.location.href = '/SUBeranda'" class="btn btn-danger">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

