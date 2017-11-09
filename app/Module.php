<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
      'id', 'domain','level', 'description'
    ];

    

}
