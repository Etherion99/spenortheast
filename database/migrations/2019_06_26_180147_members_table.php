<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MembersTable extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 38);
            $table->string('position', 28);
            $table->enum('extension', ['jpg', 'jpeg', 'png']);
            $table->smallInteger('chapter')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('chapter')->references('id')->on('chapters')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('members');
    }
}
