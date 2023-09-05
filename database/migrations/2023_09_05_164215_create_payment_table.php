<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('idPayment');
            $table->date('datePayment');
            $table->string('paymentMode',50);
            $table->double('amount');
            $table->text('note')->nullable();
            $table->tinyInteger('etat')->nullable();
            $table->timestamps();
            $table->bigInteger('idElement',false,true)->nullable();
            $table->bigInteger('idIncome',false,true);
        });
        Schema::table('payment', function (Blueprint $table){
            $table->foreign('idElement')->references('idElement')->on('groupelemnts');
            $table->foreign('idIncome')->references('idIncome')->on('incomes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
}
