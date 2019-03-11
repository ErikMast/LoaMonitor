<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;


class Module extends Model
{
    protected $fillable = [
      'id', 'level', 'description', 'sbu', 'module_groups_id'
    ];

    public function ModuleGroup() {
  		return $this->belongsTo(ModuleGroup::class, 'module_groups_id');
  	}

    public function getFullNameAttribute()
    {
      return $this->ModuleGroup->domains . $this->level." ".$this->description." (".$this->sbu.")";
    }


}
