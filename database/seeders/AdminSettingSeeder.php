<?php

namespace Database\Seeders;

use App\Models\AdminSetting;
use Illuminate\Database\Seeder;

class AdminSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     AdminSetting::create([
        "no_handphone"=>'081239813921',
        "email"=>"rendi@fmail.com",
        "nama_bank"=>"BNI",
        "no_rekening"=>"9123913",
        "atas_nama_bank"=>"Rendi",
        "harga_ongkir"=>"10000",
        "about_us_web"=>"Aduhhhh"
     ]);
    }
}
