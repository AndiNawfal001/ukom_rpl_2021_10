<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ruangan = collect([
            [
                'id_ruangan' => 'RGN001',
                'nama_ruangan' => 'D1',
                'penanggung_jawab' => 'Km nya',
                'ket' => 'Butuh Meja',

            ],
            [
                'id_ruangan' => 'RGN002',
                'nama_ruangan' => 'D2',
                'penanggung_jawab' => 'Km nya',
                'ket' => 'Butuh Meja',

            ],
            [
                'id_ruangan' => 'RGN003',
                'nama_ruangan' => 'D3',
                'penanggung_jawab' => 'Km nya',
                'ket' => 'Butuh Meja',

            ],
            [
                'id_ruangan' => 'RGN004',
                'nama_ruangan' => 'D4',
                'penanggung_jawab' => 'Km nya',
                'ket' => 'Butuh Meja',

            ],
            [
                'id_ruangan' => 'RGN005',
                'nama_ruangan' => 'D5',
                'penanggung_jawab' => 'Km nya',
                'ket' => 'Butuh Meja',

            ],

        ]);
        $ruangan->each(fn ($r) => DB::table('ruangan')->insert($r));
    }
}
