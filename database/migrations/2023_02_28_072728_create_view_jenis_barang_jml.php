<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // VIEW UNTUK HALAMAN BARANG MASUK BAGIAN JENIS BARANG
        // UNTUK MENGHITUNG JUMLAH BARANG PADA JENIS BARANG TERTENTU
        DB::unprepared(
            "CREATE OR REPLACE VIEW jenis_barang_jml AS (
             SELECT DISTINCT jenis_barang.*, (SELECT SUM(barang.jml_barang) FROM barang WHERE barang.id_jenis_brg = jenis_barang.id_jenis_brg) as jml_barang
                FROM jenis_barang
                LEFT JOIN barang
                ON jenis_barang.id_jenis_brg = barang.id_jenis_brg
            )"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_jenis_barang_jml');
    }
};
