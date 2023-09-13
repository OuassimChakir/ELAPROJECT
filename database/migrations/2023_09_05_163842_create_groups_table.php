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
            $table->integer('nbElements')->unsigned()->default(0);
            $table->double('amount')->comment('Amount for each student to pay');
            $table->date('debutFormation');
            $table->date('finFormation');
            $table->bigInteger('idSubject',false,true);
            $table->bigInteger('idProfesseur',false,true);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::table('groups', function (Blueprint $table){
            $table->foreign('idSubject')->references('idSubject')->on('subjects');
            $table->foreign('idProfesseur')->references('idProfesseur')->on('professeurs');
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
