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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->integer('id_barang_masuk', true);
            $table->integer('id_pengajuan')->nullable();
            $table->char('supplier', 6);
            $table->integer('adder');
            $table->string('nama_barang');
            $table->integer('jml_masuk');
            $table->date('tgl_masuk');
            $table->enum('status_pembelian', ['outstanding ', 'selesai']);

            // Foreign key untuk id_pengajuan
            $table
            ->foreign('id_pengajuan')
            ->references('id_pengajuan_bb')
            ->on('pengajuan_bb')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            // Foreign key untuk supplier
            $table
            ->foreign('supplier')
            ->references('id_supplier')
            ->on('supplier')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            // Foreign key untuk adder
            $table
            ->foreign('adder')
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
        Schema::dropIfExists('barang_masuk');
    }
};
