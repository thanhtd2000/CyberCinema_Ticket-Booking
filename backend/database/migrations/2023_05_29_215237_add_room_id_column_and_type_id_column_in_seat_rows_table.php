<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoomIdColumnAndTypeIdColumnInSeatRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seat_rows', function (Blueprint $table) {
            $table->integer('type_id');
            $table->integer('room_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seat_rows', function (Blueprint $table) {
            $table->dropColumn('type_id');
            $table->dropColumn('room_id');
        });
    }
}