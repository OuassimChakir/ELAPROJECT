<?php

namespace App\Models\Expenses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $table = "expensepayment";
    protected $primaryKey = "idExpensePayment";  
    


        //------------- all facture de dépenses----------//
        public function allFacture(){
                return $this::select('*')
                        ->join('expenses','expenses.idExpense','=','expensepayment.idExpense')
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

        // --------------- Archive Factures ------------------ //

        public function softDeletedFactures(){
            return $this::onlyTrashed()->get();
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
