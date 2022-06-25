<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    protected $fillable = [
        "parent_name",
        "parent_address",
        "parent_job",
        "parent_genre",
        "parent_phone",
        "parent_photo",
        "school_id"
    ];
    protected $table = "parents";

    public function school()
    {
        return $this->belongsTo(School::class, "school_id");
    }
    public function students()
    {
        return $this->hasMany(Student::class, "student_id");
    }
}
