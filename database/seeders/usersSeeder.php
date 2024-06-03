<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\user; // Sesuaikan dengan model Anda

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ambil data dari tabel MySQL menggunakan koneksi langsung ke MySQL
        $dataMySQL = DB::connection('mysql')->select('select * from nama_tabel');

        // Looping data dan masukkan ke dalam tabel baru di Laravel
        foreach ($dataMySQL as $data) {
            user::create([
                'kolom_1' => $data->kolom_1,
                'kolom_2' => $data->kolom_2,
                // Sesuaikan kolom dengan struktur model Anda
            ]);
        }
    }
}
