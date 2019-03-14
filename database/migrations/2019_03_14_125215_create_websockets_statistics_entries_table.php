<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebSocketsStatisticsEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('websockets_statistics_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('app_id');
            $table->integer('peak_connection_count'); // count of connections
            $table->integer('websocket_message_count'); // count of websocket messages
            $table->integer('api_message_count'); // count of API messages that we have received
            $table->nullableTimestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('websockets_statistics_entries');
    }
}
