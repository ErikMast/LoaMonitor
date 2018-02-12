<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;

use LoaMonitor\User;
use LoaMonitor\Student;
use LoaMonitor\NoteType;


class Note extends Model
{
  protected $dateFormat = 'd-m-Y';
  protected $dates = [
        'date'
    ];

  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'date','notes', 'note_types_id', 'users_id', 'students_id'
	];

	public function NoteType() {
		return $this->belongsTo(NoteType::class, 'note_types_id');
	}

	public function User() {
        return $this->belongsTo(User::class, 'users_id');
    }

	public function Student(){
		return $this->belongsTo(Student::class, 'students_id');
	}

}
