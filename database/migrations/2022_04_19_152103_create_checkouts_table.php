<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger("seller_id");
            $table->unsignedBigInteger("price_id");
            $table->unsignedBigInteger("galery_id")->nullable();
            $table->string("no_transaksi");
            $table->string("pengiriman");
            $table->integer("kodetransfer");
            $table->bigInteger("ongkir");
            $table->string("file");
            $table->string("alamat");
            $table->integer('qty')->nullable();
            $table->string("kontakdarurat");
            $table->integer("harga");
            $table->integer("total");
            $table->text("pesan")->nullable();
            $table->text("bukti_bayar")->nullable();
            $table->timestamp("expired_at");
            $table->string("status")->default("Belum Dibayar");
            $table->unsignedBigInteger("bank_id")->nullable();
            $table->string("no_rekening")->nullable();
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
        Schema::dropIfExists('checkouts');
    }
}
