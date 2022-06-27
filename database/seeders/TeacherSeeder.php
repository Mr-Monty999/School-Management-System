<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate([
            'username' => 'teacher',
            'email' => 'teacher@example.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('teacher');
    }
}
