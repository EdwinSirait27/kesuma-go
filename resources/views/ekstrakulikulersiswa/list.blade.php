@extends('index')
@section('title', 'Kesuma-GO | Data Ekstrakulikuler')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h3 class="text-center mb-0">List Ekstrakurikuler</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('ekstrakulikulersiswa.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold">Pilih Ekstrakurikuler:</label><br>
                            @foreach ($ekstragurus as $ekstraguru)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="ekstra_guru_id[]" value="{{ $ekstraguru->ekstra_guru_id }}" id="ekstra{{ $ekstraguru->ekstra_guru_id }}">
                                    <label class="form-check-label" for="ekstra{{ $ekstraguru->ekstra_guru_id }}">{{ $ekstraguru->ekskul->namaekskul }}</label>
                                </div>
                            @endforeach
                        </div>
                        <h2 class="text-danger">Anda hanya dapat memilih maksimal 3 ekstrakulikuler.</h2>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg px-5">Daftar</button>
                            <a href="/ekstrakulikulersiswa" class="btn btn-danger btn-lg ml-3 px-5">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
{{-- @extends('index')
@section('title', 'Kesuma-GO | Data Ekstrakulikuler')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h3 class="text-center mb-0">List Ekstrakurikuler</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('ekstrakulikulersiswa.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold">Pilih Ekstrakurikuler:</label><br>
                            @foreach ($ekstragurus as $ekstraguru)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="ekstra_guru_id[]" value="{{ $ekstraguru->ekstra_guru_id }}" id="ekstra{{ $ekstraguru->ekstra_guru_id }}">
                                    <label class="form-check-label" for="ekstra{{ $ekstraguru->ekstra_guru_id }}">{{ $ekstraguru->ekskul->namaekskul }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg px-5">Daftar</button>
                            <a href="/siswa/ekskul" class="btn btn-danger btn-lg ml-3 px-5">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection --}}
