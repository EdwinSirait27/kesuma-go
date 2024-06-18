@extends('index')
@section('title', 'Kesuma-GO | Button Tanggal')
@section('content')
    @include('buttonnilaisiswa.create')
    <style>
        .table th,
        .table td {
            text-align: center;
        }
        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }
    </style>
    <div class="row" id="hal_index">
        <div class="card-header bg-dark text-white">
            <h3><i class="fa fa-book"style="margin-right: 10px; margin-top: 15px;"></i>Button <small> Nilai Siswa</small></h3>
           
    </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="row g-3 align-items-center">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">

                            </div>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Data Button Tanggal</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table class="table table-striped table-bordered user_datatable">
                                    <thead>
                                        <th scope="col"
                                            style="text-align: center; width: 5px; font-size: 13px; max-width: 10px;">
                                            No.
                                        </th>
                                        <th scope="col" style="text-align: center; font-size: 13px; max-width: 200px;">
                                            Url
                                        </th>  
                                        <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                            width="60";>
                                            Tanggal Mulai
                                        </th>
                                        <th scope="col" style="text-align: center;  font-size: 13px;" class="lebar-kolom"
                                            width="60";>
                                            Tanggal Berakhir
                                        </th>
                                        <th scope="col" style="text-align: center; width: 10px; font-size: 13px;">
                                            Action
                                        </th>
                                      
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="form-group row">
                                <div class=r"col-sm-10">
                                    
                                    @if (auth()->user()->hakakses == 'Admin')
                                            <button type="button" onclick="window.location.href = '/AdminBeranda'"
                                            class="btn btn-danger">Kembali</button>
                                            @endif
                                            @if (auth()->user()->hakakses == 'KepalaSekolah')
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        iForm('hal_index');
        function iForm(iv) {
            $('#hal_index').hide();
            $('#hal_edit').hide();
            $('#' + iv).show();
        }
       
        function editAndShow(iv, id) {
            $.ajax({
                url: "/buttonnilaisiswa-edit1/" + id,
                type: "GET",
                success: function(data) {
                    // Mengisi nilai input dengan data yang ada
                    $('#txt_id').val(id);
                    $('#url').val(data.url);
                    $('#start_date').val(data.start_date);
                    $('#end_date').val(data.end_date);
                    iForm('hal_edit');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
        function saveChanges() {
            var id = $('#txt_id').val();
            var url = $('#url').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var data = {
                id: id,
                url: url,
                start_date: start_date,
                end_date: end_date
            };
            $.ajax({
                url: "/buttonnilaisiswa-save",
                type: "POST",
                data: data,
                success: function(response) {
              console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
        function setData(data) {
            $('#txt_id').val(data.txt_id);
            $('#url').val(data.url);
                    $('#start_date').val(data.start_date);
                    $('#end_date').val(data.end_date);
            return $.Deferred().resolve().promise();
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('buttonnilaisiswa.index2') }}",
                    method: "GET"
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'url',
                        name: 'url'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
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
