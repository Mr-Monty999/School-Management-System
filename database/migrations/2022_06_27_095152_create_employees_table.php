<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('employe_name')->index('admin_name');
            $table->string('employe_address');
            $table->string('employe_phone');
            $table->double('employe_salary');
            $table->date('employe_birthdate');
            $table->date('employe_hiredate');
            $table->string('employe_genre');
            $table->string('employe_photo')->nullable();
            $table->integer('job_id')->nullable();
            $table->timestamps();

            $table->foreign('job_id', 'employees_ibfk_2')->references('id')->on('employees_jobs')->onDelete('set NULL')->onUpdate('set NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
