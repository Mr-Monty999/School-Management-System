<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SubjectTeacher
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher query()
 * @mixin \Eloquent
 */
class SubjectTeacher extends Model
{

    use HasFactory;

    protected $table = "subject_teacher";

    public function subjects() {
        return $this->hasMany(Subject::class);
    }

    public function teacher() {
        return $this->hasMany(Teacher::class);
    }
}
