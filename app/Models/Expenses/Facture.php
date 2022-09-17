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
}
