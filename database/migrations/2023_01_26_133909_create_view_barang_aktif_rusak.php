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
        "CREATE OR REPLACE VIEW barang_aktif_rusak AS (
            SELECT DISTINCT
            barang.*,
            jenis_barang.nama_jenis,
            (select count(detail_barang.kondisi_barang) from detail_barang where detail_barang.kondisi_barang = 'rusak' AND detail_barang.id_barang = barang.id_barang) as barang_rusak,
            (select count(detail_barang.status) from detail_barang where detail_barang.status = 'nonaktif' AND detail_barang.id_barang = barang.id_barang) as barang_nonaktif
            FROM barang
            LEFT JOIN jenis_barang
            ON barang.id_jenis_brg = jenis_barang.id_jenis_brg
            LEFT JOIN detail_barang
            ON barang.id_barang = detail_barang.id_barang
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
        Schema::dropIfExists('view_barang_aktif_rusak');
    }
};
