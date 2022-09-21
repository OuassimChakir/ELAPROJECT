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


        //------------- select Incomes----------//
        public function allIncome(){
                return $this::all();
        }
        public function selectIncome($idIncome){
                return $this::find($idIncome);
        }
        // ------ Creation Incomes ----------- //
        public function addIncome($designation,$description,$code){
                $this->designation = $designation;
                $this->description = $description;
                $this->code = $code;
                $this->save();
        }

        //----------- Update incomes Type -----------//
        public function updateIncome($idIncome,$designation,$description,$code){
        $incomes = $this::find($idIncome);
        $incomes->designation=$designation;
        $incomes->code=$code;
        $incomes->description=$description;
        $incomes->save();
        }
        
        //---------- Delete Expense Type -------------//
        public function deleteIncome($idIncome){
        $this::find($idIncome)->delete();
        }

}
