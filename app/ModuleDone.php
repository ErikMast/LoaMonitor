<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;

class ModuleDone extends Model
{
    protected $fillable = [
      'id', 'date','modules_id', 'students_id', 'users_id', 'result'
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
}
