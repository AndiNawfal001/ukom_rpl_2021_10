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
        DB::unprepared("DROP PROCEDURE IF EXISTS tambah_pemutihan_langsung");
        DB::unprepared(
          "CREATE PROCEDURE tambah_pemutihan_langsung(
                kode_barang VARCHAR(30),
                kaprog VARCHAR(255),
                ket_pemutihan TEXT
            )
            BEGIN
            INSERT INTO pemutihan
            (kode_barang, kaprog, tgl_pemutihan, ket_pemutihan)
            VALUES(
                kode_barang, kaprog, NOW(), ket_pemutihan
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
        Schema::dropIfExists('procedure_insert_pemutihan_langsung');
    }
};
