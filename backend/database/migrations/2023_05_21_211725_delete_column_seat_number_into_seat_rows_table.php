<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnSeatNumberIntoSeatRowsTable extends Migration
{
    public function up()
    {
        Schema::table('seat_rows', function (Blueprint $table) {
            $table->dropColumn('seat_number');
            $table->dropColumn('seat_type_id');
            $table->dropColumn('room_id');
        });
    }
    
    public function down()
    {
        Schema::table('seat_rows', function (Blueprint $table) {
            $table->integer('seat_number');
            $table->integer('seat_type_id');
            $table->integer('room_id');
        });
    }
}
