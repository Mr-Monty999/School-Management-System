<?php

namespace Database\Factories;

use App\Models\Parents;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParentsFactory extends Factory
{

    protected $model = Parents::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //$faker = Factory::create('ar_SA');

        return [
            'parent_name' => $this->faker->name(),
            'parent_job' => $this->faker->jobTitle(),
            'parent_phone' =>  $this->faker->phoneNumber(),
            'parent_national_number' => $this->faker->unique()->numerify('############'),
        ];
    }
}
