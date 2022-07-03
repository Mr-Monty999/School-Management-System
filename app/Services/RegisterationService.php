<?php

namespace App\Services;

use App\Models\Parents;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpParser\ErrorHandler\Collecting;

class RegisterationService {

    public static function createUserAcount($type , $foreinId) {
        $user = User::create([
            'username' => Str::random(7),
            'password' => Hash::make('password'),
            $type.'_id' => $foreinId
        ]);

        $user->assignRole($type);
    }

    public static function getStudentParent($data) {
        $parent = Parents::firstOrCreate(['parent_national_number' => $data['parent_national_number']],$data);

        return $parent->id;
    }

}

