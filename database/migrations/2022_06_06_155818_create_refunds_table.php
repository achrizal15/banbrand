<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("checkout_id")->nullable();
            $table->unsignedBigInteger("seller_id")->nullable();
            $table->string("keterangan");
            $table->string("saldo");
            $table->string("no_rekening");
            $table->enum("type",["penarikan","refund"]);
            $table->enum("status",["Proses","Selesai","Tolak"])->default("Proses");
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
        Schema::dropIfExists('refunds');
    }
}
