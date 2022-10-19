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
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('idActivity');
            $table->string('typeActivity',100);
            $table->unsignedBigInteger('idUser');
            $table->string('description',100);
            $table->timestamps();
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
        Schema::dropIfExists('activities');
    }
}
