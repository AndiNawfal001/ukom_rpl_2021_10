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
        Schema::create('perbaikan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->char('id_perbaikan',6)->primary();
            $table->char('kode_barang',17);
            $table->integer('approver')->nullable();
            $table->integer('submitter');
            $table->text('keluhan');
            $table->date('tgl_perbaikan');

            $table->string('nama_teknisi')->nullable();
            $table->text('penyebab_keluhan')->nullable();
            $table->enum('status_perbaikan', ['bisa diperbaiki', 'tidak bisa diperbaiki'])->nullable();
            $table->text('solusi_barang')->nullable();
            $table->date('tgl_selesai_perbaikan')->nullable();

            $table->enum('approve_perbaikan', ['sudah diperbaiki', 'rusak', 'pending'])->default('pending')->nullable();
            $table->date('tgl_approve')->nullable();

            // Foreign key untuk kode_barang
            $table
            ->foreign('kode_barang')
            ->references('kode_barang')
            ->on('detail_barang');

            // Foreign key untuk approver
            $table
            ->foreign('approver')
            ->references('id_pengguna')
            ->on('pengguna')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            // Foreign key untuk submitter
            $table
            ->foreign('submitter')
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
        Schema::dropIfExists('pengajuan_pb');
    }
};
