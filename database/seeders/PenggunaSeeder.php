<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = collect([
            [
                'id_level' => 'U01',
                'username' => 'joe',
                'email' => 'joe@gmail.com',
                'password' => Hash::make('joe')
            ],
            [
                'id_level' => 'U01',
                'username' => 'andi',
                'email' => 'andi@gmail.com',
                'password' => Hash::make('andi')
            ],
            [
                'id_level' => 'U02',
                'username' => 'afkar',
                'email' => 'aflar@gmail.com',
                'password' => Hash::make('afkar')
            ],
            [
                'id_level' => 'U03',
                'username' => 'andika',
                'email' => 'dikar@gmail.com',
                'password' => Hash::make('dika')
            ]
        ]);
        $users->each(fn ($user) => DB::table('pengguna')->insert($user));
    }
}
