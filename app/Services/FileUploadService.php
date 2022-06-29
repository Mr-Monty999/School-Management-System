<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUploadService
{

    /**
     *  $type : plural name of user type => students|employees|teachers
     */
    public function handleImage($image,$type) {
        if (!is_null($image)) {
            ////Rename Image to timestamp name
            $imageNewName = time() . "." . $image->getClientOriginalExtension();

            //Employees Images Path
            $uploadPath = "images/{$type}/";

            ////Move Image To Employees Images Path
            $image->move(public_path($uploadPath), $imageNewName);


            ///return Image Full Path To Store In database
            return $uploadPath . $imageNewName;
        }
    }

    /*
    public function handleStudentImage($image)
    {

        if (!is_null($image)) {


            ////Rename Image to timestamp name
            $imageNewName = time() . "." . $image->getClientOriginalExtension();

            //Student Image Path
            $uploadPath = "images/students/";

            ////Move Image To Students Images Path
            $image->move(public_path($uploadPath), $imageNewName);


            ///return Image Full Path To Store In database
            return $uploadPath . $imageNewName;
        }
    }
    public function handleTeacherImage($image)
    {

        if (!is_null($image)) {


            ////Rename Image to timestamp name
            $imageNewName = time() . "." . $image->getClientOriginalExtension();

            //Teachers Image Path
            $uploadPath = "images/teachers/";

            ////Move Image To Teachers Images Path
            $image->move(public_path($uploadPath), $imageNewName);


            ///return Image Full Path To Store In database
            return $uploadPath . $imageNewName;
        }
    }

    public function handleEmployeImage($image)
    {

        if (!is_null($image)) {


            ////Rename Image to timestamp name
            $imageNewName = time() . "." . $image->getClientOriginalExtension();

            //Employees Images Path
            $uploadPath = "images/employees/";

            ////Move Image To Employees Images Path
            $image->move(public_path($uploadPath), $imageNewName);


            ///return Image Full Path To Store In database
            return $uploadPath . $imageNewName;
        }
    }

    */

}
