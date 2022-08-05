<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Parents extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "parent_name",
        "parent_address",
        "parent_job",
        "parent_genre",
        "parent_phone",
        "parent_photo",
        "school_id",
        'parent_national_number'
    ];
    protected $table = "parents";

    /*
    public function school()
    {
        return $this->belongsTo(School::class, "school_id");
    }
    */

    public function students()
    {
        return $this->hasMany(Student::class, 'parent_id');
    }
}
