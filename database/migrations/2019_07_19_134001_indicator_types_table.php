<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndicatorTypesTable extends Migration
{
    public function up()
    {
        Schema::create('indicator_types', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 10);
        });
    }

    public function down()
    {
        Schema::dropIfExists('indicator_types');
    }
}
