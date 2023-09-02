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
    protected $fillable = ['datePayment', 'paymentMode', 'amount', 'description', 'matricule', 'idIncome', 'CREATED_AT', 'UPDATED_AT'];

    //------------- all Payment de incomes----------//
    public static function allPayment()
    {
        return Payment::select('*')
            ->join('incomes', 'incomes.idIncome', '=', 'payment.idIncome')
            ->get();
    }
    //------ total amount
    public static function totalAmount()
    {
        return Payment::select()->get()->sum('amount');
    }
    // ---------- Total Amount for Each Month in the Scolare Year ---------- //
    public static function totalAmountIncomeMonth($firstYear, $secondYear)
    {
        return DB::table('payment')
            ->selectRaw('SUM(amount) AS amount, MONTH(datePayment) AS mois')
            ->whereYear("datePayment", $firstYear)
            ->orWhereYear("datePayment", $secondYear)
            ->whereRaw("MONTH(datePayment) BETWEEN '09' AND '12'")
            ->orWhereRaw("MONTH(datePayment) BETWEEN '01' AND '08'")
            ->groupByRaw("MONTH(datePayment)")
            ->get();
    }
    //------------ find reçue by matricule-------- //
    public static function selectPayment($matricule)
    {
        return Payment::select('*')
            ->join('students', 'students.matricule', '=', 'payment.matricule')
            ->where('payment.matricule', $matricule)
            ->get();
    }
    //------------- create Payment ----------//         
    public static function createPayment($datePayment, $paymentMode, $amount, $description, $matricule, $idIncome)
    {
        Payment::create([
            'datePayment' => $datePayment,
            'paymentMode' => $paymentMode,
            'amount' => $amount,
            'description' => $description,
            'matricule' => $matricule,
            'idIncome' => $idIncome,
            'CREATED_AT' => date('Y-m-d H:i:s'),
            'UPDATED_AT' => date('Y-m-d H:i:s')
        ]);
    }
    // --------- Delete Payment ----------------- //
    public static function deletePayment($idPayment)
    {
        Payment::find($idPayment)->delete();
    }

    // --------------- Archive Payment ------------------ //

    public static function softDeletedPayment()
    {
        return Payment::onlyTrashed()
            ->join('incomes', 'incomes.idIncome', '=', 'payment.idIncome')
            ->get();
    }


    public static function getDeletedPayment($idPayment)
    {
        return Payment::onlyTrashed()
            ->where('payment.idPayment', $idPayment)
            ->where('payment.idIncome', NULL)
            ->first();
    }

    public static function restorePayment($idPayment)
    {
        Payment::withTrashed()
            ->where('idPayment', $idPayment)
            ->restore();
    }

    public static function forceDeletePayment($idPayment)
    {
        Payment::withTrashed()
            ->where('idPayment', $idPayment)
            ->forceDelete();
    }
}
