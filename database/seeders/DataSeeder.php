<?php

namespace Database\Seeders;

use App\Models\Parents;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Parents::factory()->count(5)->create();

        //Student::factory()->count(20)->create();

        //Teacher::factory()->count(5)->create();

        //$subjects = Subject::all();

        /* Teacher::all()->each(function($teacher) use ($subjects) {
            $teacher->subjects()->attach(
                $subjects->random(rand(1,2))->pluck('id')->toArray()
            );
        }); */
    }
}
