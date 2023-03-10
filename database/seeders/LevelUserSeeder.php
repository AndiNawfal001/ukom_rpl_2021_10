<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LevelUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leveluser = collect([
            [

                'id_level' => 'U01',
                'nama_level' => 'admin',
                'ket' => 'ini admin',

            ],
            [

                'id_level' => 'U02',
                'nama_level' => 'manajemen',
                'ket' => 'ini manajemen',

            ],
            [

                'id_level' => 'U03',
                'nama_level' => 'kaprog',
                'ket' => 'ini kaprog',

            ]
        ]);
        $leveluser->each(fn ($lu) => DB::table('level_user')->insert($lu));
    }
}
