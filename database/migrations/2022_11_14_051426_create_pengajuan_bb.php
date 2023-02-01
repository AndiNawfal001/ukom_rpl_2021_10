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
        Schema::create('pengajuan_bb', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('id_pengajuan_bb',true);
            $table->integer('approver')->nullable();
            $table->integer('submitter');
            $table->string('nama_barang');
            $table->string('spesifikasi');
            $table->biginteger('harga_satuan');
            $table->biginteger('total_harga');
            $table->integer('jumlah');
            $table->date('tgl');
            $table->char('ruangan', 6);
            $table->enum('status_approval', ['setuju ', 'tidak', 'pending'])->default('pending')->nullable();
            $table->date('tgl_approve')->nullable();
            $table->enum('status_pembelian', ['outstanding ', 'selesai'])->nullable();


            // Foreign key untuk manajemen
            // $table
            // ->foreign('manajemen')
            // ->references('nip')
            // ->on('manajemen')
            // ->cascadeOnUpdate()
            // ->cascadeOnDelete();

            // Foreign key untuk kaprog
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

            // Foreign key untuk ruangan
            $table
            ->foreign('ruangan')
            ->references('id_ruangan')
            ->on('ruangan')
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
        Schema::dropIfExists('pengajuan_bb');
    }
};
