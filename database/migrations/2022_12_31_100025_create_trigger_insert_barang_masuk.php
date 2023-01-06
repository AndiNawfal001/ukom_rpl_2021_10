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

            DECLARE manajemen VARCHAR(30);
            DECLARE kode CHAR(7);

            SELECT newIdLog() INTO kode;
            SELECT manajemen.nama INTO manajemen FROM manajemen WHERE manajemen.nip = new.manajemen;

            INSERT INTO log (id_log, nama, aktifitas, tgl) VALUES (
                kode, manajemen, 'tambah barang', NOW()
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
