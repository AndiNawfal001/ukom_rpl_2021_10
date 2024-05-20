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
                'nama' => 'PT Teknologi Canggih',
                'kontak' => '0811-123-4567',
                'alamat' => 'Jakarta',
            ],
            [
                'id_supplier' => 'SPR002',
                'nama' => 'PT Mega Gadgets',
                'kontak' => '0822-987-6543',
                'alamat' => 'Surabaya',
            ],
            [
                'id_supplier' => 'SPR003',
                'nama' => 'PT Inovasi Digital',
                'kontak' => '0833-456-7890',
                'alamat' => 'Bandung',
            ],
            [
                'id_supplier' => 'SPR004',
                'nama' => 'PT FutureTech Solutions',
                'kontak' => '0856-321-0987',
                'alamat' => 'Yogyakarta',
            ],
            [
                'id_supplier' => 'SPR005',
                'nama' => 'PT Quantum Electronics',
                'kontak' => '0877-765-4321',
                'alamat' => 'Semarang',
            ],
            [
                'id_supplier' => 'SPR006',
                'nama' => 'PT Infinity Innovations',
                'kontak' => '0888-210-9876',
                'alamat' => 'Makassar',
            ],
            [
                'id_supplier' => 'SPR007',
                'nama' => 'PT Visionary Ventures',
                'kontak' => '0899-678-5432',
                'alamat' => 'Bali',
            ],
            [
                'id_supplier' => 'SPR008',
                'nama' => 'PT Tech Titans',
                'kontak' => '0812-345-6789',
                'alamat' => 'Medan',
            ],
            [
                'id_supplier' => 'SPR009',
                'nama' => 'PT Smart Solutions',
                'kontak' => '0821-987-6543',
                'alamat' => 'Palembang',
            ],
            [
                'id_supplier' => 'SPR010',
                'nama' => 'PT Digital Dreamers',
                'kontak' => '0832-654-0987',
                'alamat' => 'Balikpapan',
            ],
            [
                'id_supplier' => 'SPR011',
                'nama' => 'PT E-Revolution',
                'kontak' => '0813-210-9876',
                'alamat' => 'Pontianak',
            ],
            [
                'id_supplier' => 'SPR012',
                'nama' => 'PT Gadget Galore',
                'kontak' => '0824-567-8901',
                'alamat' => 'Malang',
            ],
            [
                'id_supplier' => 'SPR013',
                'nama' => 'PT Tech Wizards',
                'kontak' => '0835-678-9012',
                'alamat' => 'Bandar Lampung',
            ],
            [
                'id_supplier' => 'SPR014',
                'nama' => 'PT Digital Dynamics',
                'kontak' => '0857-890-1234',
                'alamat' => 'Padang',
            ],
            [
                'id_supplier' => 'SPR015',
                'nama' => 'PT Cyber Creations',
                'kontak' => '0876-543-2109',
                'alamat' => 'Pekanbaru',
            ],
            [
                'id_supplier' => 'SPR016',
                'nama' => 'PT Hi-Tech Hub',
                'kontak' => '0887-654-3210',
                'alamat' => 'Banten',
            ],
            [
                'id_supplier' => 'SPR017',
                'nama' => 'PT Digital Divas',
                'kontak' => '0898-765-4321',
                'alamat' => 'Tangerang',
            ],
            [
                'id_supplier' => 'SPR018',
                'nama' => 'PT Tech Titans',
                'kontak' => '0815-876-5432',
                'alamat' => 'Depok',
            ],
            [
                'id_supplier' => 'SPR019',
                'nama' => 'PT Digital Dynamos',
                'kontak' => '0826-543-2109',
                'alamat' => 'Batam',
            ],
            [
                'id_supplier' => 'SPR020',
                'nama' => 'PT Cyber Systems',
                'kontak' => '0837-876-5432',
                'alamat' => 'Manado',
            ],
        ]);
        
        $supplier->each(fn ($s) => DB::table('supplier')->insert($s));
    }
}
