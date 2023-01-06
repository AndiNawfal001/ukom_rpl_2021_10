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
        Schema::create('ruangan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            // $table->char('id_ruangan',6)->primary();
            $table->char('id_ruangan',6)->primary();
            // $table->integer('kode_barang');
            $table->string('nama_ruangan');
            $table->string('penanggung_jawab');
            $table->text('ket');
            $table->string('image');

            // Foreign key untuk kode_barang
            // $table
            // ->foreign('kode_barang')
            // ->references('kode_barang')
            // ->on('detail_barang')
            // ->cascadeOnUpdate()
            // ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ruangan');
    }
};
