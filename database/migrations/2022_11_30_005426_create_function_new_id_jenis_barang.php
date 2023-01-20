<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP FUNCTION IF EXISTS  newIdJenisbrg");
        DB::unprepared(
            "CREATE FUNCTION  newIdJenisbrg()
                RETURNS CHAR(5)
                BEGIN
                DECLARE kode_lama CHAR(5);
                DECLARE kode_baru CHAR(5);
                DECLARE ambil_angka INT;
                DECLARE angka_baru CHAR(3);
                DECLARE jumlah INT;

                SELECT COUNT(id_jenis_brg) INTO jumlah FROM jenis_barang;

                IF(jumlah = 0) THEN
                    SET kode_baru = CONCAT('JB', 0,0,1);
                ELSE
                    SELECT MAX(id_jenis_brg) INTO kode_lama FROM jenis_barang;
                    SET ambil_angka = SUBSTR(kode_lama, 4, 3) + 1;
                    SET angka_baru = LPAD(ambil_angka,2, 0);
                    SET kode_lama = SUBSTR(kode_lama, 1, 3);
                    SET kode_baru = CONCAT(kode_lama, angka_baru);
                END IF;
                RETURN kode_baru;


            END;"
        );}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('function_new_id_log');
    }
};
