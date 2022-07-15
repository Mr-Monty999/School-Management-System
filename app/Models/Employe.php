<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        "employe_name",
        "employe_address",
        "employe_phone",
        "employe_salary",
        "employe_birthdate",
        "employe_hiredate",
        "employe_genre",
        "employe_photo",
        "school_id",
        'user_id'
    ];

    protected $table = "employees";

    /*
    public function school()
    {
        return $this->belongsTo(School::class, "school_id");
    }
    */

    public function job()
    {
        return $this->belongsTo(Job::class, "job_id");
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
