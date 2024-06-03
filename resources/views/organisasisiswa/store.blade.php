<form action="{{ route('ekstrakulikulersiswa.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="ekstra_guru_id">Pilih Ekstrakurikuler:</label>
        <select name="ekstra_guru_id" class="form-control">
            <option value="">Pilih Ekstrakurikuler</option>
            @foreach ($ekstrakurikulers as $ekstrakurikuler)
                <option value="{{ $ekstrakurikuler->id }}">{{ $ekstrakurikuler->nama_ekstrakurikuler }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Daftar</button>

</form>
