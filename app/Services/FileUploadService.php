<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService {

    public function handleStudentImage($image) {
        if(!$image) {
            return null;
        }

        return Storage::put('students',$image);
    }
}
