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
        // DB::unprepared("DROP TRIGGER IF EXISTS update_perbaikan");
        // DB::unprepared(
        //   "CREATE TRIGGER after_update_perbaikan
        //     AFTER UPDATE
        //     ON perbaikan
        //     FOR EACH ROW
        //     BEGIN
        //     DECLARE manajemen VARCHAR(30);
        //     DECLARE kode CHAR(7);

        //     SELECT newIdLog() INTO kode;
        //     SELECT manajemen.nama INTO manajemen FROM manajemen WHERE manajemen.nip = new.manajemen;

        //     IF (new.tgl_approve IS NOT NULL) THEN
        //         IF(new.approve_perbaikan = 'sudah diperbaiki') THEN
        //             INSERT INTO log (id_log, username, aktifitas, tgl) VALUES (
        //                 kode, manajemen, 'barang diperbaiki', NOW()
        //             );
        //         ELSEIF(new.approve_perbaikan = 'rusak')THEN
        //             INSERT INTO log (id_log, username, aktifitas, tgl) VALUES (
        //                 kode, manajemen, 'barang rusak', NOW()
        //             );
        //         END IF;
        //     END IF;

        //     END;"
        // );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trigger_update_perbaikan');
    }
};
