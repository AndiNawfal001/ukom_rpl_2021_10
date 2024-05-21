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
                'nama_ruangan' => 'Executive Boardroom',
                'penanggung_jawab' => 'Supervisor',
                'ket' => 'Butuh Kursi dan Meja Rapat',
            ],
            [
                'id_ruangan' => 'RGN002',
                'nama_ruangan' => 'Innovation Lab',
                'penanggung_jawab' => 'Coordinator',
                'ket' => 'Butuh Peralatan Percobaan',
            ],
            [
                'id_ruangan' => 'RGN003',
                'nama_ruangan' => 'Design Studio',
                'penanggung_jawab' => 'Art Director',
                'ket' => 'Butuh Peralatan Desain',
            ],
            [
                'id_ruangan' => 'RGN004',
                'nama_ruangan' => 'Relaxation Lounge',
                'penanggung_jawab' => 'Wellness Manager',
                'ket' => 'Butuh Kursi Santai dan Meja Kecil',
            ],
            [
                'id_ruangan' => 'RGN005',
                'nama_ruangan' => 'Training Center',
                'penanggung_jawab' => 'Training Coordinator',
                'ket' => 'Butuh Meja dan Proyektor',
            ],
            [
                'id_ruangan' => 'RGN006',
                'nama_ruangan' => 'Creative Workshop Space',
                'penanggung_jawab' => 'Facilities Manager',
                'ket' => 'Butuh Whiteboard dan Flipchart',
            ],
            [
                'id_ruangan' => 'RGN007',
                'nama_ruangan' => 'Executive Suite',
                'penanggung_jawab' => 'Petugas Kebersihan',
                'ket' => 'Butuh Alat Pembersih',
            ],
            [
                'id_ruangan' => 'RGN008',
                'nama_ruangan' => 'Innovation Hub',
                'penanggung_jawab' => 'Teknisi Listrik',
                'ket' => 'Butuh Perbaikan Listrik',
            ],
            [
                'id_ruangan' => 'RGN009',
                'nama_ruangan' => 'Relaxation Zone',
                'penanggung_jawab' => 'Petugas Keamanan',
                'ket' => 'Butuh Penjagaan Tambahan',
            ],
            [
                'id_ruangan' => 'RGN010',
                'nama_ruangan' => 'Workspace 3.0',
                'penanggung_jawab' => 'Petugas Administrasi',
                'ket' => 'Butuh Peralatan Kantor',
            ],
            [
                'id_ruangan' => 'RGN011',
                'nama_ruangan' => 'Training Room A',
                'penanggung_jawab' => 'Training Coordinator',
                'ket' => 'Butuh Meja dan Kursi Pelatihan',
            ],
            [
                'id_ruangan' => 'RGN012',
                'nama_ruangan' => 'Meeting Room B',
                'penanggung_jawab' => 'HR Coordinator',
                'ket' => 'Butuh Proyektor dan Layar',
            ],
            [
                'id_ruangan' => 'RGN013',
                'nama_ruangan' => 'Lounge Area',
                'penanggung_jawab' => 'Facilities Manager',
                'ket' => 'Butuh Sofa dan Meja Kecil',
            ],
            [
                'id_ruangan' => 'RGN014',
                'nama_ruangan' => 'Cafeteria',
                'penanggung_jawab' => 'Catering Manager',
                'ket' => 'Butuh Peralatan Masak dan Penyajian Makanan',
            ],
            [
                'id_ruangan' => 'RGN015',
                'nama_ruangan' => 'Fitness Center',
                'penanggung_jawab' => 'Fitness Instructor',
                'ket' => 'Butuh Perangkat Fitness dan Alat Penimbang',
            ],
        ]); 
        
        $ruangan->each(fn ($r) => DB::table('ruangan')->insert($r));
    }
}
