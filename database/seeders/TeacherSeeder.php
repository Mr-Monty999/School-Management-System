<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = Teacher::factory()->count(10)->create();

        $teachers = Teacher::all();

        /* Teacher::all()->each(function($teacher) use ($subjects) {
            $teacher->subjects()->attach(
                $subjects->random(rand(2,4))->pluck('id')->toArray()
            );
        }); */
        Subject::all()->each(function ($subject) use($teachers) {
            $subject->teachers()->attach(
                $teachers->random(rand(2,3))->pluck('id')->toArray()
            );
        });
    }
}
