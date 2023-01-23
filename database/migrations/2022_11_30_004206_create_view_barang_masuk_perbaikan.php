<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            "CREATE OR REPLACE VIEW barang_masuk_perbaikan AS (
             SELECT
                barang.nama_barang,
                detail_barang.kode_barang AS asli, detail_barang.spesifikasi, detail_barang.kondisi_barang, detail_barang.status, perbaikan.*
                FROM detail_barang
                LEFT JOIN perbaikan ON detail_barang.kode_barang = perbaikan.kode_barang
                LEFT JOIN barang ON detail_barang.id_barang = barang.id_barang
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
        Schema::dropIfExists('view_barang_masuk_perbaikan');
    }
};
