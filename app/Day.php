<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;
use LoaMonitor\Timetable;

class Day extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name',
	];

    public function Timetable() {
        return $this->hasMany(Timetable::class);
    }
}
