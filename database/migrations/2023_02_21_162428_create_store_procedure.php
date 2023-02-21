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
            CREATE PROCEDURE `get_total_bayar` (IN id_transaksi INT, OUT total_bayar INT)
            BEGIN
            SELECT * FROM transaksis WHERE id = id_transaksi;
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
