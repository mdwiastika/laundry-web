<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        $stored_procedure = "DROP PROCEDURE IF EXISTS `get_total_bayar`;
            CREATE PROCEDURE `get_total_bayar` (IN get_id_transaksi INT(10))
            BEGIN
            DECLARE harga_paket INT;
            DECLARE set_id_paket INT;
            DECLARE qty_transaksi INT;
            DECLARE total_bayar INT;
            SELECT id_paket, qty INTO set_id_paket, qty_transaksi FROM detail_transaksis WHERE id_transaksi = get_id_transaksi LIMIT 1;
            SELECT harga INTO harga_paket FROM pakets WHERE id = set_id_paket LIMIT 1;
            SET total_bayar = harga_paket * qty_transaksi;
            SELECT total_bayar;
            END;";
        DB::unprepared($stored_procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_procedure');
    }
};
