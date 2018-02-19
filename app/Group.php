<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;
//use LoaMonitor\Student;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name','sortorder'
    ];

    /*
	public function Students() {
        return $this->hasMany(Student::class);
    }
	*/
}
