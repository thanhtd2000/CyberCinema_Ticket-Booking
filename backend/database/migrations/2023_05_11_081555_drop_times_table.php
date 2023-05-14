<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('times');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->integer('movie_id');
            $table->integer('room_id');
            $table->date('show_date');
            $table->time('start_time');
            $table->timestamps();
        });
    }
}