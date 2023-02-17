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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_outlet')->constrained('outlets')->onDelete('cascade');
            $table->string('kode_invoice')->nullable()->default('-');
            $table->foreignId('id_member')->constrained('members');
            $table->date('tanggal_order')->useCurrent();
            $table->date('batas_waktu')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->integer('biaya_tambahan')->nullable();
            $table->integer('diskon')->nullable();
            $table->integer('pajak');
            $table->enum('status', ['baru', 'proses', 'selesai', 'diambil']);
            $table->enum('dibayar', ['dibayar', 'belum_dibayar']);
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};
