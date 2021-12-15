<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_checks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('profile');
            $table->boolean('picture')->default(false);
            $table->integer('election_id')->nullable();
            $table->integer('post_id')->nullable();
            $table->integer('docs')->default(0);
            $table->integer('payment')->default(0);
            $table->integer('amount')->nullable();
            $table->integer('qualify')->nullable();
            $table->integer('progress')->default(0);
            $table->integer('payment_id')->nullable();
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
        Schema::dropIfExists('form_checks');
    }
}
