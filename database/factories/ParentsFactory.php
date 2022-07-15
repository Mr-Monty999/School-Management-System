<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Factory::create('ar_SA');

        return [
            'paernt_name' => $this->faker->name(),
            'perent_job' => $this->faker->jobTitle(),
            'parent_phone' =>  $this->faker->phoneNumber(),
            'parent_national_number' => $this->faker->randomNumber(12,true)
        ];
    }
}
