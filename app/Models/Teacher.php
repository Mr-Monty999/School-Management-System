<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    protected $fillable = [
        "teacher_name",
        "teacher_address",
        "teacher_phone",
        "teacher_salary",
        "teacher_genre",
        "teacher_photo",
        "teacher_birthdate",
        "teacher_hire_date",
        "school_id",
        'teacher_national_number'
    ];
    protected $table = "teachers";

    /*
    public function school()
    {
        return $this->belongsTo(School::class, "school_id");
    }
*/
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
