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
            "phone" => $this->faker->phoneNumber,
            "email" => $this->faker->unique()->safeEmail,
            "password" => $this->faker->password,
            "alamat" => $this->faker->address,
        ];
    }
}
