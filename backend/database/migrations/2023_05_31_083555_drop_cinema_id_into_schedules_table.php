<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCinemaIdIntoSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
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
        Schema::table('schedules', function (Blueprint $table) {
            // Thêm lại khóa ngoại
            $table->foreign('cinema_id')->references('id')->on('cinemas')->onDelete('cascade');
        });
    }
}