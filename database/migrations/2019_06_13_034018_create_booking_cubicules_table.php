<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingCubiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_cubicules', function (Blueprint $table) {
            $table->bigInteger('id_schedules')->unsigned();
            $table->bigInteger('id_cubicules')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_schedules')->references('id')->on('schedules');         
            $table->foreign('id_cubicules')->references('id')->on('cubicules');
            $table->foreign('id_user')->references('id')->on('users');         
            $table->date("fecha");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_cubicules');
    }
}
