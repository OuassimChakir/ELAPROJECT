<?php

namespace App\Models\Expenses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $table = "expenses";
    protected $primaryKey = "idExpense";  
    public $timestamps = false;


        //------------- select Expenses----------//
        public function selectExpenses(){
                return $this::all();
        }

        public function selectExpense($idExpense){
                return $this::find($idExpense);
        }
                // ------ Creation Expenses ----------- //
        public function createExpense($designation,$code,$description){
                $this->designation = $designation;
                $this->code = $code;
                $this->description = $description;
                $this->save();
        }
        //------ Update Expense Type-----//
        public function updateExpense($idExpense,$designation,$code,$description){
        $expenses = $this::find($idExpense);
        $expenses->designation = $designation;
        $expenses->code = $code;
        $expenses->description = $description;
        $expenses->save();
        }

        //------ Delete Expense Type-----//
        public function deleteExpense($idExpense){
        $this::find($idExpense)->delete();
        }


}


