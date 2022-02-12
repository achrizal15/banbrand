<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            "password" => $this->faker->password,
            "alamat" => $this->faker->address,
            "no_telp" => $this->faker->phoneNumber,
            "nama_toko" => $this->faker->company,
            "alamat_toko" => $this->faker->address,
            "no_telp_toko" => $this->faker->phoneNumber,
            "logo" => "default.jpg",
            "no_rekening" => $this->faker->bankAccountNumber,
            "is_active" => $this->faker->boolean,
            "tentang" => $this->faker->text,
            "kode_pos" => $this->faker->postcode,
            "kota" => $this->faker->city,
            "kecamatan" => $this->faker->city,
            "kelurahan" => $this->faker->city,
            "username" => $this->faker->unique()->userName,
            "active_at" => $this->faker->time("Y-m-d H:i:s", "now"),
        ];
    }
}
