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
        // VIEW JUMLAH RUANGAN
        DB::unprepared(
            "CREATE OR REPLACE VIEW jumlah_ruangan AS (
                SELECT COUNT(id_ruangan) AS jml_ruangan FROM ruangan
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
        Schema::dropIfExists('view_agregat_jml_ruangan');
    }
};
