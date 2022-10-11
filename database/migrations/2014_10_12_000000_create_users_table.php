<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->BigIncrements('idUser');
            $table->string('name',100);
            $table->string('login',100);
            $table->string('password',50);
            $table->boolean('is_admin')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->integer('idRole')->nullable();
        });
    }
    // php artisan migrate --path=/database/migrations/2014_10_12_000000_create_users_table.php
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
