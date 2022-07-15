<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
            ['class_name' => ' الصف الأول'],
            ['class_name' => 'الصف الثاني'],
            ['class_name' => 'الصف الثالث'],
            ['class_name' => 'الصف الرابع'],
            ['class_name' => 'الصف الخامس'],
            ['class_name' => 'الصف السادس'],
            ['class_name' => 'الصف السابع'],
            ['class_name' => 'الصف الثامن'],
        ]);
    }
}
