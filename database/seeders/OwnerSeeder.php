<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate([
            'username' => 'owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('Super-Admin');
    }
}
