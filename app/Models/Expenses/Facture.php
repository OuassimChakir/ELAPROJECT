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
    protected $table = "expensespayment";
    protected $primaryKey = "idExpensePayment";
    protected $fillable = ['datePayment','nom','prenom', 'amount', 'description', 'idStaff', 'idExpense','idProfesseur', 'created_at', 'updated_at','id'];

    //------------- all facture de dépenses----------//
    public static function allFacture(){
        return Facture::select('*')
            ->join('expenses', 'expenses.idExpense', '=', 'expensespayment.idExpense')
            ->get();
    }
    //------------- all facture de dépenses par date----------//
    public static function allFactureParDate(){
        return Facture::select('*')
            ->join('expenses', 'expenses.idExpense', '=', 'expensespayment.idExpense')
            ->orderBy('datePayment')
            ->get();
    }
    //------totalAmountExpense
    public static function totalAmountExpense(){
        return Facture::select()->get()->sum('amount');
    }

    public static function getFacturesByProf($idProfesseur){
        return Facture::select('*')
        ->join('expenses', 'expenses.idExpense', '=', 'expensespayment.idExpense')
        ->where('idProfesseur', $idProfesseur)
        ->orderBy('created_at','asc')
        ->get();
    }
    public static function getFacturesByStaff($idStaff){
        return Facture::select('*')
        ->join('expenses', 'expenses.idExpense', '=', 'expensespayment.idExpense')
        ->where('idStaff', $idStaff)
        ->orderBy('created_at','asc')
        ->get();
    }
    // update id Prof 
    public static function updateProfFacture($idExpensePayment){
        $paiment = Facture::find($idExpensePayment);
        $paiment->idProfesseur = null;
        $paiment->save();
        
    }
    // update  id staff
    public static function updateStaffFacture($idExpensePayment){
        $paiment = Facture::find($idExpensePayment);
        $paiment->idStaff = null;
        $paiment->save();
        
    }


    //------------- create facture ----------//         
    public static function createFacture($datePayment,$nom,$prenom, $amount, $description, $idStaff, $idProfesseur, $idExpense,$id){
        $facture = Facture::create([
            'datePayment' => $datePayment,
            'amount' => $amount,
            'nom' => $nom,
            'prenom' => $prenom,
            'description' => $description,
            'idStaff' => $idStaff,
            'idProfesseur' => $idProfesseur,
            'idExpense' => $idExpense,
            'id' => $id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return $facture->idExpensePayment;
    }
    // ---------- Total Amount for Each Month in the Scolare Year ---------- //
    public static function totalAmountExepenseMonth($firstYear, $secondYear){
        return DB::table('expensespayment')
            ->selectRaw('SUM(amount) AS amount, MONTH(datePayment) AS mois')
            ->whereYear("datePayment", $firstYear)
            ->orWhereYear("datePayment", $secondYear)
            ->whereRaw("MONTH(datePayment) BETWEEN '09' AND '12'")
            ->orWhereRaw("MONTH(datePayment) BETWEEN '01' AND '08'")
            ->groupByRaw("MONTH(datePayment)")
            ->get();
    }
    // ---------- Select Facture for PDF Print ----------- //

    public static function getFacturePdf($idExpensePayment){
        return Facture::select('*')
            ->join('expenses', 'expensespayment.idExpense', '=', 'expenses.idExpense')
            ->where('idExpensePayment', $idExpensePayment)
            ->first();
    }

    // --------- Delete Facture ----------------- //
    public static function deleteFacture($idExpensePayment){
        Facture::find($idExpensePayment)->delete();
    }

    // --------------- Archive Factures ------------------ //

    public static function softDeletedFactures(){
        return Facture::onlyTrashed()
            ->join('expenses', 'expenses.idExpense', '=', 'expensespayment.idExpense')
            ->get();
    }

    public static function getDeletedFacture($idExpensePayment){
        return Facture::onlyTrashed()
            ->where('expensespayment.idExpensePayment', $idExpensePayment)
            ->where('expensespayment.idStaff', NULL)
            ->first();
    }
    // get all facture archive by id staff ou id prof
    public static function getDeletedFacturebyIdStaff($idStaff){
        return Facture::onlyTrashed()
            ->where('idStaff', $idStaff)
            ->get();
    }
    public static function getDeletedFacturebyIdProf($idProfesseur){
        return Facture::onlyTrashed()
            ->where('idProfesseur', $idProfesseur)
            ->get();
    }


    public static function restoreFacture($idExpensePayment){
        Facture::withTrashed()
            ->where('idExpensePayment', $idExpensePayment)
            ->restore();
    }

    public static function forceDeleteFacture($idExpensePayment){
        Facture::withTrashed()
            ->where('idExpensePayment', $idExpensePayment)
            ->forceDelete();
    }
}
