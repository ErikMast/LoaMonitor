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
        'id', 'name','sortorder', 'next_groups_id'
    ];

    /*
	public function Students() {
        return $this->hasMany(Student::class);
    }
	*/

  public static function getIdByName($name){
    $group = Group::where("name", '=', $name)->first();

    return $group["id"];
  }

  public function nextGroup(){
    $next = Group::find($this->next_groups_id);
    if ($next == null) {
      return "";
    }
    return $next->name;
  }
}
