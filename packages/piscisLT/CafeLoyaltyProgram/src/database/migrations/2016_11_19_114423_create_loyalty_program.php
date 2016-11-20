<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateLoyaltyProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_loyalties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('points')->default(0);
            $table->integer('level')->default(0);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        Schema::create('loyalty_log', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('points');
            $table->string('action');
            $table->integer('loggable_id');
            $table->string('loggable_type');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_loyalties');
        Schema::drop('loyalty_log');
    }
}
