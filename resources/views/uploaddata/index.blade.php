@extends('index')
@section('title', 'Kesuma-GO | Input Nilai Siswa')

@section('content')
<style>
        .table th,
        .table td {
            text-align: center;
        }

        .user_datatable tbody tr:hover {
            background-color: lightyellow;
        }

        .col-form-label {
            font-size: 18px;
        }

        .text-success,
        .text-danger {
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .text-success {
            background-color: green;
        }

        .text-danger {
            background-color: red;
        }

</style>
<div class="row" id="hal_index">
    <div class="card-header bg-dark text-white">
        <h3><i class="fa fa-calculator"style="margin-right: 10px; margin-top: 15px;"></i>Upload <small> Arsip</small></h3>
       
</div>
</div>
<hr>
<form action="{{ route('uploaddata.csv') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="form-group">
        <label for="csv_file">Upload  File:</label>
        <input type="file" class="form-control-file" id="csv_file" name="csv_file">
    </div>
    <div class="alert alert-dark">
        <ul>
           <li><i >Kalau mengupload file gunakan ekstensi CSV (Comma delimited) (*.csv) </i></li>
            
        </ul>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
    <button type="button" onclick="window.location.href = '/arsip'"
    class="btn btn-danger">Kembali</button>
</form>
@endsection
