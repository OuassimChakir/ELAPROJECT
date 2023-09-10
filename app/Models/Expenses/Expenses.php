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
        protected $fillable = ['description','code'];


        //------------- select Expenses----------//
        public static function selectExpenses(){
                return Expenses::all();
        }

        public static function selectExpense($idExpense){
                return Expenses::find($idExpense);
        }
        // ------ Creation Expenses ----------- //
        public static function createExpense($description,$code){
                Expenses::create([
                        'description' => $description,
                        'code' => $code,
                ]);
        }
        //------ Update Expense Type-----//
        public static function updateExpense($idExpense, $description){
                $expenses = Expenses::find($idExpense);
                $expenses->description = $description;
                $expenses->save();
        }

        //------ Delete Expense Type-----//
        public static function deleteExpense($idExpense){
                Expenses::find($idExpense)->delete();
        }
}
