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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data <small>Nilai</small></h3>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <h2>Tahun Akademik : {{ $siswa->tahunakademik->tahunakademik }}</h2>
                                <h2>Kurikulum : {{ $siswa->tahunakademik->kurikulum->Nama_Kurikulum }}</h2>
                                <h2>Kelas : {{ $siswa->datakelas->kelas->namakelas }}</h2>
                                <h2>Wali Kelas : {{ $siswa->datakelas->guru->Nama }}</h2>
                                <h2>Nama : {{ $siswa->siswa->NamaLengkap }}</h2>

                            </div>
                            <div class="col-md-6 col-12 text-md-right text-right mt-2 mt-md-0">
                                @if (auth()->user()->hakakses == 'Admin' ||
                                        auth()->user()->hakakses == 'KepalaSekolah' ||
                                        auth()->user()->hakakses == 'Guru')
                                    <button type="button" onclick="window.location.href = '/inputnilaiguru'"
                                        class="btn btn-danger">Kembali</button>
                                @endif
                            </div>
                        </div>
                        </div>
                    
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('simpan.nilai', $siswa->siswa_id) }}">

                            @csrf
                            @method('PUT')
                            <div class="table-responsive">
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
                                        <th style="width: 70px;">Tugas Total</th>
                                        <th style="width: 70px;">Nilai UTS</th>
                                        <th style="width: 70px;">Nilai UAS</th>
                                        <th style="width: 100px;">Nilai Keaktifan</th>
                                        <th style="width: 70px;">Nilai Akhir</th>
                                        <th style="width: 500px;">Capaian Kompetensi</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($datamengajar_ids as $datamengajar_id => $nilai)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $nilai['MataPelajaran'] }}</td>
                                            <td>
                                                {{ $nilai['KKM'] }}
                                            </td>
                                            <input type="hidden" name="datamengajar_id[]" value="{{ $datamengajar_id }}">
                                            <td>
                                                <input type="text" name="nilaitugas1[]" id="inputNilaia"
                                                    value="{{ $nilai['nilaitugas1'] }}" placeholder="input"
                                                    class="input-field"maxlength="5"><br>
                                                <script>
                                                    var inputNilaia = document.getElementById('inputNilaia');
                                                    inputNilaia.addEventListener('input', function() {
                                                        this.value = this.value.replace(/[^0-9.]/g, '');
                                                        if ((this.value.match(/\./g) || []).length > 1) {
                                                            this.value = this.value.slice(0, -1);
                                                        }
                                                    });
                                                </script>

                                            </td>

                                            <td>
                                                <input type="text" name="nilaitugas2[]" id="inputNilaib"
                                                    value="{{ $nilai['nilaitugas2'] }}" placeholder="input"
                                                    class="input-field"maxlength="5"><br>
                                                <script>
                                                    var inputNilaib = document.getElementById('inputNilaib');
                                                    inputNilaib.addEventListener('input', function() {
                                                        this.value = this.value.replace(/[^0-9.]/g, '');
                                                        if ((this.value.match(/\./g) || []).length > 1) {
                                                            this.value = this.value.slice(0, -1);
                                                        }
                                                    });
                                                </script>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitugas3[]" id="inputNilaic"
                                                    value="{{ $nilai['nilaitugas3'] }}" placeholder="input"
                                                    class="input-field"maxlength="5"><br>
                                                <script>
                                                    var inputNilaic = document.getElementById('inputNilaic');
                                                    inputNilaic.addEventListener('input', function() {
                                                        this.value = this.value.replace(/[^0-9.]/g, '');
                                                        if ((this.value.match(/\./g) || []).length > 1) {
                                                            this.value = this.value.slice(0, -1);
                                                        }
                                                    });
                                                </script>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitugas4[]" id="inputNilaid"
                                                    value="{{ $nilai['nilaitugas4'] }}" placeholder="input"
                                                    class="input-field"maxlength="5"><br>
                                                <script>
                                                    var inputNilaid = document.getElementById('inputNilaid');
                                                    inputNilaid.addEventListener('input', function() {
                                                        this.value = this.value.replace(/[^0-9.]/g, '');
                                                        if ((this.value.match(/\./g) || []).length > 1) {
                                                            this.value = this.value.slice(0, -1);
                                                        }
                                                    });
                                                </script>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitugas5[]" id="inputNilaie"
                                                    value="{{ $nilai['nilaitugas5'] }}" placeholder="input"
                                                    class="input-field"maxlength="5"><br>
                                                <script>
                                                    var inputNilaie = document.getElementById('inputNilaie');
                                                    inputNilaie.addEventListener('input', function() {
                                                        this.value = this.value.replace(/[^0-9.]/g, '');
                                                        if ((this.value.match(/\./g) || []).length > 1) {
                                                            this.value = this.value.slice(0, -1);
                                                        }
                                                    });
                                                </script>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitugas[]" id="inputNilaif"
                                                    value="{{ $nilai['nilaitugas'] }}" placeholder="Input"
                                                    class="input-field"maxlength="5"><br>
                                                <script>
                                                    var inputNilaif = document.getElementById('inputNilaif');
                                                    inputNilaif.addEventListener('input', function() {
                                                        this.value = this.value.replace(/[^0-9.]/g, '');
                                                        if ((this.value.match(/\./g) || []).length > 1) {
                                                            this.value = this.value.slice(0, -1);
                                                        }
                                                    });
                                                </script>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaiuts[]"id="inputNilaig"
                                                    value="{{ $nilai['nilaiuts'] }}" placeholder="Input nilai"
                                                    class="input-field"maxlength="5"><br>
                                                <script>
                                                    var inputNilaig = document.getElementById('inputNilaig');
                                                    inputNilaig.addEventListener('input', function() {
                                                        this.value = this.value.replace(/[^0-9.]/g, '');
                                                        if ((this.value.match(/\./g) || []).length > 1) {
                                                            this.value = this.value.slice(0, -1);
                                                        }
                                                    });
                                                </script>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaiuas[]"
                                                    value="{{ $nilai['nilaiuas'] }}"id="inputNilaih"
                                                    placeholder="Input nilai" class="input-field"maxlength="5"><br>
                                                <script>
                                                    var inputNilaih = document.getElementById('inputNilaih');
                                                    inputNilaih.addEventListener('input', function() {
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
                                                    id="inputNilaii"placeholder="Input nilai"
                                                    class="input-field"maxlength="5"><br>
                                                <script>
                                                    var inputNilaii = document.getElementById('inputNilaii');
                                                    inputNilaii.addEventListener('input', function() {
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
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                            <div class="container">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-dark text-white">
                                                <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data
                                                    <small>Ekstrakulikuer</small>
                                                </h3>
                                            </div>
                                            <br>
                                            <div class="table-responsive">
                                            <table class="table table-striped table-bordered col-12" id="siswaTable1">
                                                <thead class="thead-white">
                                                    <tr>
                                                        <th style="width: 5px;">No</th>
                                                        <th style="width: 5px;">Ekstrakulikuer</th>
                                                        <th style="width: 5px;">Predikat</th>
                                                        <th style="width: 1000px;">Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($ekstra_guru_ids) > 0)
                                                        @foreach ($ekstra_guru_ids as $ekstra_guru_id => $nilai1)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $nilai1['namaekskul'] }}</td>
                                                                <input type="hidden" name="ekstra_guru_id[]"
                                                                    value="{{ $ekstra_guru_id }}">
                                                                <td>
                                                                    @if (is_array($nilai1['predikat']))
                                                                        @foreach ($nilai1['predikat'] as $predikat)
                                                                            <input type="text" name="predikat[]"
                                                                                value="{{ $predikat }}"
                                                                                placeholder="Input nilai"
                                                                                class="input-field"><br>
                                                                        @endforeach
                                                                    @else
                                                                        <input type="text" name="predikat[]"
                                                                            id="inputNilai"
                                                                            value="{{ $nilai1['predikat'] }}"
                                                                            placeholder="Inpur Nilai"
                                                                            class="input-field"maxlength="1"><br>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (is_array($nilai1['keterangann']))
                                                                        @foreach ($nilai1['keterangann'] as $keterangann)
                                                                            <input type="text" name="keterangann[]"
                                                                                value="{{ $keterangann }}"
                                                                                placeholder="Input nilai"
                                                                                class="input-field"><br>
                                                                        @endforeach
                                                                    @else
                                                                        <input type="text" name="keterangann[]"
                                                                            id="inputNilai"
                                                                            value="{{ $nilai1['keterangann'] }}"
                                                                            placeholder="Inpur Nilai"
                                                                            class="input-field1"minlength="176"
                                                                            maxlength="180" required><br>
                                                                    @endif
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="4">No data</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            </div>
                                            </div>
                                            </div>
                                      


                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-dark text-white">
                                                <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data
                                                    <small>Ketidakhadiran (Hari)</small>
                                                </h3>
                                            </div>
                                            <br>
                                            <div class="table-responsive">
                   
                                            <table class="table table-striped table-bordered col-12" id="siswaTable2">
                                                <thead class="thead-white">
                                                    <tr>
                                                        <th style="width: 5px;">No</th>

                                                        <th style="width: 1px;">Izin</th>
                                                        <th style="width: 1px;">Sakit</th>
                                                        <th style="width: 1px;">Tanpa Keterangan</th>
                                                        <th style="width: 100px;">Catatan Wali Kelas</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($siswa_ids) > 0)
                                                        @foreach ($siswa_ids as $siswa_id => $nilai2)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>

                                                                <input type="hidden" name="siswa_id[]"
                                                                    value="{{ $siswa_id }}">
                                                                <td>
                                                                    @if (is_array($nilai2['izin']))
                                                                        @foreach ($nilai2['izin'] as $izin)
                                                                            <input type="text" name="izin[]"
                                                                                value="{{ $izin }}"
                                                                                placeholder="Input nilai"
                                                                                class="input-field"><br>
                                                                        @endforeach
                                                                    @else
                                                                        <input type="text" name="izin[]"
                                                                            id="inputNilai" value="{{ $nilai2['izin'] }}"
                                                                            placeholder="Inpur Nilai"
                                                                            class="input-field"maxlength="1"><br>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (is_array($nilai2['sakit']))
                                                                        @foreach ($nilai2['sakit'] as $sakit)
                                                                            <input type="text" name="sakit[]"
                                                                                value="{{ $sakit }}"
                                                                                placeholder="Input nilai"
                                                                                class="input-field"><br>
                                                                        @endforeach
                                                                    @else
                                                                        <input type="text" name="sakit[]"
                                                                            id="inputNilai"
                                                                            value="{{ $nilai2['sakit'] }}"
                                                                            placeholder="Inpur Nilai"
                                                                            class="input-field"maxlength="1"><br>
                                                                    @endif
                                                                </td>
                                                                <td>

                                                                    <input type="text" name="tk[]"
                                                                        id="inputNilaiaa" value="{{ $nilai2['tk'] }}"
                                                                        placeholder="Inpur Nilai"
                                                                        class="input-field"maxlength="10"><br>
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
                                                                    @if (is_array($nilai2['catatan']))
                                                                        @foreach ($nilai2['catatan'] as $catatan)
                                                                            <input type="text" name="catatan[]"
                                                                                value="{{ $catatan }}"
                                                                                placeholder="Input nilai"
                                                                                class="input-field1"><br>
                                                                        @endforeach
                                                                    @else
                                                                        <input type="text" name="catatan[]"
                                                                            id="inputNilai"
                                                                            value="{{ $nilai2['catatan'] }}"
                                                                            placeholder="Catatan"
                                                                            class="input-field1"><br>
                                                                    @endif
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="5">No data</td>
                                                        </tr>
                                                    @endif

                                                </tbody>
                                            </table>
                                            </div>
                                            </div>
                                            </div>
                                            
                                            <div class="container">
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-header bg-dark text-white">
                                                                <h3><i class="fa fa-calculator"
                                                                        style="margin-right: 10px;"></i>Prestasi
                                                                    <small>Siswa</small>
                                                                </h3>

                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="table-responsive">
                    
                                            <table class="table table-striped table-bordered" id="siswaTable1">
                                                <thead class="thead-white">
                                                    <tr>
                                                        <th style="width: 5px;">No</th>
                                                        <th style="width: 1000px;">Prestasi</th>
                                                        <th style="width: 1000px;">Deskripsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($prestasiData) > 0)
                                                        @foreach ($prestasiData as $data)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $data['prestasi'] }}</td>
                                                                <td>{{ $data['keterangan'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="3">No data</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            


                            <a href="{{ route('siswaa.downloadddd', ['siswa_id' => $siswa->siswa_id]) }}"
                                class="btn btn-dark">Unduh Nilai</a>


                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div> 



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

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
{{-- @extends('index')
@section('title', 'Kesuma-GO | Nilai')
@section('content')
    <style>
        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* #siswaTable1 {
                width: 560px;
             
            } */

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

        /* CSS untuk menyesuaikan lebar elemen pencarian */
        .dataTables_filter {
            width: 100%;
            /* Atur lebar elemen pencarian agar mengisi seluruh lebar parentnya */
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
            /* Contoh warna latar belakang */
            border: 1px solid #ccc;
            /* Contoh border */
        }

        /* CSS untuk menandai input yang tidak boleh diedit */
        .non-editable-input {
            background-color: #e0e0e0;
            /* Contoh warna latar belakang */
            border: 1px solid #ccc;
            /* Contoh border */
            color: #666;
            /* Contoh warna teks */
        }

        .editable-input {
            background-color: #00BFFF;
            /* Contoh warna latar belakang */
            border: 1px solid #ccc;
            /* Contoh border */
        }

        /* CSS untuk menandai input yang tidak boleh diedit */
        .non-editable-input {
            background-color: #e0e0e0;
            /* Contoh warna latar belakang */
            border: 1px solid #ccc;
            /* Contoh border */
            color: #666;
            /* Contoh warna teks */
        }
    </style>
    <div class="col-md-12 col-sm-12">
        <h3><i class="fa fa-users" style="margin-right: 10px; margin-top: 15px;"></i>List Nilai <small>Siswa</small></h3>
        <hr>
    </div>
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
                                @if (auth()->user()->hakakses == 'Admin' || auth()->user()->hakakses == 'KepalaSekolah' || auth()->user()->hakakses == 'Guru')
                                    <button type="button" onclick="window.location.href = '/inputnilaiguru'"
                                        class="btn btn-danger">Kembali</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('simpan.nilai', $siswa->siswa_id) }}">

                            @csrf
                            @method('PUT')
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
                                        <th style="width: 70px;">Tugas Total</th>
                                        <th style="width: 70px;">Nilai UTS</th>
                                        <th style="width: 70px;">Nilai UAS</th>
                                        <th style="width: 100px;">Nilai Keaktifan</th>
                                        <th style="width: 70px;">Nilai Akhir</th>
                                        <th style="width: 500px;">Capaian Kompetensi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                            
                                    @foreach ($datamengajar_ids as $datamengajar_id => $nilai)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $nilai['MataPelajaran'] }}</td>
                                            <td>
                                                {{ $nilai['KKM'] }}
                                            </td>
                                            <input type="hidden" name="datamengajar_id[]" value="{{ $datamengajar_id }}">
                                            <td>
                                                <input type="text" name="nilaitugas1[]" id="inputNilaia"
                                                    value="{{ $nilai['nilaitugas1'] }}" placeholder="input"
                                                    class="input-field"maxlength="5"><br>
                                                    <script>
                                                        var inputNilaia = document.getElementById('inputNilaia');
                                                inputNilaia.addEventListener('input', function() {
                                                    this.value = this.value.replace(/[^0-9.]/g, '');
                                                    if ((this.value.match(/\./g) || []).length > 1) {
                                                        this.value = this.value.slice(0, -1);
                                                    }
                                                });
                    
                                                </script>

                                            </td>
                                          
                                            <td>
                                                <input type="text" name="nilaitugas2[]" id="inputNilaib"
                                                    value="{{ $nilai['nilaitugas2'] }}" placeholder="input"
                                                    class="input-field"maxlength="5"><br>
                                                    <script>
                                                        var inputNilaib = document.getElementById('inputNilaib');
                                                inputNilaib.addEventListener('input', function() {
                                                    this.value = this.value.replace(/[^0-9.]/g, '');
                                                    if ((this.value.match(/\./g) || []).length > 1) {
                                                        this.value = this.value.slice(0, -1);
                                                    }
                                                });
                    
                                                </script>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitugas3[]" id="inputNilaic"
                                                    value="{{ $nilai['nilaitugas3'] }}" placeholder="input"
                                                    class="input-field"maxlength="5"><br>
                                                    <script>
                                                        var inputNilaic = document.getElementById('inputNilaic');
                                                inputNilaic.addEventListener('input', function() {
                                                    this.value = this.value.replace(/[^0-9.]/g, '');
                                                    if ((this.value.match(/\./g) || []).length > 1) {
                                                        this.value = this.value.slice(0, -1);
                                                    }
                                                });
                    
                                                </script>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitugas4[]" id="inputNilaid"
                                                    value="{{ $nilai['nilaitugas4'] }}" placeholder="input"
                                                    class="input-field"maxlength="5"><br>
                                                    <script>
                                                        var inputNilaid= document.getElementById('inputNilaid');
                                                inputNilaid.addEventListener('input', function() {
                                                    this.value = this.value.replace(/[^0-9.]/g, '');
                                                    if ((this.value.match(/\./g) || []).length > 1) {
                                                        this.value = this.value.slice(0, -1);
                                                    }
                                                });
                    
                                                </script>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitugas5[]" id="inputNilaie"
                                                    value="{{ $nilai['nilaitugas5'] }}" placeholder="input"
                                                    class="input-field"maxlength="5"><br>
                                                    <script>
                                                        var inputNilaie = document.getElementById('inputNilaie');
                                                inputNilaie.addEventListener('input', function() {
                                                    this.value = this.value.replace(/[^0-9.]/g, '');
                                                    if ((this.value.match(/\./g) || []).length > 1) {
                                                        this.value = this.value.slice(0, -1);
                                                    }
                                                });
                    
                                                </script>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaitugas[]" id="inputNilaif"
                                                    value="{{ $nilai['nilaitugas'] }}" placeholder="Input"
                                                    class="input-field"maxlength="5"><br>
                                                    <script>
                                                        var inputNilaif = document.getElementById('inputNilaif');
                                                inputNilaif.addEventListener('input', function() {
                                                    this.value = this.value.replace(/[^0-9.]/g, '');
                                                    if ((this.value.match(/\./g) || []).length > 1) {
                                                        this.value = this.value.slice(0, -1);
                                                    }
                                                });
                    
                                                </script>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaiuts[]"id="inputNilaig"
                                                    value="{{ $nilai['nilaiuts'] }}" placeholder="Input nilai"
                                                    class="input-field"maxlength="5"><br>
                                                    <script>
                                                        var inputNilaig = document.getElementById('inputNilaig');
                                                inputNilaig.addEventListener('input', function() {
                                                    this.value = this.value.replace(/[^0-9.]/g, '');
                                                    if ((this.value.match(/\./g) || []).length > 1) {
                                                        this.value = this.value.slice(0, -1);
                                                    }
                                                });
                    
                                                </script>
                                            </td>
                                            <td>
                                                <input type="text" name="nilaiuas[]"
                                                    value="{{ $nilai['nilaiuas'] }}"id="inputNilaih"
                                                    placeholder="Input nilai" class="input-field"maxlength="5"><br>
                                                    <script>
                                                        var inputNilaih = document.getElementById('inputNilaih');
                                                inputNilaih.addEventListener('input', function() {
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
                                                    id="inputNilaii"placeholder="Input nilai"
                                                    class="input-field"maxlength="5"><br>
                                                    <script>
                                                        var inputNilaii = document.getElementById('inputNilaii');
                                                inputNilaii.addEventListener('input', function() {
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
                                            </td>
                                            <td>
                                                <input type="text" name="keterangan[]"
                                                    value="{{ $nilai['keterangan'] }}"
                                                    placeholder="Input Capaian Kompetensi" class="input-field1"
                                                    minlength="176" maxlength="185"><br>

                                        </tr>
                                    @endforeach

                                   
                                </tbody>

                                </tbody>
                            </table>

                            <div class="container">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-dark text-white">
                                                <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data
                                                    <small>Ekstrakulikuer</small>
                                                </h3>
                                            </div>
                                            <br>



                                            <table class="table table-striped table-bordered col-12" id="siswaTable1">
                                                <thead class="thead-white">
                                                    <tr>
                                                        <th style="width: 5px;">No</th>
                                                        <th style="width: 5px;">Ekstrakulikuer</th>
                                                        <th style="width: 5px;">Predikat</th>
                                                        <th style="width: 1000px;">Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($ekstra_guru_ids) > 0)
                                                        @foreach ($ekstra_guru_ids as $ekstra_guru_id => $nilai1)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $nilai1['namaekskul'] }}</td>
                                                                <input type="hidden" name="ekstra_guru_id[]"
                                                                    value="{{ $ekstra_guru_id }}">
                                                                <td>
                                                                    @if (is_array($nilai1['predikat']))
                                                                        @foreach ($nilai1['predikat'] as $predikat)
                                                                            <input type="text" name="predikat[]"
                                                                                value="{{ $predikat }}"
                                                                                placeholder="Input nilai"
                                                                                class="input-field"><br>
                                                                        @endforeach
                                                                    @else
                                                                        <input type="text" name="predikat[]"
                                                                            id="inputNilai"
                                                                            value="{{ $nilai1['predikat'] }}"
                                                                            placeholder="Inpur Nilai"
                                                                            class="input-field"maxlength="1"><br>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (is_array($nilai1['keterangann']))
                                                                        @foreach ($nilai1['keterangann'] as $keterangann)
                                                                            <input type="text" name="keterangann[]"
                                                                                value="{{ $keterangann }}"
                                                                                placeholder="Input nilai"
                                                                                class="input-field"><br>
                                                                        @endforeach
                                                                    @else
                                                                        <input type="text" name="keterangann[]"
                                                                            id="inputNilai"
                                                                            value="{{ $nilai1['keterangann'] }}"
                                                                            placeholder="Inpur Nilai"
                                                                            class="input-field1"minlength="176"
                                                                            maxlength="180" required><br>
                                                                    @endif
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="4">No data</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-dark text-white">
                                                <h3><i class="fa fa-calculator" style="margin-right: 10px;"></i>Data
                                                    <small>Ketidakhadiran (Hari)</small>
                                                </h3>
                                            </div>
                                            <br>
                                            <table class="table table-striped table-bordered col-12" id="siswaTable2">
                                                <thead class="thead-white">
                                                    <tr>
                                                        <th style="width: 5px;">No</th>

                                                        <th style="width: 1px;">Izin</th>
                                                        <th style="width: 1px;">Sakit</th>
                                                        <th style="width: 1px;">Tanpa Keterangan</th>
                                                        <th style="width: 100px;">Catatan Wali Kelas</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($siswa_ids) > 0)
                                                        @foreach ($siswa_ids as $siswa_id => $nilai2)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>

                                                                <input type="hidden" name="siswa_id[]"
                                                                    value="{{ $siswa_id }}">
                                                                <td>
                                                                    @if (is_array($nilai2['izin']))
                                                                        @foreach ($nilai2['izin'] as $izin)
                                                                            <input type="text" name="izin[]"
                                                                                value="{{ $izin }}"
                                                                                placeholder="Input nilai"
                                                                                class="input-field"><br>
                                                                        @endforeach
                                                                    @else
                                                                        <input type="text" name="izin[]"
                                                                            id="inputNilai" value="{{ $nilai2['izin'] }}"
                                                                            placeholder="Inpur Nilai"
                                                                            class="input-field"maxlength="1"><br>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (is_array($nilai2['sakit']))
                                                                        @foreach ($nilai2['sakit'] as $sakit)
                                                                            <input type="text" name="sakit[]"
                                                                                value="{{ $sakit }}"
                                                                                placeholder="Input nilai"
                                                                                class="input-field"><br>
                                                                        @endforeach
                                                                    @else
                                                                        <input type="text" name="sakit[]"
                                                                            id="inputNilai"
                                                                            value="{{ $nilai2['sakit'] }}"
                                                                            placeholder="Inpur Nilai"
                                                                            class="input-field"maxlength="1"><br>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                 
                                                                        <input type="text" name="tk[]"
                                                                        id="inputNilaiaa" value="{{ $nilai2['tk'] }}"
                                                                            placeholder="Inpur Nilai"
                                                                            class="input-field"maxlength="10"><br>
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
                                                                    @if (is_array($nilai2['catatan']))
                                                                        @foreach ($nilai2['catatan'] as $catatan)
                                                                            <input type="text" name="catatan[]"
                                                                                value="{{ $catatan }}"
                                                                                placeholder="Input nilai"
                                                                                class="input-field1"><br>
                                                                        @endforeach
                                                                    @else
                                                                        <input type="text" name="catatan[]"
                                                                            id="inputNilai"
                                                                            value="{{ $nilai2['catatan'] }}"
                                                                            placeholder="Catatan"
                                                                            class="input-field1"><br>
                                                                    @endif
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="5">No data</td>
                                                        </tr>
                                                    @endif

                                                </tbody>
                                            </table>
                                            <div class="container">
                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-header bg-dark text-white">
                                                                <h3><i class="fa fa-calculator"
                                                                        style="margin-right: 10px;"></i>Prestasi
                                                                    <small>Siswa</small>
                                                                </h3>

                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <table class="table table-striped table-bordered" id="siswaTable1">
                                                <thead class="thead-white">
                                                    <tr>
                                                        <th style="width: 5px;">No</th>
                                                        <th style="width: 1000px;">Prestasi</th>
                                                        <th style="width: 1000px;">Deskripsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($prestasiData) > 0)
                                                        @foreach ($prestasiData as $data)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $data['prestasi'] }}</td>
                                                                <td>{{ $data['keterangan'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="3">No data</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <a href="{{ route('siswaa.downloadddd', ['siswa_id' => $siswa->siswa_id]) }}"
                                class="btn btn-dark">Unduh Nilai</a>
                          

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    

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

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection --}}
