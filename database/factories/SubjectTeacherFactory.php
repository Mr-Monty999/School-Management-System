<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\SubjectTeacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectTeacherFactory extends Factory
{
    protected $model = SubjectTeacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'teacher_id' => Teacher::inRandomOrder()->first()->id,
            'subject_id' => Subject::inRandomOrder()->first()->id,
        ];
    }
}
