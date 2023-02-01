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
        Schema::create('pemutihan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('id_pemutihan', true);
            $table->char('id_perbaikan',6)->nullable();
            $table->integer('approver')->nullable();
            $table->char('kode_barang',17);
            $table->integer('submitter');
            // $table->string('nama_pelaksana');
            $table->date('tgl_pemutihan');
            $table->text('ket_pemutihan');
            $table->enum('approve_penonaktifan', ['setuju', 'tidak setuju', 'pending'])->default('pending');
            $table->date('tgl_approve')->nullable();

            // $table->string('foto_barang');

            // // Foreign key untuk manajemen
            // $table
            // ->foreign('manajemen')
            // ->references('nip')
            // ->on('manajemen')
            // ->cascadeOnUpdate()
            // ->cascadeOnDelete();

            // // Foreign key untuk kaprog
            // $table
            // ->foreign('kaprog')
            // ->references('nip')
            // ->on('kaprog')
            // ->cascadeOnUpdate()
            // ->cascadeOnDelete();

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

            // Foreign key untuk id_perbaikan
            $table
            ->foreign('id_perbaikan')
            ->references('id_perbaikan')
            ->on('perbaikan')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            // Foreign key untuk kode_barang
            $table
            ->foreign('kode_barang')
            ->references('kode_barang')
            ->on('detail_barang')
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
        Schema::dropIfExists('pemutihan');
    }
};
