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
            $table->unsignedBigInteger('matricule', false)->primary(); 
            $table->primary('matricule');
            $table->string('nom_fr');
            $table->string('nom_ar');
            $table->string('prenom_fr');
            $table->string('prenom_ar');
            $table->string('cnie');
            $table->string('email');
            $table->string('numTel');
            $table->string('sexe');
            $table->string('adresse');
            $table->string('dateNaissance');
            $table->string('idResponsible')->nullable();
            $table->timestamps();
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
