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
        Schema::create('detail_barang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->char('kode_barang',17)->primary();
            $table->integer('id_barang');
            $table->string('spesifikasi');
            $table->string('kondisi_barang');
            $table->enum('status', ['aktif ', 'nonaktif'])->default('aktif');
            $table->string('foto_barang');

            // Foreign key untuk barang
            $table
            ->foreign('id_barang')
            ->references('id_barang')
            ->on('barang')
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
        Schema::dropIfExists('detail_barang');
    }
};
