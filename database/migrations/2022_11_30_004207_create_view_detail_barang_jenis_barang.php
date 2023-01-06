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
        DB::unprepared(
            "CREATE OR REPLACE VIEW detail_barang_jenis_barang AS (
              SELECT detail_barang.kode_barang,
                jenis_barang.nama_jenis

                FROM barang
                JOIN detail_barang
                ON barang.id_barang = detail_barang.id_barang
                JOIN jenis_barang
                ON barang.id_jenis_brg = jenis_barang.id_jenis_brg

                ORDER BY detail_barang.kode_barang DESC
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
        Schema::dropIfExists('view_detail_barang_jenis_barang');
    }
};
