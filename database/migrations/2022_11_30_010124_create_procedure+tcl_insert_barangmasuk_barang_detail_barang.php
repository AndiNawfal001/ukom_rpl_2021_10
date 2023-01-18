<?php

use Illuminate\Database\Migrations\Migration;
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
    DB::unprepared("DROP PROCEDURE IF EXISTS tambah_barangmasuk");
    DB::unprepared(
        "CREATE PROCEDURE tambah_barangmasuk(
            nama_barang varchar(30),
            jml_barang int,
            spesifikasi TEXT,
            kondisi_barang VARCHAR(10),
            supplier VARCHAR(30),
            -- nama_manajemen VARCHAR(30),
            adder VARCHAR(50),
            jenis_barang VARCHAR(30),
            foto_barang VARCHAR(225)
        )
        BEGIN
        -- DECLARE barang INT;
        DECLARE idBarang CHAR(6);
        DECLARE idBarangBaru VARCHAR(6);
        DECLARE jenis_brg VARCHAR(30);
        DECLARE pengajuan INT;
        DECLARE id_supplier VARCHAR(30);
        DECLARE jumlah_pengajuan INT;
        DECLARE jml_barang_barang INT;
        -- DECLARE nip char(18);
        DECLARE adder_id INT;
        DECLARE cek_barang_masuk INT;
        DECLARE jml_sebelum INT;
        DECLARE jml_hasil INT;

        -- KODE BARANG
        DECLARE i int DEFAULT 1;
        DECLARE a CHAR(3);
        DECLARE x int DEFAULT 0;

        -- BUAT LPAD
        DECLARE kode_jenis VARCHAR(30);
        DECLARE kode_jenisBaru VARCHAR(30);
        DECLARE kode_baru VARCHAR(30);
        DECLARE sekarang TIME;

        -- TCL
        DECLARE kodeError CHAR(5) DEFAULT '00000';
        DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
        BEGIN
            GET DIAGNOSTICS CONDITION 1
            kodeError = RETURNED_SQLSTATE;
        END;

        START TRANSACTION;

        SAVEPOINT initial;
        -- cek jika ada barang yg sama sebelumnya
        SELECT jenis_barang.id_jenis_brg INTO jenis_brg FROM jenis_barang WHERE jenis_barang.id_jenis_brg = jenis_barang;
        SELECT pengajuan_bb.id_pengajuan_bb INTO pengajuan FROM pengajuan_bb WHERE pengajuan_bb.nama_barang = nama_barang;
        SELECT pengajuan_bb.jumlah INTO jumlah_pengajuan FROM pengajuan_bb WHERE pengajuan_bb.nama_barang = nama_barang;
        SELECT supplier.id_supplier INTO id_supplier FROM supplier WHERE supplier.id_supplier = supplier;
        -- SELECT manajemen.nip INTO nip FROM manajemen WHERE manajemen.nama = nama_manajemen;

        SELECT pengguna.id_pengguna INTO adder_id FROM pengguna WHERE pengguna.username = adder;

        SAVEPOINT jikaadabarang_masuk;

        -- cek jika ada barang_masuk yg sama sebelumnya
        SELECT COUNT(id_barang_masuk) INTO cek_barang_masuk FROM barang_masuk WHERE barang_masuk.id_pengajuan = pengajuan;
        -- jika tidak ada
        IF (cek_barang_masuk = 0) THEN
            -- jika jml masuk kurang dari jml pengajuan
            IF(jml_barang < jumlah_pengajuan) THEN
                INSERT INTO barang_masuk (id_pengajuan, supplier, adder, nama_barang, jml_masuk, tgl_masuk, status_pembelian)
                VALUES (pengajuan, id_supplier, adder_id, nama_barang, jml_barang, NOW(), 'outstanding');

                INSERT INTO barang (id_jenis_brg ,nama_barang, jml_barang)
                VALUES (jenis_brg ,nama_barang, jml_barang);

            -- jika jml masuk sesuai jml pengajuan
            ELSEIF(jml_barang = jumlah_pengajuan) THEN

                INSERT INTO barang_masuk (id_pengajuan, supplier, adder, nama_barang, jml_masuk, tgl_masuk, status_pembelian)
                VALUES (pengajuan, id_supplier, adder_id, nama_barang, jml_barang, NOW(), 'selesai');

                INSERT INTO barang (id_jenis_brg ,nama_barang, jml_barang)
                VALUES (jenis_brg ,nama_barang, jml_barang);

                UPDATE pengajuan_bb SET status_pembelian = 'selesai' WHERE pengajuan_bb.nama_barang = nama_barang;
            END IF ;
        -- jika ada
        ELSE
            -- ambil data terakhir dari barang_masuk yg sama
            SELECT SUM(jml_masuk) INTO jml_sebelum FROM barang_masuk WHERE barang_masuk.id_pengajuan = pengajuan;
            -- jumlahkan jml barang masuk dan (jml_masuk yg sama dan sudah ada sebelumnya)
            SET jml_hasil = jml_barang + jml_sebelum;
            IF(jml_hasil < jumlah_pengajuan)THEN
                INSERT INTO barang_masuk (id_pengajuan, supplier, adder, nama_barang, jml_masuk, tgl_masuk, status_pembelian)
                VALUES (pengajuan, id_supplier, adder_id, nama_barang, jml_barang, NOW(), 'outstanding');

                UPDATE barang SET jml_barang = jml_hasil WHERE barang.nama_barang = nama_barang;

            ELSEIF(jml_hasil = jumlah_pengajuan) THEN

                INSERT INTO barang_masuk (id_pengajuan, supplier, adder, nama_barang, jml_masuk, tgl_masuk, status_pembelian)
                VALUES (pengajuan, id_supplier, adder_id, nama_barang, jml_barang, NOW(), 'selesai');

                UPDATE barang SET jml_barang = jml_hasil WHERE barang.nama_barang = nama_barang;
                UPDATE pengajuan_bb SET status_pembelian = 'selesai' WHERE pengajuan_bb.nama_barang = nama_barang;
            END IF;
        END IF;


        IF kodeError != '00000' THEN
            ROLLBACK TO jikaadabarang_masuk;
        END IF;

        SAVEPOINT insert_barang;

        SELECT barang.id_barang INTO idBarang FROM barang WHERE barang.nama_barang = nama_barang;

        SELECT jenis_barang.id_jenis_brg INTO kode_jenis FROM jenis_barang WHERE jenis_barang.id_jenis_brg = jenis_barang;

        WHILE (i <= jml_barang)DO
            SET x = x + 1;
            SET a = LPAD(x,3,0);
            SET sekarang = NOW();
            SET idBarangBaru = CONCAT(0,0, idBarang);
            SET kode_jenisBaru = SUBSTR(kode_jenis, 3);
            SET kode_baru = CONCAT(idBarangBaru, kode_jenisBaru, sekarang, a);
            INSERT INTO detail_barang (kode_barang, nama_barang, id_barang, spesifikasi, kondisi_barang, foto_barang)
            VALUES (kode_baru, nama_barang, idBarang, spesifikasi, kondisi_barang, foto_barang);
            SET i = i + 1;
        END WHILE;

        IF kodeError != '00000' THEN
            ROLLBACK TO insert_barang;
        END IF;

        COMMIT;

        END;"
    );
  }
};
