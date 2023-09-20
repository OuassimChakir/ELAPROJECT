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
        protected $fillable = ['datePayment', 'paymentMode', 'amount','amountPaid', 'note', 'etat','idGroup','idStudent', 'idIncome', 'created_at', 'updated_at'];

    //------------- all Payment de incomes----------//
    public static function allPayment()
    {
        return Payment::select('*')
            ->join('incomes', 'incomes.idIncome', '=', 'payment.idIncome')
            ->get();
    }

    public static function getStudentPendingPaiment($idStudent){
        return Payment::selectRaw('payment.*, groups.idGroup, groups.designation, groups.debutFormation, groups.finFormation, incomes.designation as incomesDesignation, incomes.description, incomes.activationDate')
            ->join('incomes','payment.idIncome','=','incomes.idIncome')
            ->leftjoin('groups','payment.idGroup','=','groups.idGroup')
            ->where('idStudent',$idStudent)
            ->where('etat',0)
            ->get();
    }

    public static function getStudentPaiment($idPayment){
        return Payment::select('payment.*','students.*','incomes.*','groups.designation as groupDesignation','incomes.designation as incomeDesignation')
            ->join('incomes','payment.idIncome','=','incomes.idIncome')
            ->join('students','payment.idStudent','=','students.idStudent')
            ->leftjoin('groups','payment.idGroup','=','groups.idGroup')
            ->where('idPayment',$idPayment)
            ->first();
    }
        //------------ find reçue by idStudent & idGroup-------- //
        public static function selectPayment($idGroup, $idStudent, $idIncome)
        {
            return Payment::select('*')
                ->join('incomes','payment.idIncome','=','incomes.idIncome')
                ->join('students','payment.idStudent','=','students.idStudent')
                ->join('groups','payment.idGroup','=','groups.idGroup')
                ->where('payment.idStudent', $idStudent)
                ->where('payment.idGroup', $idGroup)
                ->where('payment.idIncome', $idIncome)
                ->first();
        }


    // Select Last 10 Paiements of a Students
    public static function getStudentLastestPaiments($idStudent, $idGroup = null){
        // null (Random) | 0 (Other Paiments) | >=1 Group Paiments
        if(is_null($idGroup)){
            // Random Last 10 Groups
            return Payment::select('*','groups.designation as groupsDesignation','payment.amount')
                ->leftjoin('groups','payment.idGroup','=','groups.idGroup')
                ->join('incomes','incomes.idIncome','=','payment.idIncome')
                ->where('idStudent',$idStudent)
                ->whereNotNull('etat')
                ->orderBy('datePayment')
                ->skip(0)
                ->take(10)
                ->get();
        }elseif($idGroup == 0){
            // 10 last Paiment, groups not included
            return Payment::select('*','incomes.designation as incomeDesignation','payment.amount')
                ->join('incomes','incomes.idIncome','=','payment.idIncome')
                ->where('idStudent',$idStudent)
                ->whereNotNull('etat')
                ->whereNull('payment.idGroup')
                ->orderBy('datePayment')
                ->get();
        }else{
            // 10 last paiment, only group paiments
            return Payment::select('*','incomes.designation as incomeDesignation','payment.amount')
            ->join('groups','payment.idGroup','=','groups.idGroup')
            ->join('incomes','incomes.idIncome','=','payment.idIncome')
            ->where('idStudent',$idStudent)
            ->where('payment.idGroup',$idGroup)
            ->whereNotNull('etat')
            ->orderBy('datePayment')
            ->get();
        }
    }
    public static function checkElementPaiment($idGroup, $idStudent, $idIncome){
        return Payment::select('*')
            ->where('idGroup',$idGroup)
            ->where('idStudent',$idStudent)
            ->where('idIncome',$idIncome)
            ->count();
    }

    public static function getElementActivatedPaiment($idGroup, $idStudent, $idIncome){
        return Payment::select('*')
            ->where('idGroup',$idGroup)
            ->where('idStudent',$idStudent)
            ->where('idIncome',$idIncome)
            ->where('etat',0)
            ->first();
    }

    public static function activatePaiment($idGroup, $idStudent, $month){
        $paiment = Payment::select('*')
            ->join('incomes','payment.idIncome','=','incomes.idIncome')
            ->where('idGroup',$idGroup)
            ->where('idStudent',$idStudent)
            ->where('activationDate',$month)
            ->first();
        $paiment->etat = 0;
        $paiment->save();
    }

    public static function disactivatePaiment($idPayment){
        $paiment = Payment::find($idPayment);
        $paiment->etat = null;
        $paiment->save();
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

    public static function initialGroupPayment($amount, $note, $idGroup, $idStudent, $idIncome, $etat = null)
    {
        Payment::create([
            'amount' => $amount,
            'note' => $note,
            'idGroup' => $idGroup,
            'idStudent' => $idStudent,
            'idIncome' => $idIncome,
            'etat' => $etat,
            'created_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public static function pendingGroupPaiments($idGroup,$idStudent){
        return Payment::select('*')
                ->join('incomes','incomes.idIncome','=','payment.idIncome')
                ->where('idStudent',$idStudent)
                ->where('idGroup',$idGroup)
                ->where('activationDate','!=','00')
                ->whereNotNull('activationDate')
                ->get();
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

    public static function deleteDisactivatedPaiments($idGroup,$idStudent){
        Payment::where('idGroup',$idGroup)->where('idStudent',$idStudent)->whereNull('etat')->forceDelete();
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
