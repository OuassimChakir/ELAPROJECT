<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->bigIncrements('idStaff');
            $table->string('cnie',50);
            $table->string('nom',50);
            $table->string('prenom',50);
            $table->string('numTel',50);
            $table->bigInteger('idStaffType',false,true);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::table('staffs', function (Blueprint $table){
            $table->foreign('idStaffType')->references('idStaffType')->on('stafftype');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}
