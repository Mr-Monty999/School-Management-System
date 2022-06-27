<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_jobs', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('job_name');
            $table->integer('school_id');
            $table->timestamps();
            
            $table->foreign('school_id', 'employees_jobs_ibfk_1')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees_jobs');
    }
}
