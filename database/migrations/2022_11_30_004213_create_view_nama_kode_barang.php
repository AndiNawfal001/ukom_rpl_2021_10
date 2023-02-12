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
        // VIEW GABUNGAN BARANG DAN KODE BARANG
        // UNTUK TABLE YANG MENGAKSES KODE BARANG TAPI TIDAK MEMLIKI ID BARANG
        DB::unprepared(
        "CREATE OR REPLACE VIEW nama_kode_barang AS (
            SELECT
            barang.nama_barang, detail_barang.kode_barang
            FROM barang
            JOIN detail_barang
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
        Schema::dropIfExists('view_nama_kode_barang');
    }
};
