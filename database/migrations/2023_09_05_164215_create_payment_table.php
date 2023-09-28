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
            $table->string('numeroRecu',100)->nullable();
            $table->date('datePayment')->nullable();
            $table->string('paymentMode',50)->nullable();
            $table->double('amount')->nullable();
            $table->double('amountPaid')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('etat')->nullable()->comment('NULL (Disactivated)
            0 (Activated)
            1 (Payed)');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('idGroup',false,true)->nullable();
            $table->bigInteger('idStudent',false,true)->nullable();
            $table->bigInteger('idIncome',false,true);
        });
        Schema::table('payment', function (Blueprint $table){
            $table->foreign('idGroup')->references('idGroup')->on('groups');
            $table->foreign('idStudent')->references('idStudent')->on('students');
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
