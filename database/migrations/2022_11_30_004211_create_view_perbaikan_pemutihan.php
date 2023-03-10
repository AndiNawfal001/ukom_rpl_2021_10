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
        // VIEW UNTUK HALAMAN PEMUTIHAN PILIH BARANG
        DB::unprepared(
            "CREATE OR REPLACE VIEW perbaikan_pemutihan AS (
             SELECT perbaikan.id_perbaikan, perbaikan.kode_barang AS asli, perbaikan.tgl_selesai_perbaikan, perbaikan.status_perbaikan, perbaikan.approve_perbaikan, perbaikan.submitter,
                pemutihan.kode_barang
                FROM pemutihan
                RIGHT JOIN perbaikan
                ON pemutihan.id_perbaikan = perbaikan.id_perbaikan
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
        Schema::dropIfExists('view_perbaikan_pemutihan');
    }
};
