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
        DB::unprepared("DROP FUNCTION IF EXISTS newIdSupplier");
        DB::unprepared(
          "CREATE FUNCTION newIdSupplier()
            RETURNS CHAR(6)
            BEGIN
            DECLARE kode_lama CHAR(6);
            DECLARE kode_baru CHAR(6);
            DECLARE ambil_angka INT;
            DECLARE angka_baru CHAR(3);
            DECLARE jumlah INT;

            SELECT COUNT(id_supplier) INTO jumlah FROM supplier;

            IF(jumlah = 0) THEN
                SET kode_baru = CONCAT('SPR', 0,0,1);
            ELSE
                SELECT MAX(id_supplier) INTO kode_lama FROM supplier;
                SET ambil_angka = SUBSTR(kode_lama, 4, 3) + 1;
                SET angka_baru = LPAD(ambil_angka,3, 0);
                SET kode_lama = SUBSTR(kode_lama, 1, 3);
                SET kode_baru = CONCAT(kode_lama, angka_baru);
            END IF;
            RETURN kode_baru;


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
        Schema::dropIfExists('function_new_id_supplier');
    }
};
