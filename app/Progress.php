<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
  protected $dates = [
      'date', 'date_deadline'
  ];
  protected $fillable = [
    'id', 'students_id', 'date', 'date_deadline', 'notes', 'users_id'
  ];

  public function User() {
        return $this->belongsTo(User::class, 'users_id');
    }

  public function Student(){
    return $this->belongsTo(Student::class, 'students_id');
  }

  public function dateString(){
    if ($this->date != null) {
      return $this->date->format('d-m-Y');
    } else {
      return "";
    }
  }

  public function dateDeadLineString(){
    if ($this->date_deadline != null) {
      return $this->date_deadline->format('d-m-Y');
    } else {
      return "";
    }
  }

  public function hasDeadline() {
    return !empty($this->dateDeadLineString());
  }
}
