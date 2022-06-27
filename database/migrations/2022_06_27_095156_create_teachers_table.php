<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments("id");
            $table->string('teacher_name')->index('teacher_name');
            $table->string('teacher_address');
            $table->string('teacher_phone');
            $table->double('teacher_salary');
            $table->string('teacher_genre');
            $table->string('teacher_photo')->nullable();
            $table->date('teacher_birth_date');
            $table->date('teacher_hire_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
