<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("username")->unique();
            $table->string("no_telp");
            $table->string("email");
            $table->string("password");
            $table->string("alamat");
            $table->string("kode_pos");
            $table->string("kota");
            $table->string("kecamatan");
            $table->string("kelurahan");
            $table->string("gambar");
            $table->boolean("is_active")->default(false);
            $table->boolean("is_ban")->default(false);
            $table->timestamp("active_at")->nullable();
            $table->timestamp("ban_at")->nullable();
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
        Schema::dropIfExists('customers');
    }
}
