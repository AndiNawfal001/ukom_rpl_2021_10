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
        // DB::unprepared(
        //   "CREATE PROCEDURE tambah_pemutihan(
        //         id_perbaikan CHAR(6),
        //         kode_barang VARCHAR(30),
        //         submitter VARCHAR(255),
        //         ket_pemutihan TEXT
        //     )
        //     BEGIN
        //     DECLARE submitter_id VARCHAR(18);

        //     SELECT pengguna.id_pengguna INTO submitter_id FROM pengguna WHERE pengguna.username = submitter;

        //     -- IF (id_perbaikan IS NULL) THEN
        //     --     INSERT INTO pemutihan
        //     --     (kode_barang, submitter, tgl_pemutihan, ket_pemutihan)
        //     --     VALUES(
        //     --         kode_barang, submitter_id, NOW(), ket_pemutihan
        //     --     );
        //     -- END IF;

        //     INSERT INTO pemutihan
        //     (id_perbaikan, kode_barang, submitter, tgl_pemutihan, ket_pemutihan)
        //     VALUES(
        //         id_perbaikan, kode_barang, submitter_id, NOW(), ket_pemutihan
        //     );

        //   END;"
        // );
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
