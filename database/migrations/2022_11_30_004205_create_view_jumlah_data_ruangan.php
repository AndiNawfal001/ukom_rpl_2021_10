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
    // public function up()
    // {
    //     DB::unprepared(
    //         "CREATE OR REPLACE VIEW jumlah_data_ruangan AS(
    //             SELECT COUNT(id_ruangan) FROM ruangan
    //         )"
    //       );
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_jumlah_data_ruangan');
    }
};
