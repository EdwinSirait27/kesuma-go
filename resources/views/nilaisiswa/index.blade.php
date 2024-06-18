@extends('index')
@section('title', 'Kesuma-GO |Input Nilai')
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
            <div class="alert alert-dark">
                <ul>
                    Keterangan
                   <li><i >Penambahan keterangan minimal 176 karakter dan maksimal 180 karakter agar rapi pada laporan nilai siswa</i></li>
                    
                </ul>
            </div>
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data <small>Nilai</small></h3>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <h2>Kurikulum : {{ $datamengajar->tahunakademik->kurikulum->Nama_Kurikulum }}</h2>
                            <h2>Tahun Akademik : {{ $datamengajar->tahunakademik->tahunakademik }}</h2>
                            <h2>Semester : {{ $datamengajar->tahunakademik->semester }}</h2>
                            <h2>Kelas : {{ $datamengajar->datakelas->kelas->namakelas }}</h2>
                            <h2>Wali Kelas : {{ $datamengajar->datakelas->guru->Nama }}</h2>
                            <h2>Mata Pelajaran : {{ $datamengajar->datamengajar->matpel->MataPelajaran }}</h2>
                            <h2>KKM : {{ $datamengajar->datamengajar->matpel->KKM }}</h2>


                        </div>
                        <div class="col-md-6 col-12 text-md-right text-right mt-2 mt-md-0">
                            <button type="button" onclick="window.location.href = '/inputnilaiadmin'" class="btn btn-danger">Kembali</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST"
                    action="{{ route('simpan.nilai.matpel', ['datamengajar_id' => $datamengajar->datamengajar_id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="siswaTable">
                            <thead class="thead-white">
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
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
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa_ids as $siswa_id => $nilai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $nilai['NamaLengkap'] }}</td>
                                    <input type="hidden" name="siswa_id[]" value="{{ $siswa_id }}">
                                    <td>

                                        <input type="text" name="nilaitugas1[]" id="inputNilai"
                                            value="{{ $nilai['nilaitugas1'] }}" placeholder="input"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai = document.getElementById('inputNilai');
                                            inputNilai.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        

                                        <input type="text" name="nilaitugas2[]" id="inputNilai55"
                                            value="{{ $nilai['nilaitugas2'] }}" placeholder="input nilai"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai55 = document.getElementById('inputNilai55');
                                            inputNilai55.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaitugas3[]" id="inputNilai11"
                                            value="{{ $nilai['nilaitugas3'] }}" placeholder="input"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai11 = document.getElementById('inputNilai11');
                                            inputNilai11.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaitugas4[]" id="inputNilaigg"
                                            value="{{ $nilai['nilaitugas4'] }}" placeholder="input"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilaigg = document.getElementById('inputNilaigg');
                                            inputNilaigg.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaitugas5[]" id="inputNilaiaa"
                                            value="{{ $nilai['nilaitugas5'] }}" placeholder="input"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilaiaa = document.getElementById('inputNilaiaa');
                                            inputNilaiaa.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaitugas[]" id="inputNilaizz"
                                            value="{{ $nilai['nilaitugas'] }}" placeholder="Input"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilaizz = document.getElementById('inputNilaizz');
                                            inputNilaizz.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaiuts[]"id="inputNilai1"
                                            value="{{ $nilai['nilaiuts'] }}" placeholder="Input nilai"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai1 = document.getElementById('inputNilai1');
                                            inputNilai1.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaiuas[]"
                                            value="{{ $nilai['nilaiuas'] }}"id="inputNilai2"
                                            placeholder="Input nilai" class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai2 = document.getElementById('inputNilai2');
                                            inputNilai2.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaikeaktifan[]"
                                            value="{{ $nilai['nilaikeaktifan'] }}"
                                            id="inputNilai3"placeholder="Input nilai"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai3 = document.getElementById('inputNilai3');
                                            inputNilai3.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaitotal[]"
                                            value="{{ $nilai['nilaitotal'] }}"
                                            id="inputNilai4"placeholder="Input nilai"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai4 = document.getElementById('inputNilai4');
                                            inputNilai4.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="keterangan[]"
                                            value="{{ $nilai['keterangan'] }}"
                                            placeholder="Input Capaian Kompetensi" class="input-field1"
                                            minlength="176" maxlength="185"><br>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <a href="{{ route('datamengajarr.downloaddddd', ['datamengajar_id' => $datamengajar->datamengajar_id]) }}"
                            class="btn btn-dark">Unduh Nilai</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

                    </div>
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
@section('title', 'Kesuma-GO |Input Nilai')
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
                            <h2>Kurikulum : {{ $datamengajar->tahunakademik->kurikulum->Nama_Kurikulum }}</h2>
                            <h2>Tahun Akademik : {{ $datamengajar->tahunakademik->tahunakademik }}</h2>
                            <h2>Semester : {{ $datamengajar->tahunakademik->semester }}</h2>
                            <h2>Kelas : {{ $datamengajar->datakelas->kelas->namakelas }}</h2>
                            <h2>Wali Kelas : {{ $datamengajar->datakelas->guru->Nama }}</h2>
                            <h2>Mata Pelajaran : {{ $datamengajar->datamengajar->matpel->MataPelajaran }}</h2>
                            <h2>KKM : {{ $datamengajar->datamengajar->matpel->KKM }}</h2>


                        </div>
                        <div class="col-md-6 col-12 text-md-right text-right mt-2 mt-md-0">
                            <button type="button" onclick="window.location.href = '/inputnilaiadmin'" class="btn btn-danger">Kembali</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST"
                    action="{{ route('simpan.nilai.matpel', ['datamengajar_id' => $datamengajar->datamengajar_id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="siswaTable">
                            <thead class="thead-white">
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
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
                                    <th>Capaian Kompetensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa_ids as $siswa_id => $nilai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $nilai['NamaLengkap'] }}</td>
                                    <input type="hidden" name="siswa_id[]" value="{{ $siswa_id }}">
                                    <td>

                                        <input type="text" name="nilaitugas1[]" id="inputNilai"
                                            value="{{ $nilai['nilaitugas1'] }}" placeholder="input"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai = document.getElementById('inputNilai');
                                            inputNilai.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        

                                        <input type="text" name="nilaitugas2[]" id="inputNilai55"
                                            value="{{ $nilai['nilaitugas2'] }}" placeholder="input nilai"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai55 = document.getElementById('inputNilai55');
                                            inputNilai55.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaitugas3[]" id="inputNilai11"
                                            value="{{ $nilai['nilaitugas3'] }}" placeholder="input"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai11 = document.getElementById('inputNilai11');
                                            inputNilai11.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaitugas4[]" id="inputNilaigg"
                                            value="{{ $nilai['nilaitugas4'] }}" placeholder="input"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilaigg = document.getElementById('inputNilaigg');
                                            inputNilaigg.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaitugas5[]" id="inputNilaiaa"
                                            value="{{ $nilai['nilaitugas5'] }}" placeholder="input"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilaiaa = document.getElementById('inputNilaiaa');
                                            inputNilaiaa.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaitugas[]" id="inputNilaizz"
                                            value="{{ $nilai['nilaitugas'] }}" placeholder="Input"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilaizz = document.getElementById('inputNilaizz');
                                            inputNilaizz.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaiuts[]"id="inputNilai1"
                                            value="{{ $nilai['nilaiuts'] }}" placeholder="Input nilai"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai1 = document.getElementById('inputNilai1');
                                            inputNilai1.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaiuas[]"
                                            value="{{ $nilai['nilaiuas'] }}"id="inputNilai2"
                                            placeholder="Input nilai" class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai2 = document.getElementById('inputNilai2');
                                            inputNilai2.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaikeaktifan[]"
                                            value="{{ $nilai['nilaikeaktifan'] }}"
                                            id="inputNilai3"placeholder="Input nilai"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai3 = document.getElementById('inputNilai3');
                                            inputNilai3.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    <td>
                                        <input type="text" name="nilaitotal[]"
                                            value="{{ $nilai['nilaitotal'] }}"
                                            id="inputNilai4"placeholder="Input nilai"
                                            class="input-field"maxlength="5"><br>
                                        <script>
                                            var inputNilai4 = document.getElementById('inputNilai4');
                                            inputNilai4.addEventListener('input', function() {
                                                this.value = this.value.replace(/[^0-9.]/g, '');
                                                if ((this.value.match(/\./g) || []).length > 1) {
                                                    this.value = this.value.slice(0, -1);
                                                }
                                            });
                                        </script>

                                    </td>
                                    @if (is_array($nilai['keterangan']))
                                    @foreach ($nilai['keterangan'] as $keterangan)
                                        <input type="text" name="keterangan[]"
                                            value="{{ $catatan }}"
                                            placeholder="Input nilai"
                                            class="input-field1"maxlength="115"><br>
                                    @endforeach
                                @else
                                    <input type="text" name="catatan[]"
                                        id="inputNilai"
                                        value="{{ $nilai['keterangan'] }}"
                                        placeholder="Keterangan"
                                        class="input-field1"maxlength="115"><br>
                                @endif
                            </td>


                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <a href="{{ route('datamengajarr.downloaddddd', ['datamengajar_id' => $datamengajar->datamengajar_id]) }}"
                            class="btn btn-dark">Unduh Nilai</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

                    </div>
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
