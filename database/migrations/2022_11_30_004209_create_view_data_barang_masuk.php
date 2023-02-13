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
        // VIEW UNTUK HISTORY BARANG MASUK YANG MENAMPILKAN PROGRESS
        DB::unprepared(
            "CREATE OR REPLACE VIEW data_barang_masuk AS (
                SELECT DISTINCT pengajuan_bb.id_pengajuan_bb, pengajuan_bb.nama_barang,(SELECT SUM(barang_masuk.jml_masuk) FROM barang_masuk WHERE barang_masuk.id_pengajuan = pengajuan_bb.id_pengajuan_bb) AS progress, pengajuan_bb.jumlah AS target
                FROM pengajuan_bb
                RIGHT JOIN barang_masuk
                ON pengajuan_bb.id_pengajuan_bb = barang_masuk.id_pengajuan
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
        Schema::dropIfExists('view_data_barang_masuk');
    }
};
