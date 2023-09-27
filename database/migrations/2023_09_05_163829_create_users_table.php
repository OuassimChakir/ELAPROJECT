<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->unsignedBigInteger('idRole',false,true);
            $table->unsignedBigInteger('idStaff',false,true)->nullable();
            $table->unsignedBigInteger('idProfesseur',false,true)->nullable();
            $table->unsignedBigInteger('idResponsible',false,true)->nullable();
            $table->unsignedBigInteger('idStudent',false,true)->nullable();
            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
        });
        Schema::table('users', function (Blueprint $table){
            $table->foreign('idRole')->references('idRole')->on('roles');
            $table->foreign('idStaff')->references('idStaff')->on('staffs');
            $table->foreign('idProfesseur')->references('idProfesseur')->on('professeurs');
            $table->foreign('idResponsible')->references('idResponsible')->on('responsibles');
            $table->foreign('idStudent')->references('idStudent')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
