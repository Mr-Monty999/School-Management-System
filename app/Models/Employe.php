<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employe extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
        "employe_name",
        "employe_address",
        "employe_phone",
        "employe_salary",
        "employe_birthdate",
        "employe_hire_date",
        "employe_gender",
        "employe_photo",
        "employe_job",
        "school_id",
        'user_id',
        "employe_national_number"
    ];

    protected $table = "employees";

    /*
    public function school()
    {
        return $this->belongsTo(School::class, "school_id");
    }
    */



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
