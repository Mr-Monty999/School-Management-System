<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Database\Seeders\DataSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\ClassSeeder;
use Database\Seeders\OwnerSeeder;
use Database\Seeders\SubjectSeeder;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\SubjectTeacherSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        $this->call([
            PermissionsSeeder::class,
            OwnerSeeder::class,
            AdminSeeder::class,
            ClassSeeder::class,
            SubjectSeeder::class,
            //SubjectTeacherSeeder::class,
            // DataSeeder::class,
        ]);

        //Parents::factory()->count(3)->create();

        //Student::factory()->count(10)->create();

        //Teacher::factory()->count(5)->create();
        //\App\Models\User::factory(5)->create();

    }
}
