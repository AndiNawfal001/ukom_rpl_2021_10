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
        DB::unprepared(
            "CREATE OR REPLACE VIEW pengguna_manajemen AS (
             SELECT pengguna.id_pengguna, pengguna.username,
                kaprog.nama
                FROM pengguna
                JOIN kaprog
                ON pengguna.id_pengguna = kaprog.id_pengguna
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
        Schema::dropIfExists('view_pengguna_kaprog');
    }
};
