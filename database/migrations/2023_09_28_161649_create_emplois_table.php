<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emplois', function (Blueprint $table) {
            $table->bigIncrements('idEmploi');
            $table->string('jour',50);
            $table->time('debut');
            $table->time('fin');
            $table->bigInteger('idGroup',false,true);
        });
        Schema::table('emplois', function(Blueprint $table) {
            $table->foreign('idGroup')->references('idGroup')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emplois');
    }
}
