<?php

namespace App\Models\Incomes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
        use HasFactory;
        protected $table = "incomes";
        protected $primaryKey = "idIncome";
        public $timestamps = false;
        protected $fillable = ['designation','description','activationDate', 'fixedAmount'];

        //------------- select Incomes----------//
        public static function allIncome()
        {
                return Income::all();
        }
        public static function getIncomeByDate($activationDate){
                return Income::select('*')->where('activationDate',$activationDate)->first();
        }
        public static function selectIncome($idIncome)
        {
                return Income::find($idIncome);
        }

        // ------ Selectionner les autres Revenus (Assurance + Inscription) ------- //
        public static function getInitialIncomes(){
                return Income::where('activationDate','00')->get();
        }
        
        // ------ Creation Incomes ----------- //
        public static function addIncome($designation, $description, $activationDate, $fixedAmount = null)
        {
                Income::create([
                        'designation' => $designation,
                        'description' => $description,
                        'activationDate' => $activationDate,
                        'fixedAmount' => $fixedAmount
                ]);
        }

        //----------- Update incomes Type -----------//
        public static function updateIncome($idIncome, $designation, $description, $activationDate = null, $fixedAmount = null)
        {
                $incomes = Income::find($idIncome);
                $incomes->designation = $designation;
                $incomes->activationDate = $activationDate;
                $incomes->description = $description;
                $incomes->fixedAmount = $fixedAmount;
                $incomes->save();
        }

        //---------- Delete Expense Type -------------//
        public static function deleteIncome($idIncome)
        {
                Income::find($idIncome)->delete();
        }
}
