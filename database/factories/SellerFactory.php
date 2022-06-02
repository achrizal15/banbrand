<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nama" => $this->faker->name,
            "email" => $this->faker->unique()->safeEmail,
            "password" => Hash::make('123'),
            "alamat" => $this->faker->address,
            "no_telp" => $this->faker->phoneNumber,
            "nama_toko" => $this->faker->company,
            "alamat_toko" => $this->faker->address,
            "no_telp_toko" => $this->faker->phoneNumber,
            "logo" => "default.jpg",
            "no_rekening" => $this->faker->bankAccountNumber,
            "is_active" => 0,
            "tentang" => $this->faker->text,
            "kode_pos" => $this->faker->postcode,
            "kota" => $this->faker->city,
            "kecamatan" => $this->faker->city,
            "kelurahan" => $this->faker->city,
            "bank_id"=>$this->faker->numberBetween(1,20),
            "username" => $this->faker->unique()->userName,
            "active_at" => $this->faker->time("Y-m-d H:i:s", "now"),
        ];
    }
}
