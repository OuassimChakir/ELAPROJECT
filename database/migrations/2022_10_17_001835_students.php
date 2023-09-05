<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) 
        {
            $table->bigIncrements('idStudent'); 
            $table->string('matricule',50)->unique();
            $table->string('nom_fr');
            $table->string('nom_ar')->nullable();
            $table->string('prenom_fr');
            $table->string('prenom_ar')->nullable();
            $table->string('cnie')->nullable();
            $table->string('numTel');
            $table->string('sexe');
            $table->string('adresse')->nullable();
            $table->date('dateNaissance')->nullable();
            $table->timestamps();
            $table->bigInteger('idResponsible',false,true)->nullable();
        });
        Schema::table('students', function (Blueprint $table){
            $table->foreign('idResponsible')->references('idResponsible')->on('responsibles');
        });
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
