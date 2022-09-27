<?php

namespace App\Models\Incomes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "payment";
    protected $primaryKey = "idPayment";  

        //------------- all Payment de incomes----------//
        public function allPayment(){
                return $this::select('*')
                        ->join('incomes','incomes.idIncome','=','payment.idIncome')
                        ->get();
        }
        //------ total amount
        public function totalAmount(){
            return $this::select()->get()->sum('amout');
         }
        // ---------- Total Amount for Each Month in the Scolare Year ---------- //
        public function totalAmountIncomeMonth($firstYear,$secondYear){
                return DB::table('payment')
                        ->selectRaw('SUM(amout) AS amount, MONTH(datePayment) AS mois')
                        ->whereYear("datePayment",$firstYear)
                        ->orWhereYear("datePayment",$secondYear)
                        ->whereRaw("MONTH(datePayment) BETWEEN '09' AND '12'")
                        ->orWhereRaw("MONTH(datePayment) BETWEEN '01' AND '08'")
                        ->groupByRaw("MONTH(datePayment)")
                        ->get();
                        
        } 
        //------------ find reçue by matricule-------- //
        public function selectPayment($matricule){
            return $this::select('*')
            ->join('students','students.matricule','=','payment.matricule')
            ->where('payment.matricule',$matricule)
            ->get();
        }
        //------------- create Payment ----------//         
        public function createPayment($datePayment,$paymentMode,$amout,$description,$matricule,$idIncome){
            $this->datePayment = $datePayment;
            $this->paymentMode = $paymentMode; 	 
            $this->amout = $amout;
            $this->description = $description;
            $this->matricule = $matricule;
            $this->idIncome = $idIncome;
            $this->save(); 
        }
        // --------- Delete Payment ----------------- //
        public function deletePayment($idPayment){
            $this::find($idPayment)->delete();
        }

       // --------------- Archive Payment ------------------ //

        public function softDeletedPayment(){
            return $this::onlyTrashed()
            ->join('incomes','incomes.idIncome','=','payment.idIncome')
            ->get();
        }


        public function getDeletedPayment($idPayment){
            return $this::onlyTrashed()
                    ->where('payment.idPayment',$idPayment)
                    ->where('payment.idIncome',NULL)
                    ->first();
        }

        public function restorePayment($idPayment){
         $this::withTrashed()
            ->where('idPayment',$idPayment)
            ->restore();
        }
   
        public function forceDeletePayment($idPayment){
              $this::withTrashed()
            ->where('idPayment',$idPayment)
            ->forceDelete();
        }
}
