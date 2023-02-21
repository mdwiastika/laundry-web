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
        DB::unprepared('DROP TRIGGER IF EXISTS `add_diskon`');
        $trigger_code = "CREATE TRIGGER add_diskon AFTER INSERT ON detail_transaksis
            FOR EACH ROW
                BEGIN
                    DECLARE member_id INT;
                    DECLARE is_member VARCHAR(20);
                    SELECT id_member INTO member_id FROM transaksis WHERE id = NEW.id_transaksi LIMIT 1;
                    SELECT keterangan INTO is_member FROM members WHERE id = member_id LIMIT 1;
                    IF is_member = 'member'
                    THEN
                        UPDATE transaksis SET diskon = 5 WHERE id = NEW.id_transaksi;
                    ELSE
                        UPDATE transaksis SET diskon = 0 WHERE id = NEW.id_transaksi;
                    END iF;
                END;
        ";
        DB::unprepared($trigger_code);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diskon_trigger');
    }
};
