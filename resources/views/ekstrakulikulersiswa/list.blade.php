@extends('index')

@section('title', 'Kesuma-GO | Data Ekstrakurikuler')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="mb-0">List Ekstrakurikuler</h3>
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
                        <h6 class="text-danger">Anda hanya dapat memilih maksimal 3 ekstrakurikuler.</h6>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success btn-lg px-5">Daftar</button>
                            <a href="/ekstrakulikulersiswa" class="btn btn-danger btn-lg px-5">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', (e) => {
                if (document.querySelectorAll('input[type="checkbox"]:checked').length > 3) {
                    e.target.checked = false;
                    alert('Anda hanya dapat memilih maksimal 3 ekstrakulikuler.');
                }
            });
        });
    });
</script>

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

@endsection --}}
