<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModuleGroup extends Model
{
  protected $fillable = [
    'id', 'domains','description'
  ];

  public function canDelete(){
    $result = DB::table('modules')->where('module_groups_id', '=', $this->id)->count('id')==0;
    return $result;
  }

}
