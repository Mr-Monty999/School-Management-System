<?php

namespace Database\Factories;

use App\Models\Classes;
use App\Models\Parents;
use App\Models\User;
use App\Services\RegisterationService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Factory::create('ar_SA');

        $user = User::create([
            'username' => 'student_' . Str::random(10),
            'password' => Hash::make('password')
        ]);

        $user->assignRole('student');

        return [
            'student_name' => $this->faker->name(),
            'student_address' => $this->faker->address(),
            'student_birthdate' => $this->faker->date(),
            'student_registered_date' => $this->faker->date(),
            'student_paid_price' => $this->faker->numberBetween(10000,50000),
            'student_gender' => $this->faker->randomElement(['ذكر','أنثى']),
            'student_photo' => 'images/student/default.png',
            'student_national_number' => $this->faker->unique()->randomNumber(12,true),
            'parent_id' => Parents::inRandomOrder()->first()->id,
            'class_id' => Classes::inRandomOrder()->first()->id,
            'user_id' => $user->id
        ];
    }
}
