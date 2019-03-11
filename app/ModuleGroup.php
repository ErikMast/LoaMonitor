<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;

class ModuleGroup extends Model
{
  protected $fillable = [
    'id', 'domains','description'
  ];


}
