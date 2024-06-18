@extends('index')
@section('title', 'Kesuma-GO | Nilai')
@section('content')
    <style>
        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table {
            transition: all 0.3s ease;
        }
        table:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .input-list {
            list-style-type: none;
            padding-left: 0;
        }
        .input-list li {
            margin-bottom: 10px;
        }
        .input-field {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            width: 200px;
        }
        .input-field:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px #007bff;
        }
        .dataTables_filter {
            width: 100%;
        }
        .input-field {
            width: 50px;
        }
        .input-list1 {
            list-style-type: none;
            padding-left: 0;
        }
        .input-list1 li {
            margin-bottom: 10px;
        }
        .input-field1 {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            width: 200px;
        }
        .input-field2 {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            width: 800px;
        }
        .input-field1 {
            min-width: 100px;
            width: 200px;
        }
        .editable-input {
            background-color: #00BFFF;
            border: 1px solid #ccc;
        }
        .non-editable-input {
            background-color: #e0e0e0;
            border: 1px solid #ccc;
            color: #666;
        }
        .editable-input {
            background-color: #00BFFF;
            border: 1px solid #ccc;
        }
        .non-editable-input {
            background-color: #e0e0e0;
            border: 1px solid #ccc;
            color: #666;
        }
    </style>

<div class="container">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data <small>Nilai</small></h3>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h4>Tahun Akademik: {{ $siswa->tahunakademik->tahunakademik }}</h4>
                            <h4>Kurikulum: {{ $siswa->tahunakademik->kurikulum->Nama_Kurikulum }}</h4>
                            <h4>Kelas: {{ $siswa->datakelas->kelas->namakelas }}</h4>
                            <h4>Wali Kelas: {{ $siswa->datakelas->guru->Nama }}</h4>
                            <h4>Nama: {{ $siswa->siswa->NamaLengkap }}</h4>
                        </div>
                        <div class="col-md-6 col-12 text-md-right text-center mt-2 mt-md-0">
                            <button type="button" onclick="window.location.href = '/datanilaisiswa'" class="btn btn-danger">Kembali</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="siswaTable">
                            <thead class="thead-white">
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>KKM</th>
                                    <th>Tugas 1</th>
                                    <th>Tugas 2</th>
                                    <th>Tugas 3</th>
                                    <th>Tugas 4</th>
                                    <th>Tugas 5</th>
                                    <th>Total Tugas</th>
                                    <th>Nilai UTS</th>
                                    <th>Nilai UAS</th>
                                    <th>Nilai Keaktifan</th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datamengajar_ids as $datamengajar_id => $nilai)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $nilai['MataPelajaran'] }}</td>
                                        <td>{{ $nilai['KKM'] }}</td>
                                        <input type="hidden" name="datamengajar_id[]" value="{{ $datamengajar_id }}">
                                        <td><input type="text" name="nilaitugas1[]" value="{{ $nilai['nilaitugas1'] }}" class="input-field" disabled></td>
                                        <td><input type="text" name="nilaitugas2[]" value="{{ $nilai['nilaitugas2'] }}" class="input-field" disabled></td>
                                        <td><input type="text" name="nilaitugas3[]" value="{{ $nilai['nilaitugas3'] }}" class="input-field" disabled></td>
                                        <td><input type="text" name="nilaitugas4[]" value="{{ $nilai['nilaitugas4'] }}" class="input-field" disabled></td>
                                        <td><input type="text" name="nilaitugas5[]" value="{{ $nilai['nilaitugas5'] }}" class="input-field" disabled></td>
                                        <td><input type="text" name="nilaitugas[]" value="{{ $nilai['nilaitugas'] }}" class="input-field" disabled></td>
                                        <td><input type="text" name="nilaiuts[]" value="{{ $nilai['nilaiuts'] }}" class="input-field" disabled></td>
                                        <td><input type="text" name="nilaiuas[]" value="{{ $nilai['nilaiuas'] }}" class="input-field" disabled></td>
                                        <td><input type="text" name="nilaikeaktifan[]" value="{{ $nilai['nilaikeaktifan'] }}" class="input-field" disabled></td>
                                        <td><input type="text" name="nilaitotal[]" value="{{ $nilai['nilaitotal'] }}" class="input-field" disabled></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                <a href="{{ route('siswaa.downloadddd', ['siswa_id' => $siswa->siswa_id]) }}"
                    class="btn btn-dark">Unduh Nilai</a>
            </div>
                </div>
        </div>
    </div>
</div>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var isResizing = false;
            var startX, startWidth;

            $('.input-field1').mousedown(function(e) {
                isResizing = true;
                startX = e.pageX;
                startWidth = $(this).width();
            });

            $(document).mousemove(function(e) {
                if (isResizing) {
                    var width = startWidth + (e.pageX - startX);
                    $('.input-field1').width(width);
                }
            });

            $(document).mouseup(function() {
                isResizing = false;
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#siswaTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "pageLength": 10,
                "dom": 'lBfrtip',
                "buttons": []
            });
        });
    </script>
