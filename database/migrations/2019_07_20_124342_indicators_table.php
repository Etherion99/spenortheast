<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndicatorsTable extends Migration
{
    public function up()
    {
        Schema::create('indicators', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->double('value', 6, 2);
            $table->tinyInteger('type')->unsigned();
            $table->timestamps();

            $table->foreign('type')->references('id')->on('indicator_types')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('indicators');
    }
}
