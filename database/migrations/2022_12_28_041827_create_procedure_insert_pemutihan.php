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
        DB::unprepared("DROP PROCEDURE IF EXISTS tambah_pemutihan");
        DB::unprepared(
          "CREATE PROCEDURE tambah_pemutihan(
                id_perbaikan CHAR(6),
                kode_barang VARCHAR(30),
                kaprog VARCHAR(255),
                ket_pemutihan TEXT
            )
            BEGIN
            INSERT INTO pemutihan
            (id_perbaikan, kode_barang, kaprog, tgl_pemutihan, ket_pemutihan)
            VALUES(
                id_perbaikan, kode_barang, kaprog, NOW(), ket_pemutihan
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
        Schema::dropIfExists('procedure_insert_pemutihan');
    }
};
