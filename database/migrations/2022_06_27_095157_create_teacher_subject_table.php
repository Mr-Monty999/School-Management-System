<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_subject', function (Blueprint $table) {
            //$table->integer('teacher_id')->unsigned();
            //$table->integer('subject_id')->unsigned();
            $table->foreignId('teacher_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();

            //$table->primary(['teacher_id', 'subject_id']);
            //$table->foreign('teacher_id', 'teacher_subject_ibfk_1')->references('id')->on('teachers')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('subject_id', 'teacher_subject_ibfk_2')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_subject');
    }
}
