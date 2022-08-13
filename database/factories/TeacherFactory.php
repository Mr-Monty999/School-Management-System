<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::create([
            'username' => 'teacher_' . Str::random(7),
            'password' => Hash::make('password')
        ]);

        $user->assignRole('teacher');

        return [
            'teacher_name' => $this->faker->name(),
            'teacher_address' => $this->faker->address(),
            'teacher_birthdate' => $this->faker->date(),
            'teacher_hire_date' => $this->faker->date(),
            'teacher_salary' => $this->faker->numberBetween(40000,90000),
            'teacher_phone' => $this->faker->phoneNumber(),
            'teacher_gender' => $this->faker->randomElement(['ذكر','أنثى']),
            'teacher_national_number' => $this->faker->unique()->numerify('############'),
            'user_id' => $user->id
        ];
    }
}
