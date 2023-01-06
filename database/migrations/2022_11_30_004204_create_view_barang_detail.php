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
            "CREATE OR REPLACE VIEW barang_detail AS (
                SELECT
                barang.id_barang, barang.nama_barang,
                detail_barang.kode_barang, detail_barang.spesifikasi

                FROM barang
                JOIN detail_barang
                    ON barang.id_barang = detail_barang.kode_barang

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
        Schema::dropIfExists('view_barang_detail');
    }
};
