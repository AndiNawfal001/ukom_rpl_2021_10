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
        DB::unprepared("DROP PROCEDURE IF EXISTS tambah_perbaikan");
        DB::unprepared(
          "CREATE PROCEDURE tambah_perbaikan(
                id_perbaikan CHAR(6),
                kode_barang VARCHAR(30),
                approver VARCHAR(50),
                submitter VARCHAR(50),
                ruangan VARCHAR(255),
                keluhan TEXT
            )
            BEGIN
            DECLARE approver_id VARCHAR(18);
            DECLARE submitter_id VARCHAR(18);

            SELECT pengguna.id_pengguna INTO submitter_id FROM pengguna WHERE pengguna.username = submitter;
            SELECT pengguna.id_pengguna INTO approver_id FROM pengguna WHERE pengguna.username = approver;

            INSERT INTO perbaikan
            (id_perbaikan, kode_barang, approver, submitter, ruangan, tgl_perbaikan, keluhan)
            VALUES(
                id_perbaikan, kode_barang, approver_id, submitter_id, ruangan, NOW(), keluhan
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
        Schema::dropIfExists('procedure_insert_tambah_pengajuan_pb_perbaikan');
    }
};
