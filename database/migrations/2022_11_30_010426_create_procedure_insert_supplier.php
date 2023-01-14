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

        DB::unprepared("DROP PROCEDURE IF EXISTS tambah_supplier");
        // DB::unprepared(
        //   "CREATE PROCEDURE tambah_supplier(
        //         id_supplier CHAR(6),
        //         nama VARCHAR(255),
        //         kontak VARCHAR(255),
        //         alamat VARCHAR(255)
        //     )
        //     BEGIN
        //     INSERT INTO supplier
        //     (id_supplier, nama, kontak, alamat)
        //     VALUES(
        //         id_supplier, nama, kontak, alamat
        //     );

        //   END;"
        // );
    }
};
