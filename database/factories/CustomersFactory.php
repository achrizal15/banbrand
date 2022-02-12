<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomersFactory extends Factory
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
            "no_telp" => $this->faker->phoneNumber,
            "email" => $this->faker->unique()->safeEmail,
            "password" => $this->faker->password,
            "alamat" => $this->faker->address,
            "kode_pos" => $this->faker->postcode,
            "kota" => $this->faker->city,
            "kecamatan" => $this->faker->city,
            "kelurahan" => $this->faker->city,
            "gambar"=>"default.png",
            "username" => $this->faker->unique()->userName,
        ];
    }
}
