<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        "student_name",
        "student_address",
        "student_birthdate",
        "student_registered_date",
        "student_paid_price",
        "student_gender",
        "student_photo",
        "parent_id",
        "class_id",
        'student_national_number',
        'user_id'
    ];

    /*
    public function school()
    {
        return $this->belongsTo(School::class, "school_id");
    }
    */

    public function getTypeAttribute() {
        return 'طالب';
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, "class_id");
    }

    public function parent()
    {
        return $this->belongsTo(Parents::class, "parent_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function results() {
        return $this->hasMany(Result::class);
    }

    public function siblings() {
        //return Parents::with('students')->find($this->parent_id)->students->except($this->id);
        return $this->with('class')->where('parent_id',$this->parent_id)->get()->except($this->id);
    }
}
