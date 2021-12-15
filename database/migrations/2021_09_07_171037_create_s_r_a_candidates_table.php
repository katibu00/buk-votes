<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSRACandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_r_a_candidates', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('election_id');
            $table->string('type');
            $table->integer('faculty_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->string('code');
            $table->integer('payment')->default(0);
            $table->integer('amount')->default(0);
            $table->integer('payment_id')->nullable();
            $table->integer('qualify')->default(0);
            $table->integer('qualify_id')->nullable();
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
        Schema::dropIfExists('s_r_a_candidates');
    }
}
