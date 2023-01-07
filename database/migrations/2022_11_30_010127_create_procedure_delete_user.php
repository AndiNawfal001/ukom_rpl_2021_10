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
        DB::unprepared("DROP PROCEDURE IF EXISTS delete_user");
        DB::unprepared(
          "CREATE PROCEDURE delete_user(
                kode INT
            )
            BEGIN
            DECLARE cek_admin INT;
            DECLARE cek_manajemen INT;
            DECLARE cek_kaprog INT;

            SELECT COUNT(id_pengguna) INTO cek_admin FROM admin WHERE id_pengguna = kode;
            SELECT COUNT(id_pengguna) INTO cek_manajemen FROM manajemen WHERE id_pengguna = kode;
            SELECT COUNT(id_pengguna) INTO cek_kaprog FROM kaprog WHERE id_pengguna = kode;


                IF(cek_admin = 1) THEN
                    DELETE FROM pengguna WHERE id_pengguna = kode;
                    DELETE FROM admin WHERE id_pengguna = kode;
                ELSEIF(cek_manajemen = 1) THEN
                    DELETE FROM pengguna WHERE id_pengguna = kode;
                    DELETE FROM manajemen WHERE id_pengguna = kode;
                ELSEIF(cek_kaprog = 1) THEN
                    DELETE FROM pengguna WHERE id_pengguna = kode;
                    DELETE FROM kaprog WHERE id_pengguna = kode;
                END IF;

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
        Schema::dropIfExists('procedure_delete_user');
    }
};
