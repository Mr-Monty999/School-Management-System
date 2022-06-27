<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        "school_name",
        "school_owner",
        "school_address",
        "school_phone",
        "school_year_price",
        "school_logo",
    ];
    protected $table = "schools";

    /*
    public function admins()
    {
        return $this->hasMany(Admin::class, "school_id");
    }

    public function classes()
    {
        return $this->hasMany(Classes::class, "school_id");
    }

    public function employees()
    {
        return $this->hasMany(Employe::class, "school_id");
    }
    public function jobs()
    {
        return $this->hasMany(Job::class, "school_id");
    }
    public function parents()
    {
        return $this->hasMany(Parents::class, "school_id");
    }
    public function students()
    {
        return $this->hasMany(Student::class, "school_id");
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class, "school_id");
    }
    public function teachers()
    {
        return $this->hasMany(Teacher::class, "school_id");
    }

    public function teachers_subjects()
    {
        return $this->hasMany(TeacherSubject::class, "school_id");
    }
    */
}
