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
        DB::unprepared("DROP PROCEDURE IF EXISTS tambah_user");
        DB::unprepared(
          "CREATE PROCEDURE tambah_user(
                username VARCHAR(50),
                levelUser VARCHAR(20),
                email VARCHAR(50),
                password VARCHAR(255),
                nip CHAR(18),
                nama VARCHAR(50),
                kontak VARCHAR(20)
            )
            BEGIN
            DECLARE id_pengguna INT;
            DECLARE level_user VARCHAR(20);
            -- TCL
            DECLARE kodeError CHAR(5) DEFAULT '00000';
            DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
            BEGIN
                GET DIAGNOSTICS CONDITION 1
                kodeError = RETURNED_SQLSTATE;
            END;

            START TRANSACTION;

            SAVEPOINT initial;

            SELECT level_user.id_level INTO level_user FROM level_user WHERE level_user.nama_level = levelUser;

            INSERT INTO pengguna (id_level, username, email, password)
            VALUES (level_user, username, email, password);

            IF kodeError != '00000' THEN
                ROLLBACK TO initial;
            END IF;

            SAVEPOINT insert_child_table;

            SELECT pengguna.id_pengguna INTO id_pengguna FROM pengguna WHERE pengguna.username = username;

                IF(levelUser='admin')THEN

                    INSERT INTO admin (id_pengguna, nama, kontak)
                    VALUES (id_pengguna, nama, kontak);

                ELSEIF(levelUser='manajemen')THEN

                    INSERT INTO manajemen (nip, id_pengguna, nama, kontak)
                    VALUES (nip, id_pengguna, nama, kontak);

                ELSEIF(levelUser='kaprog')THEN

                    INSERT INTO kaprog (nip, id_pengguna, nama, kontak)
                    VALUES (nip, id_pengguna, nama, kontak);

                END IF;

            IF kodeError != '00000' THEN
                ROLLBACK TO insert_child_table;
            END IF;

            COMMIT;

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
        Schema::dropIfExists('procedure_insert_user');
    }
};
