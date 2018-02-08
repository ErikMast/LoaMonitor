<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
      'id', 'domain','level', 'description', 'sbu'
    ];

    public function domainInt() {
        return ord($this->domain)-ord('A')+1;
    }

    public function getFullNameAttribute()
    {
        return $this->domain . $this->level." ".$this->description;
    }


}
