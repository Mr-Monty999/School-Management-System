<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $fillable = ["class_name", "school_id"];
    protected $table = "classes";

    /*
    public function school()
    {
        return $this->belongsTo(School::class, "school_id");
    }
    */

    public function students()
    {
        return $this->hasMany(Student::class, "class_id");
    }

    public function subjects() {
        return $this->hasMany(Subject::class,'class_id');
/*         return $this->belongsToMany(Subject::class,'class_subject','class_id','subject_id');
 */    }
}
