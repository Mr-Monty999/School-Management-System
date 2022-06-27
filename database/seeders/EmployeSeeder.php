<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate([
            'username' => 'employe',
            'email' => 'employe@example.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('employe');
    }
}
