<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incomes\Income;
use App\Models\Incomes\Payment;
use App\Models\responsible\Student;
use Illuminate\Support\Facades\Redirect;

class IncomesController extends Controller
{
    //

            //-------------- List of Incomes Types ---------------- //
            public function allIncomes(Request $request){
                $Income = new Income();
                // List of Income
                $Incomes = $Income->allIncome();
                // add income
                if($request->has('ajouterIncome')){
                    $designation = $request->designation;
                    $code = $request->code;
                    $description = $request->description;
                    $Income->addIncome($designation,$description,$code);
                    return Redirect::back()->with('successMessage',"L'ajout est fait avec succès");
                }
                return view('pages.incomes.income')->with('Incomes',$Incomes);
                }
                // ---------------delete Income------//
                public function deleteIncome(Request $request,$idIncome){
                    $Income = new Income();
                    $Income->deleteIncome($idIncome);
                    $Incomes = $Income->allIncome();
                    return Redirect::route('typeIncome')
                        ->with('deleteMessage',"La suppression est faite avec succès")
                        ->with('Incomes',$Incomes);
                }
                // ---------------Update Income-----//
                public function updateIncome(Request $request,$idIncome){
                    $Income = new Income();
                    $Incomes = $Income->allIncome();
                    $updatedIncome = $Income->selectIncome($idIncome);
                    if($request->has('updateIncome')){ 
                        $Income->updateIncome($idIncome,$request->designation,$request->code,$request->description);
                        return Redirect::route('typeIncome')
                            ->with('updateMessage',"La Modification est faite avec succès")
                            ->with('Incomes',$Incomes);
                    }
                    return view('pages.incomes.updatetypeIncome')
                            ->with('updatedIncome',$updatedIncome);
                }

                //-------------------Income de Payment----------------------//
            //-------------- List of Payment  ---------------- //
            public function allPayment(Request $request){
                $Payment = new Payment();
                $Income = new Income();
                $Student = new Student();
                $students=$Student->getStudents();

                // List of Payment
                $Incomes = $Income->allIncome();
                // list of Payment
                $incomePayment = $Payment->allPayment();


                if($request->has('addPayment')){                  

                            $datePayment = $request->datePayment;
                            $paymentMode = $request->paymentMode;  
                            $amout = $request->amout;
                            $description = $request->description;
                            $idIncome = $request->idIncome;
                            $matricule = $request->matricule;
                            $Payment->createPayment($datePayment,$paymentMode,$amout,$description,$matricule,$idIncome);
                            return Redirect::back()->with('successMessage',"L'ajout est fait avec succès");
                }
                return view('pages.incomes.incomePayment')
                      ->with('incomePayment',$incomePayment)
                      ->with('incomes',$Incomes);
            }

}
