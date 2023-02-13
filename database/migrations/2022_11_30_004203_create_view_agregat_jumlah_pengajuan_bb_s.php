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
        // VIEW JUMLAH PENGAJUAN BB YANG SEUDAH DISETUJUI
        DB::unprepared(
            "CREATE OR REPLACE VIEW jumlah_pengajuan_bb_s AS (
                SELECT COUNT(id_pengajuan_bb) AS jml_pengajuan_bb_s FROM pengajuan_bb WHERE status_approval = 'setuju'
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
        Schema::dropIfExists('view_agregat_jml_pengajuan_bb_s');
    }
};
