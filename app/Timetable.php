<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;
use LoaMonitor\Day;
use LoaMonitor\Group;

class Timetable extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name','date_start','date_end',
    ];
	
    public function Day() {
        return $this->belongsTo(Band::class, 'days_id');
    }
    
    public function Group() {
        return $this->belongsTo(User::class, 'groups_id');
    }
}
