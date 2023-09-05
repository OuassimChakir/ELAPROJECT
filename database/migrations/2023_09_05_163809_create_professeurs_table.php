<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professeurs', function (Blueprint $table) {
            $table->bigIncrements('idProfesseur');
            $table->string('cnie',50)->nullable();
            $table->string('nom',50);
            $table->string('prenom',50);
            $table->string('numTel',50);
            $table->bigInteger('idSubject',false,true);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::table('professeurs', function (Blueprint $table){
            $table->foreign('idSubject')->references('idSubject')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professeurs');
    }
}
