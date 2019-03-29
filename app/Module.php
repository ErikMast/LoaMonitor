<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


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

    public static function allSorted(){
      return Module::select('modules.*')->
        join('module_groups', "module_groups.id", "=", "modules.module_groups_id")->
        orderBy('modules.level')->orderBy('module_groups.domains');
    }

    public function canDelete(){
      $result = DB::table('module_dones')->where('modules_id', '=', $this->id)->count('id')==0;
      return $result;
    }

    public static function overviewSupport(){
      $result = array('modules' =>  Module::allSorted()->get(),
        'level1count'=> Module::where('level', '=', '1')->count(),
        'level2count'=> Module::where('level', '=', '2')->count());
      return $result;
    }

}
