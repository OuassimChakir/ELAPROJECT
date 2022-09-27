<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\responsible\Student;
use App\Models\Group;
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
        $revenus = [0,0,0,0,0,0,0,0,0,0,0,0];
        for($i = 0; $i<12; $i++){
            foreach($salesGraph as $month){
                switch ($month->mois) {
                    case 9: $revenus[0] = $month->amount; break;
                    case 10: $revenus[1] = $month->amount; break;
                    case 11: $revenus[2] = $month->amount; break;
                    case 12: $revenus[3] = $month->amount; break;
                    case 1: $revenus[4] = $month->amount; break;
                    case 2: $revenus[5] = $month->amount; break;
                    case 3: $revenus[6] = $month->amount; break;
                    case 4: $revenus[7] = $month->amount; break;
                    case 5: $revenus[8] = $month->amount; break;
                    case 6: $revenus[9] = $month->amount; break;
                    case 7: $revenus[10] = $month->amount; break;
                    case 8: $revenus[11] = $month->amount; break;                    
                }
            }
        }
        return view('home')->with('students',$students)
                           ->with('NumGroups',$NumGroups)
                           ->with('Payments',$Payments)
                           ->with('Factures',$Factures)
                           ->with('revenus',$revenus);
    }     

}
