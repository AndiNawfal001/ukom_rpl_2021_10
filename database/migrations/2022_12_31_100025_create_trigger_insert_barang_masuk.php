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
        DB::unprepared("DROP TRIGGER IF EXISTS insert_barang_masuk");
        DB::unprepared(
          "CREATE TRIGGER after_insert_barang_masuk
            AFTER INSERT
            ON barang_masuk
            FOR EACH ROW
            BEGIN

            DECLARE adder VARCHAR(50);
            DECLARE kode CHAR(7);

            SELECT newIdLog() INTO kode;
            SELECT pengguna.username INTO adder FROM pengguna WHERE pengguna.id_pengguna = new.adder;

            INSERT INTO log (id_log, username, aktifitas, tgl) VALUES (
                kode, adder, 'tambah barang', NOW()
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
        Schema::dropIfExists('trigger_insert_barang_masuk');
    }
};
