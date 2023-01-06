<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ManajemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manajemen = collect([
            [

                'nip' => '123456789123456789',
                'id_pengguna' => 3,
                'nama' => 'Muhammad Afkar',
                'kontak' => '0867-1234-4321',

            ],
        ]);
        $manajemen->each(fn ($m) => DB::table('manajemen')->insert($m));
    }
}
