<?php

namespace App\Http\Controllers;

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
            return Redirect::back()
                ->with('updateMessage',"La Modification est faite avec succès")
                ->with('staff',$staffInfo);
        }
    }

    public function deleteStaff(Request $request,$idStaff){
        $Staff = new Staff();
        $Staff->deleteStaff($idStaff);
        $staffs = $Staff->getStaffs();
        return Redirect::route('staff.liste')
            ->with('deleteMessage',"La suppression est faite avec succès")
            ->with('staffs',$staffs);;
    }

    public function deleteMultipleStaff(Request $request){
        $Staff = new Staff();
        if ($request->has('deleteAll')) {
            foreach($request->staffs as $idStaff){
                $Staff->deleteStaff($idStaff);
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
        return Redirect::route('staff.archive')->with('restoreMessage',"Le Staff a été restorer avec succès")->with('staffs',$staffs);
    }

    public function deleteArchivedStaff($idStaff){
        $Staff = new Staff();
        $Staff->forceDeleteStaff($idStaff);
        return Redirect::route('staff.archive')->with('deleteMessage',"Le Staff a été supprimer Définitivement");
    }

    public function multipleArchivedStaff(Request $request){
        $Staff = new Staff();
        if($request->has('restoreAll')){
            foreach($request->archivedStaff as $idStaff){
                $Staff->restoreStaff($idStaff);
            }
            return Redirect::route('staff.archive')->with('restoreMessage',"Les Staffs séléctionés ont été restorer avec succès");
        }
        if($request->has('deleteAll')){
            foreach($request->archivedStaff as $idStaff){
                $Staff->forceDeleteStaff($idStaff);
            }
            return Redirect::route('staff.archive')->with('deleteMessage',"Les Staffs séléctionés ont été supprimer Définitivement");
        }
    }
}
