<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupelementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupelements', function (Blueprint $table) {
            $table->bigIncrements('idElement');
            $table->timestamps();
            $table->bigInteger('idGroup',false,true);
            $table->bigInteger('idStudent',false,true);
        });
        Schema::table('groupelements', function (Blueprint $table){
            $table->foreign('idGroup')->references('idGroup')->on('groups');
            $table->foreign('idStudent')->references('idStudent')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groupelements');
    }
}
