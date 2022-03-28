<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_packages', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->text("deskripsi");
            $table->text("persyaratan");
            $table->string("harga");
            $table->string("image");
            $table->string("type");
            $table->string("status")->default("on");
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
        Schema::dropIfExists('price_packages');
    }
}
