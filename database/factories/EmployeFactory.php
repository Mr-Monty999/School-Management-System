<?php

namespace Database\Factories;

use App\Models\Employe;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Employe::class;


    public function definition()
    {


        $user = User::create([
            'username' => 'emp_' . Str::random(7),
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('employe');

        return [
            "employe_name" => $this->faker->name(),
            "employe_address" => $this->faker->address(),
            "employe_phone" => $this->faker->phoneNumber(),
            "employe_salary" => $this->faker->numberBetween(40000, 100000),
            "employe_birthdate" => $this->faker->date(),
            "employe_hire_date" => $this->faker->date(),
            "employe_gender" => $this->faker->randomElement(["ذكر", "انثى"]),
            "employe_job" => $this->faker->jobTitle(),
            "employe_national_number" => $this->faker->unique()->numerify("############"),
            "user_id" => $user->id,

        ];
    }
}
