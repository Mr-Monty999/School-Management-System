<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;


    protected $fillable = ["job_name", "school_id"];
    protected $table = "employees_jobs";

    /*
    public function school()
    {
        return $this->belongsTo(School::class, "school_id");
    }
    */

    public function employees()
    {
        return $this->hasMany(Employe::class, "job_id");
    }
}
