<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class KaprogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kaprog = collect([
            [

                'nip' => '123456789153456789',
                'id_pengguna' => 4,
                'nama' => 'Andika Syabani',
                'kontak' => '0868-1934-5321',

            ],
        ]);
        $kaprog->each(fn ($k) => DB::table('kaprog')->insert($k));
    }
}
