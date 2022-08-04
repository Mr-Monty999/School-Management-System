<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Subject extends Model
{
    use HasFactory;


    protected $fillable = ["subject_name", "class_id", "school_id"];
    protected $table = "subjects";

    /*
    public function school()
    {
        return $this->belongsTo(School::class, "school_id");
    }
    */

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
