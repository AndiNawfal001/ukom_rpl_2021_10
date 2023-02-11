<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // public function up()
    // {
    //     DB::unprepared(
    //     "CREATE OR REPLACE VIEW barang_banyak AS (
    //         SELECT
    //         barang_masuk.nama_barang, barang_masuk.jml_masuk, barang_masuk.tgl_masuk, barang_masuk.status_pembelian
    //         FROM barang_masuk
    //         JOIN pengajuan_bb
    //             ON barang_masuk.id_barang_masuk = pengajuan_bb.id_pengajuan_bb
    //     )"
    //     );
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_barang_banyak');
    }
};
