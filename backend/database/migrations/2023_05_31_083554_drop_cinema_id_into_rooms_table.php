<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCinemaIdIntoRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Xóa khóa ngoại
            $table->dropForeign(['cinema_id']);

            // Xóa cột
            $table->dropColumn('cinema_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Thêm lại cột
            $table->foreignId('cinema_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
        });
    }
}