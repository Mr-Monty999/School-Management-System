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
            $table->id();
            $table->string('subject_name')->index('subject_name');
            //$table->integer('class_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreignId('class_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            //$table->foreign('class_id', 'subjects_ibfk_3')->references('id')->on('classes')->onDelete('set NULL')->onUpdate('set NULL');
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
