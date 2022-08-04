<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TeacherSubject
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherSubject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherSubject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherSubject query()
 * @mixin \Eloquent
 */
class TeacherSubject extends Model
{
    use HasFactory;

    ///////// Leave This Model Null /////////

    /*
    public function school()
    {
        return $this->belongsTo(School::class, "school_id");
    }
    */
}
