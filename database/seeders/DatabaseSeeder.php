<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
            EmployeSeeder::class,
            //SubjectTeacherSeeder::class,
            ParentsSeeder::class,
            StudentSeeder::class,
            TeacherSeeder::class,
        ]);
    }
}
