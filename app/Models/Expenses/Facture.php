<?php

namespace App\Models\Expenses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Facture extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "expensepayment";
    protected $primaryKey = "idExpensePayment";  
    


        //------------- all facture de dépenses----------//
        public function allFacture(){
                return $this::select('*')
                        ->join('expenses','expenses.idExpense','=','expensepayment.idExpense')
                        ->get();
        }
        //------totalAmountExpense
        public function totalAmountExpense(){
                 return $this::select()->get()->sum('amout');
        }
        //------------- create facture ----------//         
        public function createFacture($datePayment,$amout,$description,$idStaff,$idExpense){
            $this->datePayment = $datePayment;
            $this->amout = $amout;
            $this->description = $description;
            $this->idStaff = $idStaff;
            $this->idExpense = $idExpense;
            $this->save();
        }
        // ---------- Total Amount for Each Month in the Scolare Year ---------- //
        public function totalAmountExepenseMonth($firstYear,$secondYear){
            return DB::table('expensepayment')
                ->selectRaw('SUM(amout) AS amount, MONTH(datePayment) AS mois')
                ->whereYear("datePayment",$firstYear)
                ->orWhereYear("datePayment",$secondYear)
                ->whereRaw("MONTH(datePayment) BETWEEN '09' AND '12'")
                ->orWhereRaw("MONTH(datePayment) BETWEEN '01' AND '08'")
                ->groupByRaw("MONTH(datePayment)")
                ->get();
        }
        

        // ---------- Select Facture for PDF Print ----------- //

        public function getFacturePdf($idExpensePayment){
            return $this::select('expensepayment.*','expenses.designation','expenses.code','staff.cnie','staff.nom','staff.prenom','staff.numTel')
                ->join('expenses','expensepayment.idExpense','=','expenses.idExpense')
                ->leftJoin('staff','expensepayment.idStaff','=','staff.idStaff')
                ->where('idExpensePayment',$idExpensePayment)
                ->first();
        }

        // --------- Delete Facture ----------------- //
        public function deleteFacture($idExpensePayment){
            $this::find($idExpensePayment)->delete();
        }

        // --------------- Archive Factures ------------------ //

        public function softDeletedFactures(){
            return $this::onlyTrashed()
            ->join('expenses','expenses.idExpense','=','expensepayment.idExpense')
            ->get();
        }

    
        public function getDeletedFacture($idExpensePayment){
            return $this::onlyTrashed()
                        ->where('expensepayment.idExpensePayment',$idExpensePayment)
                        ->where('expensepayment.idStaff',NULL)
                        ->first();
        }
    
        public function restoreFacture($idExpensePayment){
            $this::withTrashed()
                ->where('idExpensePayment',$idExpensePayment)
                ->restore();
        }
       
        public function forceDeleteFacture($idExpensePayment){
            $this::withTrashed()
                ->where('idExpensePayment',$idExpensePayment)
                ->forceDelete();
        }
}
