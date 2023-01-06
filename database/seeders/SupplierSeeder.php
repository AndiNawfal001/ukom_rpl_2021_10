<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplier = collect([
            [
                'id_supplier' => 'SPR001',
                'nama' => 'PT Laptop Bersama',
                'kontak' => '0856',
                'alamat' => 'Bekasi',

            ],
            [

                'id_supplier' => 'SPR002',
                'nama' => 'PT Headset Bersama',
                'kontak' => '0857',
                'alamat' => 'Bandung',

            ],
            [

                'id_supplier' => 'SPR003',
                'nama' => 'PT Mouse Bersama',
                'kontak' => '0858',
                'alamat' => 'Bogor',

            ],

        ]);
        $supplier->each(fn ($s) => DB::table('supplier')->insert($s));
    }
}
