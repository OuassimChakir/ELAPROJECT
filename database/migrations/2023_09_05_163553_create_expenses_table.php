<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('idExpense');
            $table->string('designation',100);
            $table->tinyInteger('code')->nullable()->comment('NULL (expenses)
            0 (staff)
            1 (professur)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}

//php artisan migrate:refresh --path="database\migrations\2023_09_05_163553_create_expenses_table.php"
