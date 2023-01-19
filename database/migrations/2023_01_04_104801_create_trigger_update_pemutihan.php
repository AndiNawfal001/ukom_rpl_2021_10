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
        DB::unprepared("DROP TRIGGER IF EXISTS update_pemutihan");
        DB::unprepared(
          "CREATE TRIGGER after_update_pemutihan
            AFTER UPDATE
            ON pemutihan
            FOR EACH ROW
            BEGIN

            DECLARE adder VARCHAR(30);
            DECLARE kode CHAR(7);

            SELECT newIdLog() INTO kode;
            SELECT pengguna.username INTO adder FROM pengguna WHERE pengguna.id_pengguna = new.approver;

            IF(new.approve_penonaktifan = 'setuju') THEN
                INSERT INTO log (id_log, username, aktifitas, tgl) VALUES (
                    kode, adder, 'approve pemutihan', NOW()
                );
            ELSE
                INSERT INTO log (id_log, username, aktifitas, tgl) VALUES (
                    kode, adder, 'disapprove pemutihan', NOW()
                );
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
        Schema::dropIfExists('trigger_insert_pemutihan');
    }
};
