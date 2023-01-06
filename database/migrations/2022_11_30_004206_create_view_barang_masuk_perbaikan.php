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
                detail_barang.kode_barang, detail_barang.spesifikasi, detail_barang.kondisi_barang, detail_barang.status
                FROM detail_barang
                JOIN barang ON detail_barang.id_barang = barang.id_barang
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
