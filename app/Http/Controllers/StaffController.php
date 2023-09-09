<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\Courses\CourseType;
use App\Models\Responsible\Staff;
use App\Models\Responsible\Stafftype;
use App\Models\Courses\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StaffController extends Controller
{    // Staff Controller
    public function staff(Request $request){
        $subjects =Subjects::getSubjects();
        $courseTypes =CourseType::selectCourses();
        $staffTypes =Stafftype::getStaffTypes();
        $staffs =staff::getStaffs();
        if($request->has('addStaff')){
            if(isset($request->cine)) $cine = $request->cine;
            else $cine = NULL;
            staff::addStaff($cine,$request->prenom,$request->nom,$request->sexe,$request->numTel,$request->idStaffType);
            if(session()->get('user')){
                $typeActivity = 0; 
                $activityDescription = 'Le étudiants'." ".$request->prenom." ".$request->nom;
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
            }
            return Redirect::back()
                            ->with('successMessage',"L'ajout est fait avec succès")
                            ->with('staffs',$staffs);
        }
        return view('pages.staff.staff')
                ->with('subjects',$subjects)
                ->with('staffTypes',$staffTypes)
                ->with('courseTypes',$courseTypes)
                ->with('staffs',$staffs);
    }

    public function staffProfil($idStaff){
        $staffInfo =staff::getStaff($idStaff);
        $staffTypes =Stafftype::getStaffTypes();
        return view('pages.staff.staffProfil')
                ->with('staff',$staffInfo)
                ->with('staffTypes',$staffTypes);
    }

    public function updateStaff(Request $request,$idStaff){
        $staffInfo =staff::getStaff($idStaff);
        if($request->has('updateStaff')){
            staff::updateStaff($idStaff,$request->cine,$request->nom,$request->prenom,$request->sexe,$request->numTel,$request->idStaffType);
            if(session()->get('user')){
                $typeActivity = 2; 
                $activityDescription = 'Le étudiants'." ".$request->prenom." ".$request->nom."(".$idStaff.")";
                Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
            }
            return Redirect::back()
                ->with('updateMessage',"La Modification est faite avec succès")
                ->with('staff',$staffInfo);
        }
    }

    public function deleteStaff($idStaff){
        staff::deleteStaff($idStaff);
        $staffs = staff::getStaffs();
        $st=staff::getDeletedStaff($idStaff);
        if(session()->get('user')){
            $typeActivity = 1; 
            $activityDescription = 'Le staff'." ".$st->prenom." ".$st->nom."(".$idStaff.")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
        }
        return Redirect::route('staff.liste')
            ->with('deleteMessage',"La suppression est faite avec succès")
            ->with('staffs',$staffs);
    }
// 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
    public function deleteMultipleStaff(Request $request){
        if ($request->has('deleteAll')) {
            foreach($request->staffs as $idStaff){
                staff::deleteStaff($idStaff);
                $st=staff::getDeletedStaff($idStaff);
                if(session()->get('user')){
                    $typeActivity = 1; 
                    $activityDescription = 'Le staff'." ".$st->prenom." ".$st->nom."(".$idStaff.")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
                }
            }
            return Redirect::back()->with('deleteMessage',"Les Staffs séléctionés ont été supprimer");
        }else
            return Redirect::back();
    }

    // ----------- ARCHIVE ------------- //
    public function archive(){
        $staffs = staff::softDeletedStaffs();
        return view('pages.staff.staffArchive')->with('staffs',$staffs);
    }

    public function archivedStaff($idStaff){
        $staffInfo = staff::getDeletedStaff($idStaff);
        return view('pages.staff.archivedStaffProfil')->with('staff',$staffInfo);
    }

    public function restoreArchivedStaff($idStaff){
        staff::restoreStaff($idStaff);
        $staffs = staff::softDeletedStaffs();
        $st=staff::getStaff($idStaff);
        if(session()->get('user')){
            $typeActivity = 3; 
            $activityDescription = 'Le staff'." ".$st->prenom." ".$st->nom."(".$idStaff.")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
        }
        return Redirect::route('staff.archive')->with('restoreMessage',"Le Staff a été restorer avec succès")->with('staffs',$staffs);
    }

    public function deleteArchivedStaff($idStaff){
        $st=staff::getDeletedStaff($idStaff);
        if(session()->get('user')){ 
            $typeActivity = 10; 
            $activityDescription = 'Le staff'." ".$st->prenom." ".$st->nom."(".$idStaff.")";
            Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
        }
        staff::forceDeleteStaff($idStaff);
        return Redirect::route('staff.archive')->with('deleteMessage',"Le Staff a été supprimer Définitivement");
    }

    public function multipleArchivedStaff(Request $request){
        if($request->has('restoreAll')){
            foreach($request->archivedStaff as $idStaff){
                staff::restoreStaff($idStaff);
                $st=staff::getStaff($idStaff);
                if(session()->get('user')){
                    $typeActivity = 3; 
                    $activityDescription = 'Le staff'." ".$st->prenom." ".$st->nom."(".$idStaff.")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
                }
            }
            return Redirect::route('staff.archive')->with('restoreMessage',"Les Staffs séléctionés ont été restorer avec succès");
        }
        if($request->has('deleteAll')){
            foreach($request->archivedStaff as $idStaff){
                $st=staff::getDeletedStaff($idStaff);
                if(session()->get('user')){
                    $typeActivity = 10; 
                    $activityDescription = 'Le staff'." ".$st->prenom." ".$st->nom."(".$idStaff.")";
                    Activite::addActivity(session()->get('user')->id, $typeActivity, $activityDescription,session()->get('user')->name);
                }
                staff::forceDeleteStaff($idStaff);
            }
            return Redirect::route('staff.archive')->with('deleteMessage',"Les Staffs séléctionés ont été supprimer Définitivement");
        }
    }
}
