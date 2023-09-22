<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradescategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradescategories', function (Blueprint $table) {
            $table->bigIncrements('idGradeCategory');
            $table->string('category',50);
            $table->string('description',200)->nullable();
            $table->bigInteger('idCourseType',false,true);
            
        });
        Schema::table('gradescategories', function (Blueprint $table){
            $table->foreign('idCourseType')->references('idCourseType')->on('coursetype');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gradescategories');
    }
}
