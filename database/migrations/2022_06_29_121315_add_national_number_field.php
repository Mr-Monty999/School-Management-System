<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNationalNumberField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parents', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_national_number')->unique()->index();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger('student_national_number')->unique()->index();
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_national_number')->unique()->index();
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('employe_national_number')->unique()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
