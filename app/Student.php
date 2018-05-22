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
    'is_visible'
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
    $som = DB::table('module_dones')->
      where('module_dones.students_id', '=', $this->id)->
      distinct()->
      join('modules', 'module_dones.modules_id','=', 'modules.id')->
      select('modules.sbu')->
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

  public static function getStudents($keyword, $inDashboard) {
      Log::info("Search for $keyword");
    $groups = Group::where('name', 'LIKE', "%$keyword%")->orderBy("sortorder")->pluck('id');
    if ($inDashboard) {
      $students = Student::whereNull('end_date')->where('is_visible', '=', '1');
    } else {
      $students = Student::all();
    }

    if ((sizeof($groups)>0)&&($keyword !== '')) {
      Log::info('in Groups: groupcount = '.sizeof($groups));

      return Student::select('students.*')->
          join("groups", "groups.id", "=", "students.groups_id")->
          wherein('groups_id', $groups)->
          wherein('students.id', $students->pluck('id'))->
          orderBy('groups.sortorder')->
          orderBy('lastname')->get();
    } else
      Log::info('in students');
      if ($keyword !== '') {
        $students = Student::where('firstname', 'LIKE', "%$keyword%")->
          orwhere('lastname', 'LIKE', "%$keyword%")->
          wherein('students.id', $students->pluck('id'));
      }

      return Student::select('students.*')->
              wherein('students.id', $students->pluck('id'))->
              join("groups", "groups.id", "=", "students.groups_id")->
              orderBy('groups.sortorder')->
              orderBy('lastname')->get();
  }
}
