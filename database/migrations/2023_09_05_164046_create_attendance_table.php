<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->bigIncrements('idAttendance');
            $table->tinyInteger('absence')->nullable();
            $table->date('dateAbsence');
            $table->timestamps();
            $table->unsignedBigInteger('idStudent',false,true);
            $table->unsignedBigInteger('idGroup',false,true);
        });
        Schema::table('attendance', function (Blueprint $table){
            $table->foreign('idStudent')->references('idStudent')->on('students');
            $table->foreign('idGroup')->references('idGroup')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance');
    }
}
