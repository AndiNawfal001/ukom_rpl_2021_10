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
        DB::unprepared("DROP PROCEDURE IF EXISTS update_user");
        DB::unprepared(
          "CREATE PROCEDURE update_user(
                kode INT,
                username VARCHAR(30),
                email VARCHAR(30),
                nama VARCHAR(255),
                kontak VARCHAR(255)
            )
            BEGIN
            DECLARE cek_admin INT;
            DECLARE cek_manajemen INT;
            DECLARE cek_kaprog INT;

            SELECT COUNT(id_pengguna) INTO cek_admin FROM admin WHERE id_pengguna = kode;
            SELECT COUNT(id_pengguna) INTO cek_manajemen FROM manajemen WHERE id_pengguna = kode;
            SELECT COUNT(id_pengguna) INTO cek_kaprog FROM kaprog WHERE id_pengguna = kode;


                IF(cek_admin = 1) THEN
                    UPDATE pengguna SET pengguna.username = username, pengguna.email = email WHERE id_pengguna = kode;
                    UPDATE admin SET nama = nama, kontak = kontak WHERE id_pengguna = kode;
                ELSEIF(cek_manajemen = 1) THEN
                    UPDATE pengguna SET pengguna.username = username, pengguna.email = email WHERE id_pengguna = kode;
                    UPDATE manajemen SET nama = nama, kontak = kontak WHERE id_pengguna = id_pengguna;
                ELSEIF(cek_kaprog = 1) THEN
                    UPDATE pengguna SET pengguna.username = username, pengguna.email = email WHERE id_pengguna = kode;
                    UPDATE kaprog SET nama = nama, kontak = kontak WHERE id_pengguna = id_pengguna;
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
        Schema::dropIfExists('procedure_update_user');
    }
};
