<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            //$table->string('permission', 100)->nullable();
            //$table->string('user_type');
            $table->string('password');
            //$table->integer("student_id")->nullable()->unsigned();
            //$table->integer("teacher_id")->nullable()->unsigned();
            //$table->integer("employe_id")->nullable()->unsigned();
            $table->foreignId('student_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('teacher_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('employe_id')->nullable()->constrained('employees')->cascadeOnUpdate()->cascadeOnDelete();


            $table->rememberToken();
            $table->timestamps();

            //$table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete()->cascadeOnUpdate();
            //$table->foreign('teacher_id')->references('id')->on('teachers')->cascadeOnDelete()->cascadeOnUpdate();
            //$table->foreign('employe_id')->references('id')->on('employees')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
