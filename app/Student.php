<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use LoaMonitor\Village;
use LoaMonitor\Group;
use LoaMonitor\Note;
use DateTime;

class Student extends Model
{
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
	];


	public function village(){
		return $this->belongsTo(Village::class, 'villages_id');
	}

	public function group() {
		return $this->belongsTo(Group::class, 'groups_id');
	}

	public function notes() {
		return $this->hasMany(Note::class, 'students_id')->orderBy('date', 'DESC')->orderBy('note_types_id');
	}

  public function modules_done(){
    return $this->hasMany(ModuleDone::class, 'students_id');
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

}
