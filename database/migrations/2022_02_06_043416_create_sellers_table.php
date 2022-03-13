<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("email");
            $table->string("username")->unique();
            $table->string("password");
            $table->string("alamat");
            $table->string("no_telp");
            $table->string("nama_toko");
            $table->string("alamat_toko");
            $table->string("no_telp_toko");
            $table->string("logo");
            $table->string("no_rekening");
            $table->unsignedBigInteger("bank_id");
            $table->string("tentang")->nullable();
            $table->string("kode_pos");
            $table->string("kota");
            $table->string("kecamatan");
            $table->string("kelurahan");
            $table->boolean("is_active")->default(false);
            $table->boolean("is_ban")->default(false);
            $table->timestamp("active_at")->nullable();
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
        Schema::dropIfExists('sellers');
    }
}
