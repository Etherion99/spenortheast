<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title', 88);
            $table->text('description');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->enum('extension', ['jpg', 'jpeg', 'png']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
