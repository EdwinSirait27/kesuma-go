<div class="row" id="hal_edit" style="display: none;">
    <div class="col-md-12 col-sm-12">
        <div class="dashboard_graph">
            <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Edit Data
                <small>Kelas</small>
            </h3>
            <hr>
            <form method="POST" action="/datakelas-update" onsubmit="return simpan()">
                @csrf
                <input type="hidden" name="txt_id" id="txt_id" />
                <div class="form-group row">
                    <label for="tahunakademik_id" class="col-sm-2 col-form-label">Tahun Akademik</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="tahunakademik_id" name="tahunakademik_id" required>
                            <option value="">Pilih Tahun</option>
                            @foreach ($taon as $tahun)
                                <option value="{{ $tahun->tahunakademik_id }}">
                                    {{ $tahun->kurikulum->Nama_Kurikulum }} - {{ $tahun->tahunakademik }}- {{ $tahun->semester }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <label for="kelas_id" class="col-sm-2 col-form-label">Ruang Kelas</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="kelas_id" name="kelas_id" required>
                            <option value="">Pilih Kelas</option>
                            @foreach ($kelass as $kelas)
                                <option value="{{ $kelas->kelas_id }}">{{ $kelas->kelas_id }} - {{ $kelas->namakelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="guru_id" class="col-sm-2 col-form-label">Wali Kelas</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="guru_id" name="guru_id" required>
                            <option value="">Pilih Guru</option>
                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->guru_id }}">{{ $guru->guru_id }} - {{ $guru->Nama }}</option>
                            @endforeach
                        </select>

                    </div>

                    <label for="kapasitas" class="col-sm-2 col-form-label">Kapasitas</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="kapasitas" name="kapasitas"
                            placeholder="Kapasitas" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            placeholder="Keterangan" maxlength="30"required>
                    </div>
                </div>


                <input type="hidden" id="kapasitas_kelas" data-kapasitas="{{ $kelas->kapasitas }}" />

<table id="siswaTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($siswas as $index => $siswa)
            @if (empty($siswa->kelas_id))
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $siswa->NamaLengkap }}</td>
                    <td>
                        @if ($siswa->kelas && $siswa->kelas->datakelas)
                            @if ($siswa->kelas->kapasitas != $siswa->kelas->datakelas->count())
                                <input type="checkbox" class="select-checkbox" name="selected_siswa[]"
                                    value="{{ $siswa->siswa_id }}"
                                    data-kelasid="{{ $siswa->kelas_id }}">
                            @else
                                <input type="checkbox" class="select-checkbox" name="selected_siswa[]"
                                    value="{{ $siswa->siswa_id }}"
                                    data-kelasid="{{ $siswa->kelas_id }}" disabled>
                            @endif
                        @else
                            <!-- Handle jika relasi atau propertinya null -->
                            <input type="checkbox" class="select-checkbox" name="selected_siswa[]"
                                value="{{ $siswa->siswa_id }}" data-kelasid="{{ $siswa->kelas_id }}"
                                disabled>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
    </table>
    <input type="hidden" name="selected_siswa" id="selected_siswa" value="">
    <script>
        $(document).ready(function() {
            var table = $('#siswaTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "Semua"]
                ]
            });
    
            $('.dataTables_length select option[value="-1"]').text('Semua');
            $('.dataTables_length select').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue == 'Semua') {
                    table.page.len(-1).draw();
                } else {
                    table.page.len(selectedValue).draw();
                }
            });
    
            $('#siswaTable tbody').on('change', '.select-checkbox', function() {
                if (!this.checked) {
                    $('#select-all').prop('checked', false);
                } else {
                    var allChecked = $('.select-checkbox:checked').length === $('.select-checkbox').length;
                    $('#select-all').prop('checked', allChecked);
                }
                updateSelectedSiswa(this);
            });
    
            // Pemanggilan updateSelectedSiswa saat halaman pertama kali dimuat
            updateSelectedSiswa();
    
            // Pemanggilan displaySelectedNames saat halaman pertama kali dimuat
            displaySelectedNames();
        });
    
        function updateSelectedSiswa(checkbox) {
            var selectedSiswa = [];
            $('.select-checkbox:checked').each(function() {
                selectedSiswa.push($(this).val());
            });
            $('#selected_siswa').val(selectedSiswa.join(','));
    
            // Pemanggilan displaySelectedNames saat checkbox diubah
            displaySelectedNames();
    
            // Pemanggilan checkKapasitasKelas setiap kali checkbox diubah
            checkKapasitasKelas();
        }
    
        function displaySelectedNames() {
            var selectedNames = [];
            var totalSelected = 0;
            $('.select-checkbox:checked').each(function() {
                var rowIndex = $(this).closest('tr').index();
                var name = $('#siswaTable').DataTable().cell(rowIndex, 1).data();
                selectedNames.push(name);
                totalSelected++;
            });
            $('#selectedNames').html('<strong>Nama yang dicentang:</strong><br>' + selectedNames.join('<br>'));
            $('#totalSelected').text('Total Siswa yang Dicentang: ' + totalSelected);
        }
    
        function submitForm() {
            // Update kembali selected siswa sebelum submit form
            updateSelectedSiswa();
        }
    
        function checkKapasitasKelas() {
            var checkboxes = $('.select-checkbox');
            var maxCapacity = parseInt($('#kapasitas_kelas').data('kelas.kapasitas'));
            var selectedCount = $('.select-checkbox:checked').length;
    
            checkboxes.prop('disabled', false);
    
            checkboxes.each(function() {
                if (selectedCount >= maxCapacity && !$(this).is(':checked')) {
                    $(this).prop('disabled', true);
                }
            });
        }
    </script>
    

                <div class="form-group row">
                    <div class="col-sm-10">
                        <div id="kapasitas_kelas" data-kapasitas="{{ $kapasitas_kelas }}"></div>
                        <script>
                            $(document).ready(function() {
                                var kapasitasKelas = $('#kapasitas_kelas').data('kapasitas');
                                console.log('Kapasitas Kelas:', kapasitasKelas);
                            });
                        </script>



                        <div id="selectedNames" style="margin-top: 10px;"></div>
                        <div id="totalSelected" style="margin-top: 10px;"></div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                       
                       
                        <button type="button" onclick="window.location.href = '/datakelasadmin'"
                        class="btn btn-danger">Kembali</button>
                        
                    </div>
                </div>
            </form>
        </div>
        <br>
        <br>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="dashboard_graph">
                    <h3><i class="fa fa-bar-chart" style="margin-right: 10px; margin-top: 15px;"></i>Siswa Terdaftar
                        dalam Kelas
                        <small></small>
                    </h3>
                    <hr>

                    <table id="siswaTerdaftarTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>NamaKelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswas as $index => $siswa)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $siswa->NamaLengkap }}</td>
                                    <td>{{ $siswa->kelas ? $siswa->kelas->namakelas : 'Tidak terkait dengan kelas' }}
                                    </td>


                                    <td>
                                        <input type="checkbox" class="select-checkboxx" name="selected_siswa[]"
                                            value="{{ $siswa->siswa_id }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-danger" onclick="deleteSelected()">Hapus Terpilih</button>
                    <button type="button" class="btn btn-primary" onclick="toggleSelectAll()">Select All</button>
                    <script>
                        function toggleSelectAll() {
                            var checkboxes = $('.select-checkboxx');
                            var checked = checkboxes.length > 0 && checkboxes.length === checkboxes.filter(':checked').length;

                            checkboxes.prop('checked', !checked);
                        }
                    </script>

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#siswaTerdaftarTable').DataTable({
                    "lengthMenu": [10, 25, 50, 100, -1], // -1 artinya "Semua"
                    "pageLength": 10 // Jumlah entri yang ditampilkan per halaman secara default
                });
            });

            function deleteSelected() {
                var selectedSiswa = $('.select-checkboxx:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedSiswa.length > 0) {
                    // Tampilkan SweetAlert konfirmasi sebelum menghapus
                    Swal.fire({
                        title: 'Konfirmasi Penghapusan',
                        text: 'Apakah Anda yakin ingin menghapus siswa dan kelas terpilih?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: '/remove-kelas-from-siswa',
                                data: {
                                    '_token': '{{ csrf_token() }}',
                                    'siswa_id': selectedSiswa
                                },
                                success: function(data) {
                                    // Tampilkan SweetAlert sukses setelah penghapusan
                                    Swal.fire('Berhasil!', 'Siswa dan kelas berhasil dihapus.', 'success');
                                    // Perbarui DataTable dengan mengirim perintah draw
                                    $('#siswaTerdaftarTable').DataTable().draw(false);
                                    // Reload halaman setelah 2 detik
                                    setTimeout(function() {
                                        location.reload();
                                    }, 1000);
                                },
                                error: function(data) {
                                    // Tampilkan SweetAlert error jika terjadi kesalahan
                                    Swal.fire('Gagal!', 'Terjadi kesalahan dalam penghapusan.', 'error');
                                    console.log('Error:', data);
                                }
                            });
                        }
                    });
                } else {
                    // Tampilkan SweetAlert peringatan jika tidak ada siswa yang dipilih
                    Swal.fire('Peringatan!', 'Pilih setidaknya satu siswa untuk dihapus.', 'warning');
                }
            }
        </script>

    </div>
</div>

<br>    