@endsection
{{-- @extends('index')
@section('title', 'Kesuma-GO | Nilai')
@section('content')
    <style>
        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table {
            transition: all 0.3s ease;
        }
        table:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .input-list {
            list-style-type: none;
            padding-left: 0;
        }
        .input-list li {
            margin-bottom: 10px;
        }
        .input-field {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            width: 200px;
        }
        .input-field:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px #007bff;
        }
        .dataTables_filter {
            width: 100%;
        }
        .input-field {
            width: 50px;
        }
        .input-list1 {
            list-style-type: none;
            padding-left: 0;
        }
        .input-list1 li {
            margin-bottom: 10px;
        }
        .input-field1 {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            width: 200px;
        }
        .input-field2 {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            width: 800px;
        }
        .input-field1 {
            min-width: 100px;
            width: 200px;
        }
        .editable-input {
            background-color: #00BFFF;
            border: 1px solid #ccc;
        }
        .non-editable-input {
            background-color: #e0e0e0;
            border: 1px solid #ccc;
            color: #666;
        }
        .editable-input {
            background-color: #00BFFF;
            border: 1px solid #ccc;
        }
        .non-editable-input {
            background-color: #e0e0e0;
            border: 1px solid #ccc;
            color: #666;
        }
    </style>

    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data <small>Nilai</small></h3>
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Tahun Akademik : {{ $siswa->tahunakademik->tahunakademik }}</h2>
                                <h2>Kurikulum : {{ $siswa->tahunakademik->kurikulum->Nama_Kurikulum }}</h2>
                                <h2>Kelas : {{ $siswa->datakelas->kelas->namakelas }}</h2>
                                <h2>Wali Kelas : {{ $siswa->datakelas->guru->Nama }}</h2>
                                <h2>Nama : {{ $siswa->siswa->NamaLengkap }}</h2>
                            </div>
                            <div class="col-md-6 text-right">

                                <button type="button" onclick="window.location.href = '/datanilaisiswa'"
                                    class="btn btn-danger">Kembali</button>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                            <table class="table table-striped table-bordered" id="siswaTable">
                                <thead class="thead-white">
                                    <tr>
                                        <th style="width: 5px;">No</th>
                                        <th style="width: 100px;">Mata Pelajaran</th>
                                        <th style="width: 100px;">KKM</th>
                                        <th style="width: 70px;">Tugas 1</th>
                                        <th style="width: 70px;">Tugas 2</th>
                                        <th style="width: 70px;">Tugas 3</th>
                                        <th style="width: 70px;">Tugas 4</th>
                                        <th style="width: 70px;">Tugas 5</th>
                                        <th style="width: 70px;">Total Tugas</th>
                                        <th style="width: 70px;">Nilai UTS</th>
                                        <th style="width: 70px;">Nilai UAS</th>
                                        <th style="width: 100px;">Nilai Keaktifan</th>
                                        <th style="width: 70px;">Nilai Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datamengajar_ids as $datamengajar_id => $nilai)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $nilai['MataPelajaran'] }}</td>
                                            <td>{{ $nilai['KKM'] }}</td>
                                            <input type="hidden" name="datamengajar_id[]" value="{{ $datamengajar_id }}">
                                            <td>
                                                <input type="text" name="nilaitugas1[]" id="inputNilai"
                                                    value="{{ $nilai['nilaitugas1'] }}" placeholder="input"
                                                    class="input-field"maxlength="5" disabled><br>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitugas2[]" id="inputNilai"
                                                    value="{{ $nilai['nilaitugas2'] }}" placeholder="input"
                                                    class="input-field"maxlength="5" disabled><br>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitugas3[]" id="inputNilai"
                                                    value="{{ $nilai['nilaitugas3'] }}" placeholder="input"
                                                    class="input-field"maxlength="5" disabled><br>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitugas4[]" id="inputNilai"
                                                    value="{{ $nilai['nilaitugas4'] }}" placeholder="input"
                                                    class="input-field"maxlength="5" disabled><br>
                                            </td>
                                            <td>

                                                <input type="text" name="nilaitugas5[]" id="inputNilai"
                                                    value="{{ $nilai['nilaitugas5'] }}" placeholder="input"
                                                    class="input-field"maxlength="5" disabled><br>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitugas[]" id="inputNilai"
                                                    value="{{ $nilai['nilaitugas'] }}" placeholder="input"
                                                    class="input-field"maxlength="5" disabled><br>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaiuts[]"id="inputNilai1"
                                                    value="{{ $nilai['nilaiuts'] }}" placeholder="Input nilai"
                                                    class="input-field"maxlength="5" disabled><br>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaiuas[]"
                                                    value="{{ $nilai['nilaiuas'] }}"id="inputNilai2"
                                                    placeholder="Input nilai" class="input-field"maxlength="5" disabled><br>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaikeaktifan[]"
                                                    value="{{ $nilai['nilaikeaktifan'] }}"
                                                    id="inputNilai3"placeholder="Input nilai"
                                                    class="input-field"maxlength="5" disabled><br>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitotal[]"
                                                    value="{{ $nilai['nilaitotal'] }}"
                                                    id="inputNilai4"placeholder="Input nilai"
                                                    class="input-field"maxlength="5" disabled><br>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var isResizing = false;
            var startX, startWidth;

            $('.input-field1').mousedown(function(e) {
                isResizing = true;
                startX = e.pageX;
                startWidth = $(this).width();
            });

            $(document).mousemove(function(e) {
                if (isResizing) {
                    var width = startWidth + (e.pageX - startX);
                    $('.input-field1').width(width);
                }
            });

            $(document).mouseup(function() {
                isResizing = false;
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#siswaTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ],
                "pageLength": 10,
                "dom": 'lBfrtip',
                "buttons": []
            });
        });
    </script>
@endsection --}}
