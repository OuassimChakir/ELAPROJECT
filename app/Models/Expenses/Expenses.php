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
        protected $fillable = ['designation','code'];


        //------------- select Expenses----------//
        public static function selectExpenses(){
                return Expenses::all();
        }

        public static function selectExpense($idExpense){
                return Expenses::find($idExpense);
        }
        // ------ Creation Expenses ----------- //
        public static function createExpense($designation,$code){
                Expenses::create([
                        'designation' => $designation,
                        'code' => $code,
                ]);
        }
        //------ Update Expense Type-----//
        public static function updateExpense($idExpense, $designation){
                $expenses = Expenses::find($idExpense);
                $expenses->designation = $designation;
                $expenses->save();
        }

        //------ Delete Expense Type-----//
        public static function deleteExpense($idExpense){
                Expenses::find($idExpense)->delete();
        }
}
