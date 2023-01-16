<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisBarang = collect([
            [
                'id_jenis_brg' => 'JB001',
                'nama_jenis' => 'Elektronik'
            ],
            [
                'id_jenis_brg' => 'JB002',
                'nama_jenis' => 'Furniture'
            ],
            [
                'id_jenis_brg' => 'JB003',
                'nama_jenis' => 'Alat Tulis'
            ],

        ]);
        $jenisBarang->each(fn ($jb) => DB::table('jenis_barang')->insert($jb));
    }
}
