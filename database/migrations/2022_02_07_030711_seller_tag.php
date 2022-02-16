<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SellerTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       //create schema
         Schema::create('seller_tag', function (Blueprint $table) {
              $table->id();
              $table->unsignedBigInteger("seller_id");
              $table->unsignedBigInteger("tag_id");
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
        //
    }
}
