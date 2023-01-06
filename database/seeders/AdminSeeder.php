<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin = collect([
            [

                'id_admin' => 1,
                'id_pengguna' => 1,
                'nama' => 'Joe Sozanolo',
                'kontak' => '0867-1234-2323',

            ],
            [

                'id_admin' => 2,
                'id_pengguna' => 2,
                'nama' => 'Andi Nawfal',
                'kontak' => '0867-1234-2323',

            ]
        ]);
        $admin->each(fn ($a) => DB::table('admin')->insert($a));
    }
}
