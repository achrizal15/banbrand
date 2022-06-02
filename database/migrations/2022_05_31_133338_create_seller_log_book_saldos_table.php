<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerLogBookSaldosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_log_book_saldos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("seller_id");
            $table->integer("saldo");
            $table->enum("jenis",["debit","kredit"]);
            $table->string("keterangan");
            $table->integer("jumlah");
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
        Schema::dropIfExists('seller_log_book_saldos');
    }
}
