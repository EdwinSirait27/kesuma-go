@extends('index')
@section('title', 'Kesuma-GO | Data Tenaga Pengajar')
@section('content')
<style>
    .table th,
    .table td {
      
        text-align: center;
    }

    /* ini dia */
    #datatable-buttons tbody tr:hover {
        background-color: lightyellow;
    }

    .hidden {
        display: none;
    }
    .lebar-kolom {

width: 120px;
/* Gaya tambahan lainnya */
}
  
</style>
<div class="row" id="hal_index">
    <div class="card-header bg-dark text-white">
        <h3><i class="fa fa-users"style="margin-right: 10px; margin-top: 15px;"></i>Data Laporan <small> Tenaga Pengajar</small></h3>
       
</div>
</div>
<hr>
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-users" style="margin-right: 10px; "></i>Daftar Data Diri<small>Tenaga Pengajar</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered " style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                        style="text-align: center; width: 5px; font-size: 13px; max-width: 10px;">
                                        No.
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom">
                                        Foto 
                                    </th>
                                    <th scope="col" style="text-align: center; font-size: 13px;" class="lebar-kolom">
                                        Nama 
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Agama
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Jenis Kelamin
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        NomorTelephone
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Alamat
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Email
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Tugas Mengajar
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Tugas Tambahan
                                    </th>
                                    <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                        width="60";>
                                        Action
                                    </th>
                                   
                                       
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                @if (auth()->user()->hakakses =='Admin')
                                    <button type="button" onclick="window.location.href = '/AdminBeranda'"
                                        class="btn btn-danger">Kembali</button>
                                        @endif
                    @if (auth()->user()->hakakses =='KepalaSekolah')
                                    <button type="button" onclick="window.location.href = '/KepalaSekolahBeranda'"
                                        class="btn btn-danger">Kembali</button>
                                        @endif

                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    // Hentikan inisialisasi DataTable sebelumnya jika sudah ada
    if ($.fn.DataTable.isDataTable('#datatable-buttons')) {
        $('#datatable-buttons').DataTable().destroy();
    }

    // Sekarang Anda dapat menginisialisasi DataTable yang baru
    var table = $('#datatable-buttons').DataTable({
        dom: 'lBfrtip', // 'l' will show "Show Entries" option
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
        buttons: ['copy', 'csv', 'excel',  {
        text: 'Download Semua',
        action: function (e, dt, node, config) {
            var newWindow = window.open('about:blank', '_blank');
            newWindow.location.href = "{{ url('/guru/downloadAll') }}";
        }
    }],
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('guru.index') }}",
            method: "GET"
        },
        columns: [
            {
                data: 'guru_id',
                name: 'guru_id',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
    data: 'foto',
    name: 'foto',
    render: function(data, type, full, meta) {
        if (data) {
            return '<img src="{{ asset('storage/fotoguru/') }}/' + data + '" width="100" />';
        } else {
            return 'Tidak Ada Foto';
        }
    }
},

            {
                  data: 'Nama',
                  name: 'Nama'
              },
              {
                  data: 'Agama',
                  name: 'Agama'
              },
              {
                  data: 'JenisKelamin',
                  name: 'JenisKelamin'
              },
              {
                  data: 'NomorTelephone',
                  name: 'NomorTelephone'
              },
              {
                  data: 'Alamat',
                  name: 'Alamat'
              },
              {
                  data: 'Email',
                  name: 'Email'
              },
              {
                  data: 'TugasMengajar',
                  name: 'TugasMengajar'
              },
              {
                  data: 'TugasTambahan',
                  name: 'TugasTambahan'
              },
              {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
           
              
        ]
    });
});
</script>
@endsection
