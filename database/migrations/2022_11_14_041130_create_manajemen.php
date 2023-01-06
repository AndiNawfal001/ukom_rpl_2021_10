<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('manajemen', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->char('nip', 18)->primary();
            $table->integer('id_pengguna');
            $table->string('nama');
            $table->string('kontak');

             // Foreign key untuk id_pengguna
             $table
             ->foreign('id_pengguna')
             ->references('id_pengguna')
             ->on('pengguna')
             ->cascadeOnUpdate()
             ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manajemen');
    }
};
