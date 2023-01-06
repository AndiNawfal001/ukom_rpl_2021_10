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
        DB::unprepared("DROP PROCEDURE IF EXISTS tambah_ruangan");
        DB::unprepared(
          "CREATE PROCEDURE tambah_ruangan(
                id_ruangan CHAR(6),
                nama_ruangan VARCHAR(50),
                penanggung_jawab VARCHAR(50),
                ket TEXT,
                image VARCHAR(255)
            )
            BEGIN
            INSERT INTO ruangan
            (id_ruangan, nama_ruangan, penanggung_jawab, ket, image)
            VALUES(id_ruangan, nama_ruangan, penanggung_jawab, ket, image);

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
        Schema::dropIfExists('procedure_insert_ruangan');
    }
};
