@extends('index')
@section('title', 'Kesuma-GO | Lupa Password')
@section('content')
    <table id="myTable">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Usia</th>
                <th>Kota</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John Doe</td>
                <td>25</td>
                <td>New York</td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td>30</td>
                <td>London</td>
            </tr>
            <!-- Tambahkan baris data lainnya sesuai kebutuhan -->
        </tbody>
    </table>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
