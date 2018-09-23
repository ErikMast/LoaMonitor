<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use LoaMonitor\Village;
use LoaMonitor\Group;
use LoaMonitor\Note;
use DateTime;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
    return $this->hasMany(ModuleDone::class, 'students_id');
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

  public function toBeCalled(){
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
      return (($this->end_date == null) && ($this->is_visible = 1) && ($now->diffInDays($lastdate)>21));
    } else {
      return (($this->end_date == null) && ($this->is_visible = 1));
    }
}

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
          orderBy('lastname')->get();
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
              orderBy('lastname')->get();
    }
  }
}
