<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = "setting ";
    protected $primaryKey = "idSetting";
    public $timestamps = false;                               

        //------------- select info logo----------//
        public function selectLogo(){
            return $this::all();
        }
        // ------ Creation ----------- //
        public function createLogo($title,$logo){

            
                $this->title = $title ;
                $this->logo = $logo;
                $this->save();
        }
    
        // --------- Update ------------- //
        public function updateLogo($idSetting,$title,$logo){
                $group = $this::find($idSetting);
                $this->title = $title ;
                $this->logo = $logo;
                $group->save();
        }
        //------------ Delete ------------//
        public function deleteLogo($idSetting){
        $this::find($idSetting)->delete();
        }
}
