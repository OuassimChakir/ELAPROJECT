<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensespaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expensespayment', function (Blueprint $table) {
            $table->bigIncrements('idExpensePayment');
            $table->string('InvoiceNumber',50);
            $table->string('name',50);
            $table->date('datePayment',50);
            $table->double('amount');
            $table->text('description');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('idStaff',false,true)->nullable();
            $table->bigInteger('idProfesseur',false,true)->nullable();
            $table->bigInteger('idExpense',false,true);
        });
        Schema::table('expensespayment', function (Blueprint $table){
            $table->foreign('idStaff')->references('idStaff')->on('staffs');
            $table->foreign('idProfesseur')->references('idProfesseur')->on('professeurs');
            $table->foreign('idExpense')->references('idExpense')->on('expenses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expensespayment');
    }
}
