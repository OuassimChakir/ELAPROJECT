<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigIncrements('idGrade');
            $table->string('grade',50);
            $table->string('brev',10);
            $table->bigInteger('idGradeCategory',false,true);
        });
        Schema::table('grades', function (Blueprint $table) {
            $table->foreign('idGradeCategory')->references('idGradeCategory')->on('gradescategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
