<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use LoaMonitor\Village;
use LoaMonitor\Group;
use LoaMonitor\Note;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use LoaMonitor\Logbook;

class Student extends Model
{

  protected $dates = [
    'end_date'
  ];

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
		'firstname',
		'lastname',
		'student_number',
		'villages_id',
		'eta',
		'groups_id',
    'end_date',
    'is_visible',
    'previous_groups_id'
	];


	public function Village(){
		return $this->belongsTo(Village::class, 'villages_id');
	}

	public function Group() {
		return $this->belongsTo(Group::class, 'groups_id');
	}

	public function notes() {
		return $this->hasMany(Note::class, 'students_id')->orderBy('date', 'DESC')->orderBy('note_types_id');
	}

  public function modules_done(){
    return $this->hasMany(ModuleDone::class, 'students_id')->orderBy('date','DESC');
  }

  public function logbooks() {
      return $this->hasMany(Logbook::class, 'students_id')->orderBy('date','DESC');
  }

  public function mostRecentLogbook(){
      return $this->hasMany(Logbook::class, 'students_id')->orderBy('date','DESC')->take(3);
  }

  public function visibleAsText(){
    return ($this->is_visible !=0 ) ? "Ja": "Nee";
  }


	public function mostRecentNotes(){
    //get last contact and last progress note
		$contacts = $this->notes()->where("note_types_id", '=', 1)->orderBy('date', 'DESC')->take(1);
    $progresses = $this->notes()->where("note_types_id", '=', 2)->orderBy('date', 'DESC')->take(1);

    //Day notes don't have to be visible after date
    $daynotes = $this->notes()->where("note_types_id", '=', 3)->where('date','>=',date('Y-m-d'))->take(1);

    //join them in one collection
    return $contacts->union($progresses)->union($daynotes);
	}

  public function modulesDoneSorted(){
	  return $this->modules_done()->orderBy('date', 'DESC')->take(5);
  }

  public function sumOfSBU(){
    //selecteer alle gedane modules voor een student en neem daarvan de unieke module.id
    $modulesdone = DB::table('module_dones')->
      where('module_dones.students_id', '=', $this->id)->
      distinct()->pluck("modules_id");
    //neem de som van sbu van alle gedane unieke modules
    $som = DB::table('modules')->
      whereIn('modules.id', $modulesdone)->
      sum('sbu');

    return $som;
  }

  public function toBeLogging(){
    $goLogging = $this->logbooks()->count() == 0;

    //get last contact and last progress note
		$lastdate = $this->mostRecentLogbook()->take(1)->pluck('date')->map(function($date) {
        return $date->format('d-m-Y');
      });

    $now = Carbon::now();
    if (sizeof($lastdate)>0) {
      $lastdate = Carbon::createFromFormat('d-m-Y', $lastdate[0]);
      //magical number... 5 days
      $goLogging = $goLogging || ($now->diffInDays($lastdate)>5);
    }

    return $goLogging;
  }

  public function toBeCalled(){
    //Students with end_date or not visible
    if (($this->end_date != null) || ($this->is_visible != 1)) {
      return false;
    }

    //get last contact and last progress note
		$lastdate = $this->notes()->
      whereIn("note_types_id", array(1,2))->
      orderBy('date', 'DESC')->take(1)->pluck('date')->map(function($date) {
        return $date->format('d-m-Y');
      });
    $now = Carbon::now();
    if (sizeof($lastdate)>0) {
      $lastdate = Carbon::createFromFormat('d-m-Y', $lastdate[0]);
      //magical number... 21 days
      return ($now->diffInDays($lastdate)>21);
    } else {
      return true;
    }
  }
  // Selecting students methods
  public static function getStudentsByVisibility($visible){
    if ($visible) {
      return Student::whereNull('end_date')->where('is_visible', '=', '1');
    } else {
      return Student::all();
    }
  }

  public static function getStudents($keyword, $inDashboard) {
    /*
      1. inDash: alleen huidige Studenten
        groups students is_visible
        anders alles
      2. zoeken
        IN groups resultaat: alleen die Studenten
        anders zoeken in studenten
    */

    if ($inDashboard) {
      $groups = Group::where('is_visible', '=','1')->orderBy("sortorder")->where('name', 'LIKE', "%$keyword%");
    } else {
      $groups = Group::where('name', 'LIKE', "%$keyword%")->orderBy("sortorder");
    }

    $students = Student::getStudentsByVisibility($inDashboard);

    Log::info("Search for [$keyword]");
    if (($groups->count()>0) && ($keyword !== '')) {
      Log::debug('in Groups: '.$groups->pluck('id'));

      return Student::select('students.*')->
          join("groups", "groups.id", "=", "students.groups_id")->
          wherein('groups_id', $groups->pluck('id'))->
          wherein('students.id', $students->pluck('id'))->
          orderBy('groups.sortorder')->
          orderBy('lastname')->paginate(20)->appends(Input::except('page'));
    } else {
      Log::debug('In students');
      if ($inDashboard) {
        $groups = Group::where('is_visible', '=','1')->orderBy("sortorder");
      } else{
        $groups = Group::orderBy("sortorder");
      }
      if ($keyword !== '') {
        Log::debug('groupcount = '.$groups->count(). " ".$groups->pluck('id'));
        Log::debug("Students: ".$students->pluck('student_number'));
        $search = Student::
          where('firstname', 'LIKE', "%$keyword%")->
          orwhere('lastname', 'LIKE', "%$keyword%");
        $students = Student::
          wherein('students.id', $students->pluck('id'))->
          wherein('groups_id', $groups->pluck('id'))->
          wherein('students.id', $search->pluck('id'));
        Log::debug("Found ".$students->count()." ".$students->pluck('student_number'));
      }
      return Student::select('students.*')->
              wherein('students.id', $students->pluck('id'))->
              wherein('groups_id', $groups->pluck('id'))->
              join("groups", "groups.id", "=", "students.groups_id")->
              orderBy('groups.sortorder')->
              orderBy('lastname')->paginate(20)->appends(Input::except('page'));
    }
  }

  public function isDone($moduleId){
    $result = null;
    foreach ($this->modules_done as $moduledone) {
      if ($result == null && $moduledone->modules_id == $moduleId)
        $result = $moduledone;
    }
    return $result;
  }

  public function overview($overviewSupport){
    $results = [];
    if ($overviewSupport == null)
      $overviewSupport = Module::overviewSupport();

    $modules = $overviewSupport['modules']; //Module::allSorted()->get();
    $modulesBsa1 = $overviewSupport['level1count']; //Module::where('level', '=', '1')->count();
    $modulesBsa2 = 5;
    $modulesBsa3 = $overviewSupport['level2count']; //Module::where('level', '=', '2')->count();
    foreach($modules as $module){
        $result = '';
        $done = $this->isDone($module->id);
        if ($done!=null && isset($done->result)){
          //komma vs punt in cijfers, kommas werken niet in php
          $tempres = str_replace(',','.', $done->result);
          if (((float)$tempres>5.4) ||strtoupper($tempres)=="UITSTEKEND"||strtoupper($tempres)=="GOED"||strtoupper($tempres)=="VOLDOENDE") {
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
