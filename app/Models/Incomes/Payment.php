<?php

namespace App\Models\Incomes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payment";
    protected $primaryKey = "idPayment";  

        //------------- all facture de incomes----------//
        public function allPayment(){
                return $this::select('*')
                        ->join('incomes','incomes.idIncome','=','payment.idIncome')
                        ->get();
        }
        //------------- create facture ----------//         
        public function createPayment($datePayment,$paymentMode,$amout,$description,$matricule,$idIncome){
            $this->datePayment = $datePayment;
            $this->paymentMode = $paymentMode; 	 
            $this->amout = $amout;
            $this->description = $description;
            $this->matricule = $matricule;
            $this->idIncome = $idIncome;
            $this->save();
    }

      
}
