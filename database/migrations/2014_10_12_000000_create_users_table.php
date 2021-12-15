<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nickname')->nullable();
            $table->string('email')->unique();
            $table->string('reg_number')->unique()->nullable();
            $table->string('role')->default('voter');
            $table->string('elcom_id')->nullable();
            $table->integer('faculty_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('cgpa')->nullable();
            $table->integer('level')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->date('dob')->nullable();
            $table->string('image')->default('default.png');
            $table->string('phone')->nullable();
            $table->string('state')->nullable();
            $table->string('lga')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
