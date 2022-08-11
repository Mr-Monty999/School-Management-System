<?php

namespace Database\Factories;

use App\Models\Classes;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassesFactory extends Factory
{
    protected $model = Classes::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'class_name' => $this->faker->name()
        ];
    }
}
