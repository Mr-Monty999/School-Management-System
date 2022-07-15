<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_name')->index('student_name');
            $table->string('student_address');
            $table->date('student_birthdate');
            $table->date('student_registered_date');
            $table->double('student_paid_price');
            $table->string('student_gender');
            $table->string('student_photo')->nullable();
            $table->foreignId('parent_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('class_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('students');
    }
}
