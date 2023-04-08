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
        Schema::create('itemtransaksis', function (Blueprint $table) {
            $table->id();
            $table->string('transaksi_id');
            $table->foreign('transaksi_id')->references('transaksi_id')->on('transaksis')->onDelete('cascade');
            $table->string('nama_produk', 50);
            $table->integer('jumlah_barang');
            $table->integer('diskon');
            $table->integer('harga');
            $table->integer('sub_total');
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
        Schema::dropIfExists('itemtransaksis');
    }
};
