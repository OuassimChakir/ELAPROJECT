<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_grades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idGrade',false,true);
            $table->bigInteger('idGroup',false,true);
        });
        Schema::table('group_grades', function (Blueprint $table){
            $table->foreign('idGrade')->references('idGrade')->on('grades');
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
        Schema::dropIfExists('group_grades');
    }
}
