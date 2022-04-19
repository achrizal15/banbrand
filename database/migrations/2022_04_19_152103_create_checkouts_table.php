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
            $table->integer("kodetransfer");
            $table->bigInteger("ongkir");
            $table->string("file");
            $table->string("alamat");
            $table->string("kontakdarurat");
            $table->integer("harga");
            $table->integer("total");
            $table->text("pesan");
            $table->timestamp("expired_at");
            $table->string("kodetransfer");
            $table->string("status");
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
