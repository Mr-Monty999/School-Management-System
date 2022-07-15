<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [
                'subject_name' => 'القران الكريم',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],
            [
                'subject_name' => ' اللغة العربية',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],
            [
                'subject_name' => ' اللغة الانجليزية',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],
            [
                'subject_name' => ' الفقه',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],
            [
                'subject_name' => 'الحديث',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],
            [
                'subject_name' => ' التفسير',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],
            [
                'subject_name' => ' التوحيد',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],
            [
                'subject_name' => 'الرياضيات ',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],
            [
                'subject_name' => ' العلوم',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],
            [
                'subject_name' => ' التاريخ',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],
            [
                'subject_name' => ' الجغرافيا',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],
            [
                'subject_name' => ' التربية البدنية',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],
            [
                'subject_name' => ' التربية الأسرية',
                'class_id' => Classes::inRandomOrder()->first()->id
            ],

        ]);
    }
}
