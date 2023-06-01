<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnImageInActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actors', function (Blueprint $table) {
            $table->string('image', 1000)->change();

        });
        Schema::table('directors', function (Blueprint $table) {
            $table->string('image', 1000)->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actors', function (Blueprint $table) {
            $table->string('image')->nullable()->change();

        });
        Schema::table('directors', function (Blueprint $table) {
            $table->string('image')->nullable()->change();

        });
    }
}