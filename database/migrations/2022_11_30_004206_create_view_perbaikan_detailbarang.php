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
        // VIEW UNTUK HALAMAN PERBAIKAN INDEX
        DB::unprepared(
            "CREATE OR REPLACE VIEW perbaikan_detailbarang AS (
             SELECT detail_barang.*,
                perbaikan.id_perbaikan, perbaikan.tgl_perbaikan, perbaikan.tgl_selesai_perbaikan, perbaikan.approve_perbaikan,perbaikan.nama_teknisi, perbaikan.keluhan, perbaikan.penyebab_keluhan, perbaikan.status_perbaikan, perbaikan.submitter,
                ruangan.nama_ruangan,
                barang.nama_barang
                FROM perbaikan
                LEFT JOIN detail_barang
                ON perbaikan.kode_barang = detail_barang.kode_barang
                LEFT JOIN barang
                ON detail_barang.id_barang = barang.id_barang
                LEFT JOIN ruangan
                ON detail_barang.ruangan = ruangan.id_ruangan
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
