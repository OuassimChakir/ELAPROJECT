<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('idGroup');
            $table->string('designation',50);
            $table->integer('capacity')->unsigned();
            $table->double('amount')->comment('Amount for each student to pay');
            $table->string('debutFormation',8);
            $table->string('finFormation',8);
            $table->bigInteger('idSubject',false,true);
            $table->bigInteger('idProfesseur',false,true)->nullable();
            $table->bigInteger('idGradeCategory',false,true)->nullable();
            $table->timestamps();
        });
        Schema::table('groups', function (Blueprint $table){
            $table->foreign('idSubject')->references('idSubject')->on('subjects');
            $table->foreign('idProfesseur')->references('idProfesseur')->on('professeurs');
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
        Schema::dropIfExists('groups');
    }
}
