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
    protected $fillable = ['datePayment', 'paymentMode', 'amount','amountPaid', 'note', 'etat','idElement','idStudent', 'idIncome', 'created_at', 'updated_at'];

    //------------- all Payment de incomes----------//
    public static function allPayment()
    {
        return Payment::select('*')
            ->join('incomes', 'incomes.idIncome', '=', 'payment.idIncome')
            ->get();
    }

    public static function getStudentPendingPaiment($idStudent){
        return Payment::select('*')
            ->join('incomes','payment.idIncome','=','incomes.idIncome')
            ->where('idStudent',$idStudent)
            ->where('etat',0)
            ->get();
    }

    public static function getStudentPaiment($idPayment){
        return Payment::select('*')
            ->join('incomes','payment.idIncome','=','incomes.idIncome')
            ->join('students','payment.idStudent','=','students.idStudent')
            ->where('idPayment',$idPayment)
            ->first();
    }

    //------ total amount
    public static function totalAmount()
    {
        return Payment::select()->get()->sum('amount');
    }


    // ---------- Total Amount for Each Month in the Scolare Year ---------- //
    public static function totalAmountIncomeMonth($firstYear, $secondYear)
    {
        return Payment::selectRaw('SUM(amount) AS amount, MONTH(datePayment) AS mois')
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
            ->join('students', 'students.idStudent', '=', 'payment.idStudent')
            ->where('payment.idStudent', $matricule)
            ->get();
    }


    //------------- create Payment ----------//         
    public static function createPayment($datePayment, $paymentMode, $amount, $description, $idStudent, $idIncome)
    {
        Payment::create([
            'datePayment' => $datePayment,
            'paymentMode' => $paymentMode,
            'amount' => $amount,
            'description' => $description,
            'idStudent' => $idStudent,
            'idIncome' => $idIncome,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    //------------- create student initial payments ----------//        
    public static function initialPayment($amount, $note, $idStudent, $idIncome, $etat = null)
    {
        Payment::create([
            'amount' => $amount,
            'note' => $note,
            'idStudent' => $idStudent,
            'idIncome' => $idIncome,
            'etat' => $etat,
            'created_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public static function initialGroupPayment($amount, $note, $idElement, $idIncome, $etat = null)
    {
        Payment::create([
            'amount' => $amount,
            'note' => $note,
            'idElement' => $idElement,
            'idIncome' => $idIncome,
            'etat' => $etat,
            'created_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
    
    /* ---------------------------------------
    / Payment of Student
    / ---------------------------------------*/
    public static function nbPayments($idStudent,$etat = 0){
        return Payment::where('idStudent',$idStudent)->where('etat',$etat)->count();
    }

    public static function validateStudentPaiment($idPayment,$numeroRecu,$datePayment,$amountPaid,$paymentMode){
        $paiment = Payment::find($idPayment);
        $paiment->numeroRecu = $numeroRecu;
        $paiment->datePayment = $datePayment;
        $paiment->amountPaid = $amountPaid;
        if($paiment->amount == $amountPaid)
            $paiment->etat = 1;
        $paiment->paymentMode = $paymentMode;
        $paiment->save();
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
