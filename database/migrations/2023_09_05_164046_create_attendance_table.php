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
            $table->text('note')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('idElement',false,true);
        });
        Schema::table('attendance', function (Blueprint $table){
            $table->foreign('idElement')->references('idElement')->on('groupelements');
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
