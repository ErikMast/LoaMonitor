<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
  protected $dates = [
      'date'
  ];

/**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id', 'original_id','students_id', 'date', 'progress','specification','remark','users_id'
  ];

  public function User() {
        return $this->belongsTo(User::class, 'users_id');
    }

  public function Student(){
    return $this->belongsTo(Student::class, 'students_id');
  }

}
