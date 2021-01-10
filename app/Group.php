<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;
//use LoaMonitor\Student;
use Illuminate\Support\Facades\DB;

class Group extends Model
{

    //reserved id 99 =>klas "Niets"
    public static $idNiets = 99;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name','sortorder', 'is_visible','next_groups_id'
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

  public function canDelete(){
    $result = DB::table('students')->where('groups_id', '=', $this->id)->count('id')==0;

    //hack om te voorkomen dat Groep "Niets" weggegooid wordt
    if ($this->id == $idNiets) $result=false;

    return $result;
  }

  public static function groupNiets(){
    return Group::find($idNiets);
  }
}
