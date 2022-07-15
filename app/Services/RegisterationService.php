<?php

namespace App\Services;

use App\Models\Parents;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterationService {

    public static function createUserAcount($type) {
        $user = User::create([
            'username' => $type . '-' . Str::random(7),
            'password' => Hash::make('password'),
        ]);

        $user->assignRole($type);

        return $user->id;
    }

    public static function getStudentParent($data) {
        $parent = Parents::firstOrCreate(['parent_national_number' => $data['parent_national_number']],$data);

        return $parent->id;
    }

}

