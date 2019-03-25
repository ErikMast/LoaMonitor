<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;

class ModuleDone extends Model
{
    protected $dates = [
        'date', 'date_start', 'date_end'
    ];
    protected $fillable = [
      'id', 'date','modules_id', 'students_id', 'users_id', 'result','date_start','date_end'
    ];

    public function Module() {
  		return $this->belongsTo(Module::class, 'modules_id');
  	}

  	public function User() {
          return $this->belongsTo(User::class, 'users_id');
      }

  	public function Student(){
  		return $this->belongsTo(Student::class, 'students_id');
  	}

    public function descriptionHeader(){
      if ($this->result != null) {
        return $this->Module->ModuleGroup->domains.$this->Module->level.' ('. $this->result.')';
      } else {
        return $this->Module->ModuleGroup->domains.$this->Module->level.' (S: '.
          $this->date_start->format('d-m-Y').')';
      }
    }

    public function descriptionBody(){
      if ($this->date != null) {
        return $this->date->format('d-m-Y').' '.$this->Module->description.' ('.$this->Module->sbu.')';
      } else {
        return $this->Module->description.' ('.$this->Module->sbu.')';
      }
    }

    public function dateString(){
      if ($this->date != null) {
        return $this->date->format('d-m-Y');
      } else {
        return "";
      }
    }
    public function dateStartString(){
      if ($this->date_start != null) {
        return $this->date_start->format('d-m-Y');
      } else {
        return "";
      }
    }
    public function dateEndString(){
      if ($this->date_end != null) {
        return $this->date_end->format('d-m-Y');
      } else {
        return "";
      }
    }

    public static function isDone($studentId, $moduleId){
      return ModuleDone::where('students_id','=',$studentId)->where('modules_id', '=', $moduleId)->orderBy('date','DESC')->first();
    }

    public static function overview($studentId){
      $results = [];
      $modules = Module::allSorted()->get();
      $modulesBsa1 = Module::where('level', '=', '1')->count();
      $modulesBsa2 = 5;
      $modulesBsa3 = Module::where('level', '=', '2')->count();
      foreach($modules as $module){
          $done = ModuleDone::isDone($studentId, $module->id);
          $result = '';
          if ($done!=null && isset($done->result)){
            if (((float)$done->result>5.4)||strtoupper($done->result)=="UITSTEKEND"||strtoupper($done->result)=="GOED"||strtoupper($done->result)=="VOLDOENDE") {
              $result = $done->result;
              if ($done->Module->level==1) {
                $modulesBsa1--;
              }
              if ($done->Module->level==2) {
                if ($done->Module->ModuleGroup->domains == 'A' || $done->Module->ModuleGroup->domains == 'C') {
                  $modulesBsa2 = $modulesBsa2 - 4;
                } else {
                  $modulesBsa2 --;
                }
                $modulesBsa3--;
              }
            }
          }
          $item =
            array(
              'module'=>$module->id,
              'domain'=>$module->ModuleGroup->domains,
              'level'=>$module->level,
              'description'=>$module->fullName,
              'result'=>$result);
          array_push($results, $item);
      }

      $bsa = [$modulesBsa1<=0, $modulesBsa2<=0, $modulesBsa3<=0];
      
      return (array('results'=>$results, 'bsa'=>$bsa));
    }
}
