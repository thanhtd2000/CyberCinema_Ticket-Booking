<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCinemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('cinemas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('cinemas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->timestamps();
            $table->foreignId('area_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
        });
    }
}