<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class FileUploadService
{

    /**
     *  $type : plural name of user type => students|employees|teachers
     */
    public static function handleImage($image, $type)
    {
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

    public static function updateImage($new_image, $old_image, $type)
    {
        if (is_null($new_image)) {
            return $old_image;
        }
        if (!is_null($old_image)) {
            @unlink($old_image,);
        }

        ////Rename Image to timestamp name
        $imageNewName = time() . "." . $new_image->getClientOriginalExtension();

        //Employees Images Path
        $uploadPath = "images/{$type}/";

        ////Move Image To Employees Images Path
        $new_image->move(public_path($uploadPath), $imageNewName);


        ///return Image Full Path To Store In database
        return $uploadPath . $imageNewName;
    }

    public static function deleteImage($imagePath)
    {
        // if (!is_null($image)) {
        //     unset($image);
        // }

        if (!is_dir($imagePath) && file_exists($imagePath))
            unlink($imagePath);
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
