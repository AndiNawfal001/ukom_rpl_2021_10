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
        // VIEW JUMLAH PEMUTIHAN YANG SUDAH DISETUJUI
        DB::unprepared(
            "CREATE OR REPLACE VIEW jumlah_pemutihan_s AS (
                SELECT COUNT(id_pemutihan) AS jml_pemutihan_s FROM pemutihan WHERE approve_penonaktifan = 'setuju'
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
        Schema::dropIfExists('view_agregat_jml_pemutihan_s');
    }
};
