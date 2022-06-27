<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate([
            'username' => 'student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('student');
    }
}
