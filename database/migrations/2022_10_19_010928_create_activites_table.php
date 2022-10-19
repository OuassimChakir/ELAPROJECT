<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {
            $table->increments('idActivite');
            $table->string('typeActivite');
            $table->timestamps();
            $table->unsignedBigInteger('idUser');
            $table->string('description',100);
            $table->foreign('idUser')->references('id')->on('users');
        });
    }
    // php artisan migrate --path=database/migrations/2022_10_19_010928_create_activites_table.php
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activites');
    }
}
