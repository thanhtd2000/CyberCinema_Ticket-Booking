<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('seats');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id');
            $table->string('seat_row');
            $table->string('seat_column');
            $table->integer('room_id');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }
}