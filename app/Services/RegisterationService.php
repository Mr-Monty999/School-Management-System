<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterationService {

    public function createUserAcount($type , $foreinId) {
        $user = User::create([
            'username' => Str::random(7),
            'password' => Hash::make('password'),
            $type.'_id' => $foreinId
        ]);

        $user->assignRole($type);
    }
}
