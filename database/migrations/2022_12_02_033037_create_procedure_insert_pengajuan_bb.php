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
        DB::unprepared("DROP PROCEDURE IF EXISTS tambah_pengajuan_bb");
        DB::unprepared(
          "CREATE PROCEDURE tambah_pengajuan_bb(
                approver VARCHAR(50),
                submitter VARCHAR(50),
                nama_barang VARCHAR(50),
                spesifikasi TEXT,
                harga_satuan VARCHAR(50),
                total_harga VARCHAR(50),
                jumlah INT(11),
                ruangan VARCHAR(50)
            )
            BEGIN

            -- DECLARE nip_m CHAR(18);
            -- DECLARE nip_k CHAR(18);

            DECLARE approver_id VARCHAR(18);
            DECLARE submitter_id VARCHAR(18);

            -- SELECT manajemen.nip INTO nip_m FROM manajemen WHERE manajemen.nama = manajemen;
            -- SELECT kaprog.nip INTO nip_k FROM kaprog WHERE kaprog.nama = kaprog;
            SELECT pengguna.id_pengguna INTO submitter_id FROM pengguna WHERE pengguna.username = submitter;
            SELECT pengguna.id_pengguna INTO approver_id FROM pengguna WHERE pengguna.username = approver;

            INSERT INTO pengajuan_bb
            (approver, submitter, nama_barang, spesifikasi, harga_satuan, total_harga, jumlah, tgl, ruangan)
            VALUES(
                approver_id, submitter_id, nama_barang, spesifikasi, harga_satuan, total_harga, jumlah, NOW(), ruangan
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
        Schema::dropIfExists('procedure_insert_pengajuan_bb');
    }
};
