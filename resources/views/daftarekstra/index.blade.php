@extends('index')

@section('title', 'Kesuma-GO | Data Ekstrakurikuler')

@section('content')
    <div class="container">
        <h2>Daftar Ekstrakurikuler</h2>

        {{-- Form Pendaftaran Siswa --}}
        <form action="{{ route('daftarekstra.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="ekstra_guru_id">Pilih Ekstrakurikuler:</label>
                <select name="ekstra_guru_id" class="form-control">
                    {{-- Tampilkan opsi ekstrakurikuler --}}
                    @foreach ($ekstragurus as $ekstraguru)
                        <option value="{{ $ekstraguru->id }}">{{ $ekstraguru->nama_ekskul }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user_id">Pilih Siswa:</label>
                <select name="user_id" class="form-control">
                    {{-- Tampilkan opsi siswa --}}
                    @foreach ($siswas as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama_siswa }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>

        {{-- Tampilan Ekstrakurikuler dan Siswa yang Terdaftar --}}
        {{-- Sesuaikan dengan tampilan yang Anda inginkan --}}

        <h3>Ekstrakurikuler dan Siswa yang Terdaftar</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Ekstrakurikuler</th>
                    <th>Siswa Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ekstragurus as $ekstraguru)
                    <tr>
                        <td>{{ $ekstraguru->nama_ekskul }}</td>
                        <td>
                            @foreach ($ekstraguru->listakunsiswa as $siswa)
                                {{ $siswa->nama_siswa }}<br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
