<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 5),
            'last_name'   => $this->faker->lastName,
            'first_name'  => $this->faker->firstName,
            'gender'      => $this->faker->numberBetween(1, 3),
            'email'       => $this->faker->safeEmail,
            'tel'         => $this->faker->phoneNumber,
            'address'     => $this->faker->address,
            'building'    => $this->faker->secondaryAddress,
            'detail'      => $this->faker->realText(50),
        ];
    }
}
