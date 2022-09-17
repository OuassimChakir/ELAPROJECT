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
                return $this::all();
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
