<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LevelUserSeeder::class,
            PenggunaSeeder::class,
            SupplierSeeder::class,
            JenisBarangSeeder::class,
            ManajemenSeeder::class,
            AdminSeeder::class,
            KaprogSeeder::class,
            RuanganSeeder::class,
            // PengajuanBBSeeder::class,

        ]);
    }
}
