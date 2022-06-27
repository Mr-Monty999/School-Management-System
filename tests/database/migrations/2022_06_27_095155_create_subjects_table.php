<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('subject_name')->index('subject_name');
            $table->integer('class_id')->nullable();
            $table->integer('school_id');
            $table->timestamps();
            
            $table->foreign('class_id', 'subjects_ibfk_3')->references('id')->on('classes')->onDelete('set NULL')->onUpdate('set NULL');
            $table->foreign('school_id', 'subjects_ibfk_4')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
