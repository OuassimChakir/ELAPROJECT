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
        $Staff = new Staff();
        $Subject = new Subjects();
        $StaffType = new Stafftype();
        $CourseType = new CourseType();
        $subjects = $Subject->getSubjects();
        $courseTypes = $CourseType->selectCourses();
        $staffTypes = $StaffType->getStaffTypes();
        $staffs = $Staff->getStaffs();
        if($request->has('addStaff')){
            $Staff->addStaff($request->cine,$request->prenom,$request->nom,$request->sexe,$request->email,$request->numTel,$request->idStaffType);
            if(session()->get('user')){
                $typeActivity = 0; 
                $activityDescription = 'Le étudiants'." ".$request->prenom." ".$request->nom;
                Activite::addActivity(session()->get('user')->id,$typeActivity,$activityDescription);
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
        $Staff = new Staff();
        $StaffType = new Stafftype();
        $staffInfo = $Staff->getStaff($idStaff);
        $staffTypes = $StaffType->getStaffTypes();
        return view('pages.staff.staffProfil')
                ->with('staff',$staffInfo)
                ->with('staffTypes',$staffTypes);
    }

    public function updateStaff(Request $request,$idStaff){
        $Staff = new Staff();
        $staffInfo = $Staff->getStaff($idStaff);
        if($request->has('updateStaff')){
            $Staff->updateStaff($idStaff,$request->cine,$request->prenom,$request->nom,$request->sexe,$request->email,$request->numTel,$request->idStaffType);
            if(session()->get('user')){
                $typeActivity = 2; 
                $activityDescription = 'Le étudiants'." ".$request->prenom." ".$request->nom."(".$idStaff.")";
                Activite::addActivity(session()->get('user')->id,$typeActivity,$activityDescription);
            }
            return Redirect::back()
                ->with('updateMessage',"La Modification est faite avec succès")
                ->with('staff',$staffInfo);
        }
    }

    public function deleteStaff(Request $request,$idStaff){
        $Staff = new Staff();
        $Staff->deleteStaff($idStaff);
        $staffs = $Staff->getStaffs();
        $st=$Staff->getDeletedStaff($idStaff);
        if(session()->get('user')){
            $typeActivity = 1; 
            $activityDescription = 'Le staff'." ".$st->prenom." ".$st->nom."(".$idStaff.")";
            Activite::addActivity(session()->get('user')->id,$typeActivity,$activityDescription);
        }
        return Redirect::route('staff.liste')
            ->with('deleteMessage',"La suppression est faite avec succès")
            ->with('staffs',$staffs);;
    }
// 0 = Ajout | 1 = Suppression | 2 = Modification | 3 = Réstauration | 10 = Suppression définitive
    public function deleteMultipleStaff(Request $request){
        $Staff = new Staff();
        if ($request->has('deleteAll')) {
            foreach($request->staffs as $idStaff){
                $Staff->deleteStaff($idStaff);
                $st=$Staff->getDeletedStaff($idStaff);
                if(session()->get('user')){
                    $typeActivity = 1; 
                    $activityDescription = 'Le staff'." ".$st->prenom." ".$st->nom."(".$idStaff.")";
                    Activite::addActivity(session()->get('user')->id,$typeActivity,$activityDescription);
                }
            }
            return Redirect::back()->with('deleteMessage',"Les Staffs séléctionés ont été supprimer");
        }else
            return Redirect::back();
    }

    // ----------- ARCHIVE ------------- //
    public function archive(){
        $Staff = new Staff();
        $staffs = $Staff->softDeletedStaffs();
        return view('pages.staff.staffArchive')->with('staffs',$staffs);
    }

    public function archivedStaff($idStaff){
        $Staff = new Staff();
        $staffInfo = $Staff->getDeletedStaff($idStaff);
        return view('pages.staff.archivedStaffProfil')->with('staff',$staffInfo);
    }

    public function restoreArchivedStaff($idStaff){
        $Staff = new Staff();
        $Staff->restoreStaff($idStaff);
        $staffs = $Staff->softDeletedStaffs();
        $st=$Staff->getStaff($idStaff);
        if(session()->get('user')){
            $typeActivity = 3; 
            $activityDescription = 'Le staff'." ".$st->prenom." ".$st->nom."(".$idStaff.")";
            Activite::addActivity(session()->get('user')->id,$typeActivity,$activityDescription);
        }
        return Redirect::route('staff.archive')->with('restoreMessage',"Le Staff a été restorer avec succès")->with('staffs',$staffs);
    }

    public function deleteArchivedStaff($idStaff){
        $Staff = new Staff();
        $st=$Staff->getDeletedStaff($idStaff);
        if(session()->get('user')){ 
            $typeActivity = 10; 
            $activityDescription = 'Le staff'." ".$st->prenom." ".$st->nom."(".$idStaff.")";
            Activite::addActivity(session()->get('user')->id,$typeActivity,$activityDescription);
        }
        $Staff->forceDeleteStaff($idStaff);
        return Redirect::route('staff.archive')->with('deleteMessage',"Le Staff a été supprimer Définitivement");
    }

    public function multipleArchivedStaff(Request $request){
        $Staff = new Staff();
        if($request->has('restoreAll')){
            foreach($request->archivedStaff as $idStaff){
                $Staff->restoreStaff($idStaff);
                $st=$Staff->getStaff($idStaff);
                if(session()->get('user')){
                    $typeActivity = 3; 
                    $activityDescription = 'Le staff'." ".$st->prenom." ".$st->nom."(".$idStaff.")";
                    Activite::addActivity(session()->get('user')->id,$typeActivity,$activityDescription);
                }
            }
            return Redirect::route('staff.archive')->with('restoreMessage',"Les Staffs séléctionés ont été restorer avec succès");
        }
        if($request->has('deleteAll')){
            foreach($request->archivedStaff as $idStaff){
                $st=$Staff->getDeletedStaff($idStaff);
                if(session()->get('user')){
                    $typeActivity = 10; 
                    $activityDescription = 'Le staff'." ".$st->prenom." ".$st->nom."(".$idStaff.")";
                    Activite::addActivity(session()->get('user')->id,$typeActivity,$activityDescription);
                }
                $Staff->forceDeleteStaff($idStaff);
            }
            return Redirect::route('staff.archive')->with('deleteMessage',"Les Staffs séléctionés ont été supprimer Définitivement");
        }
    }
}
