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

}
