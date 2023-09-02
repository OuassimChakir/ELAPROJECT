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
        protected $fillable = ['designation','description','code'];

        //------------- select Incomes----------//
        public static function allIncome()
        {
                return Income::all();
        }
        public static function selectIncome($idIncome)
        {
                return Income::find($idIncome);
        }
        // ------ Creation Incomes ----------- //
        public static function addIncome($designation, $description, $code)
        {
                Income::create([
                        'designation' => $designation,
                        'description' => $description,
                        'code' => $code
                ]);
        }

        //----------- Update incomes Type -----------//
        public static function updateIncome($idIncome, $designation, $description, $code)
        {
                $incomes = Income::find($idIncome);
                $incomes->designation = $designation;
                $incomes->code = $code;
                $incomes->description = $description;
                $incomes->save();
        }

        //---------- Delete Expense Type -------------//
        public static function deleteIncome($idIncome)
        {
                Income::find($idIncome)->delete();
        }
}
