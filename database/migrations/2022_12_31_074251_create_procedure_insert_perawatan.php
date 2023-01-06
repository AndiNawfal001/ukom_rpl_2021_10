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
        DB::unprepared("DROP PROCEDURE IF EXISTS tambah_perawatan");
        DB::unprepared(
          "CREATE PROCEDURE tambah_perawatan(
                id_perawatan CHAR(6),
                kode_barang VARCHAR(30),
                nama_pelaksana VARCHAR(255),
                ket_perawatan TEXT,
                foto_perawatan VARCHAR(255)
            )
            BEGIN
            INSERT INTO perawatan
            (id_perawatan, kode_barang, nama_pelaksana, ket_perawatan, tgl_perawatan, foto_perawatan)
            VALUES(
                id_perawatan, kode_barang, nama_pelaksana, ket_perawatan, NOW(), foto_perawatan
            );

          END;"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procedure_insert_perawatan');
    }
};
