<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class SubjectTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = Subject::all();

        Teacher::all()->each(function($teacher) use ($subjects) {
            $teacher->subjects()->attach(
                $subjects->random(rand(1,2))->pluck('id')->toArray()
            );
        });
    }
}
