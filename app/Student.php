<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use LoaMonitor\Village;
use LoaMonitor\Group;
use LoaMonitor\Note;

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
		return $this->hasMany(Note::class, 'students_id');
	}

  public function modules_done(){
    return $this->hasMany(ModuleDone:class, 'students_id');
  }

	public function mostRecentNotes(){
		return $this->notes()->orderBy('date', 'desc')->take(3);
	}

}
