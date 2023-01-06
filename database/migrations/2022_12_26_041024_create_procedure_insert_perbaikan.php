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
        DB::unprepared("DROP PROCEDURE IF EXISTS tambah_perbaikan");
        DB::unprepared(
          "CREATE PROCEDURE tambah_perbaikan(
                id_perbaikan CHAR(6),
                kode_barang VARCHAR(30),
                manajemen VARCHAR(255),
                kaprog VARCHAR(255),
                ruangan VARCHAR(255),
                keluhan TEXT
            )
            BEGIN
            INSERT INTO perbaikan
            (id_perbaikan, kode_barang, manajemen, kaprog, ruangan, tgl_perbaikan, keluhan)
            VALUES(
                id_perbaikan, kode_barang, manajemen, kaprog, ruangan, NOW(), keluhan
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
        Schema::dropIfExists('procedure_insert_tambah_pengajuan_pb_perbaikan');
    }
};
