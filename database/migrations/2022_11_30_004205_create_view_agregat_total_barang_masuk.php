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
        // VIEW TOTAL JML MASUK DARI TABLE BARANG MASUK
        DB::unprepared(
            "CREATE OR REPLACE VIEW total_barang_masuk AS (
                SELECT SUM(jml_masuk) AS ttl_barang_masuk FROM barang_masuk
            )"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_agregat_total_barang_masuk');
    }
};
