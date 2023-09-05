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
    // Bisextil Method 
    public static function est_bissextile($annee)
    {
        return date("m-d", strtotime("$annee-02-29")) == "02-29";    
    }
   
     

    public function index(){
        // ---------------- Année Scolaire ----------- //
        //dd(session()->get("user"));
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
        $students=$student->totalStudents(); 
        $NumGroups=Group::totalGroups(); 
        $Payments=Payment::totalAmount();  
        $Factures=Facture::totalAmountExpense();

        /* ------------------------------------
        / Graph Dépenses et Revenus
        / -------------------------------------*/
        $scolareYears = Storage::get('anneeScolaire.txt');
        $scolareYears = explode("\n",$scolareYears);
        $salesGraph = Facture::totalAmountExepenseMonth($scolareYears[0],$scolareYears[1]);
        $salesGraphPayment = Payment::totalAmountIncomeMonth($scolareYears[0],$scolareYears[1]);
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

        /* ---------------------------------
        / Absence Activity CHART
        / ---------------------------------*/
        $currentMonth = date('m');
        $Attend = Attendance::totalAbsenceDay($scolareYears[0],$scolareYears[1],$currentMonth);
        // Fill Month Days
        $nombreJours = 0;
        switch ($currentMonth) {
            case '01': $nombreJours = 31; break;
            case '03': $nombreJours = 31; break;
            case '04': $nombreJours = 30; break;
            case '05': $nombreJours = 31; break;
            case '06': $nombreJours = 30; break;
            case '07': $nombreJours = 31; break;
            case '08': $nombreJours = 31; break;      
            case '09': $nombreJours = 30; break;
            case '10': $nombreJours = 31; break;
            case '11': $nombreJours = 30; break;
            case '12': $nombreJours = 31; break;              
        }
        if($currentMonth == '02'){
            if(HomeController::est_bissextile(date('Y')))
                $nombreJours = 29;
            else 
                $nombreJours = 28;
        }
        
        // Fill Arrays With Values
        $Absences = $present = array_fill(0,$nombreJours,0);
        foreach ($Attend as $value) {
            if($value->etatabsence == '0')
                $present[$value->day-1] = $value->absence;
            elseif($value->etatabsence == '1')
                $Absences[$value->day-1] = $value->absence;
        }

        $maxpresent=max($present);
        $maxAbsences=max($Absences);
        if($maxpresent >= $maxAbsences)
            $maxAP=$maxpresent;
        else 
            $maxAP=$maxAbsences;
        
        $days = [];
        foreach ($Absences as $key => $value) {
            $days[$key] = $key + 1;
        }
        // End Absences
    
        /* ---------------------------------
        / Groups Types CHART PIE
        / ---------------------------------*/
        // types Groupe
         $typesgroupes=Group::StatisticTypesGroupes();
         $tygroup = $nbTypeGroup = [];
         foreach($typesgroupes as $type){
                $tygroup[]=$type->course;
                $nbTypeGroup[]=$type->nbtypegroupes;
         }

        $chartjs = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 300, 'height' => 300])
        ->labels($tygroup)
        ->datasets([
            [
                'backgroundColor' => ['#FF6384', '#36A2EB',"8061ef", "#ffa128", "#7be6ff", "#93ff7b", "#f67bff"],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB',"8061ef", "#ffa128", "#7be6ff", "#93ff7b", "#f67bff"],
                'data' => $nbTypeGroup
            ]
        ])
        ->options([]);
        // dd($chartjs->get('datasets')[0]['backgroundColor']);
        
        // table de   facture 

        $allfacture=Facture::allFactureParDate();

        return view('home')->with('students',$students)
                           ->with('NumGroups',$NumGroups)
                           ->with('Payments',$Payments)
                           ->with('Factures',$Factures)
                           ->with('scolareYears',$scolareYears)
                           ->with('depenses',$depenses)
                           ->with('inconespayment',$inconespayment)
                           ->with('present',$present)
                           ->with('Absences',$Absences)
                           ->with('chartjs',$chartjs)
                           ->with('max',$max)
                           ->with('maxAP',$maxAP)
                           ->with('days',$days)
                           ->with('allfacture',$allfacture);
    }     

}
