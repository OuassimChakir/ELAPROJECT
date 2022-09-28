<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\responsible\Student;
use App\Models\Group;
use App\Models\Attendance;
use App\Models\Incomes\Payment;
use App\Models\Expenses\Facture;
use DateTime;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    public function index(){
        // ---------------- Année Scolaire ----------- //
        if(!Storage::exists('anneeScolaire.txt')){
            $mois = intval(date('m'));
            if($mois >= 9 && $mois <= 12){
                $premierAnnee = intval(date('Y'));
                $deuxiemeAnne = $premierAnnee+1;
            }elseif($mois <= 1 && $mois <= 8){
                $deuxiemeAnne = intval(date('Y'));
                $premierAnnee = $deuxiemeAnne-1;
            }
            Storage::disk('local')->put('anneeScolaire.txt',$premierAnnee."\n".$deuxiemeAnne);
        }

        $student=new Student();
        $Group=new Group();
        $Attendance=new Attendance();
        $Payment=new Payment();
        $Facture=new Facture();
        $students=$student->totalStudents(); 
        $NumGroups=$Group->totalGroups(); 
        $Payments=$Payment->totalAmount();  
        $Factures=$Facture->totalAmountExpense();

        /* ------------------------------------
        / Graph Dépenses et Revenus
        / -------------------------------------*/
        $scolareYears = Storage::get('anneeScolaire.txt');
        $scolareYears = explode("\n",$scolareYears);
        $salesGraph = $Facture->totalAmountExepenseMonth($scolareYears[0],$scolareYears[1]);
        $salesGraphPayment = $Payment->totalAmountIncomeMonth($scolareYears[0],$scolareYears[1]);
        $depenses = [0,0,0,0,0,0,0,0,0,0,0,0];
        $inconespayment = [0,0,0,0,0,0,0,0,0,0,0,0];
        for($i = 0; $i<12; $i++){
            foreach($salesGraph as $month){
                switch ($month->mois) {
                    case 9: $depenses[0] = $month->amount; break;
                    case 10: $depenses[1] = $month->amount; break;
                    case 11: $depenses[2] = $month->amount; break;
                    case 12: $depenses[3] = $month->amount; break;
                    case 1: $depenses[4] = $month->amount; break;
                    case 2: $depenses[5] = $month->amount; break;
                    case 3: $depenses[6] = $month->amount; break;
                    case 4: $depenses[7] = $month->amount; break;
                    case 5: $depenses[8] = $month->amount; break;
                    case 6: $depenses[9] = $month->amount; break;
                    case 7: $depenses[10] = $month->amount; break;
                    case 8: $depenses[11] = $month->amount; break;                    
                }
            }
        }
        for($i = 0; $i<12; $i++){
            foreach($salesGraphPayment as $month){
                switch ($month->mois) {
                    case 9: $inconespayment[0] = $month->amount; break;
                    case 10: $inconespayment[1] = $month->amount; break;
                    case 11: $inconespayment[2] = $month->amount; break;
                    case 12: $inconespayment[3] = $month->amount; break;
                    case 1: $inconespayment[4] = $month->amount; break;
                    case 2: $inconespayment[5] = $month->amount; break;
                    case 3: $inconespayment[6] = $month->amount; break;
                    case 4: $inconespayment[7] = $month->amount; break;
                    case 5: $inconespayment[8] = $month->amount; break;
                    case 6: $inconespayment[9] = $month->amount; break;
                    case 7: $inconespayment[10] = $month->amount; break;
                    case 8: $inconespayment[11] = $month->amount; break;                    
                }
            }
        }
        $maxinconespayment=max($inconespayment);
        $maxdepenses=max($depenses);
        if($maxinconespayment >= $maxdepenses)
             $max=$maxinconespayment;
             else $max=$maxdepenses;


        // totalAbsenceMonth
        $Attendances = $Attendance->totalAbsenceMonth($scolareYears[0],$scolareYears[1]);
        $Absences = [0,0,0,0,0,0,0,0,0,0,0,0];
        $present = [0,0,0,0,0,0,0,0,0,0,0,0];
        for($i = 0; $i<12; $i++){
            foreach($Attendances as $month){
                if($month->etatabsence==0){
                switch ($month->mois) {
                    case 9: $Absences[0] = $month->absence; break;
                    case 10: $Absences[1] = $month->absence; break;
                    case 11: $Absences[2] = $month->absence; break;
                    case 12: $Absences[3] = $month->absence; break;
                    case 1: $Absences[4] = $month->absence; break;
                    case 2: $Absences[5] = $month->absence; break;
                    case 3: $Absences[6] = $month->absence; break;
                    case 4: $Absences[7] = $month->absence; break;
                    case 5: $Absences[8] = $month->absence; break;
                    case 6: $Absences[9] = $month->absence; break;
                    case 7: $Absences[10] = $month->absence; break;
                    case 8: $Absences[11] = $month->absence; break;                    
                }}
                elseif($month->etatabsence==1){
                    switch ($month->mois) {
                        case 9: $present[0] = $month->absence; break;
                        case 10: $present[1] = $month->absence; break;
                        case 11: $present[2] = $month->absence; break;
                        case 12: $present[3] = $month->absence; break;
                        case 1: $present[4] = $month->absence; break;
                        case 2: $present[5] = $month->absence; break;
                        case 3: $present[6] = $month->absence; break;
                        case 4: $present[7] = $month->absence; break;
                        case 5: $present[8] = $month->absence; break;
                        case 6: $present[9] = $month->absence; break;
                        case 7: $present[10] = $month->absence; break;
                        case 8: $present[11] = $month->absence; break;                    
                    }
                }
                
            }
            }
            $maxpresent=max($present);
            $maxAbsences=max($Absences);
            if($maxpresent >= $maxAbsences)
                 $maxAP=$maxpresent;
                 else $maxAP=$maxAbsences;
        
        return view('home')->with('students',$students)
                           ->with('NumGroups',$NumGroups)
                           ->with('Payments',$Payments)
                           ->with('Factures',$Factures)
                           ->with('scolareYears',$scolareYears)
                           ->with('depenses',$depenses)
                           ->with('inconespayment',$inconespayment)
                           ->with('present',$present)
                           ->with('Absences',$Absences)
                           ->with('max',$max)
                           ->with('maxAP',$maxAP);
    }     

}
