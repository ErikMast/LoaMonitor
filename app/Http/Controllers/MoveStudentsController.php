<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LoaMonitor\Group;
use LoaMonitor\Student;
use Illuminate\Support\Facades\DB;



class MoveStudentsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('movestudents');
  }

  public function move(Request $request)
  {
    $configured = (Group::where("next_groups_id", '=','0')->count());
    Log::info("Not Configured: ".$configured);
    if ($configured > 0) {
      //ga naar Groups
      return redirect('groups')->
        withErrors('Er moeten nog klassen geconfigureerd worden voor verhuizen: '.
          Group::where("next_groups_id", '=', '0')->pluck("name")
        );
    }

    $groups = Group::orderBy('sortorder', 'desc')->pluck("name");
    Log::info("Moving:".$groups);

    //save last groups id
    DB::table('students')->update(['previous_groups_id' => DB::raw('groups_id')]);


    //Configured
    $groups = Group::where("next_groups_id", '>', '0')->where("name", "NOT LIKE", "%vanop%")->orderBy('sortorder', 'desc')->pluck("id");
    Log::info("Moving:".$groups);

    $leaving = Group::where("name", 'LIKE','%vanop%')->orderBy('sortorder', 'desc')->pluck("id");
    Log::info("Leaving:".$leaving);

    $students =  Student::wherein('groups_id', $groups)->get();

    for ($i = 0; $i<sizeof($students); $i++){
      $student = Student::find($students[$i]->id);
      $student->groups_id = Group::find($student->Group->next_groups_id)->id;
      $student->save();
    }
    return redirect()->route('home')->with("success", "Iedereen is verhuisd naar de volgende klas.");
  }

  public function revert(Request $request)
  {
    $configured = (Group::where("next_groups_id", '=','0')->count());
    Log::info("Not Configured: ".$configured);
    if ($configured > 0) {
      //ga naar Groups
      return redirect('groups')->withErrors('Er moeten nog klassen geconfigureerd worden voor verhuizen');
    }

    Log::info("Verhuizing teruggedraaid");
    //save last groups id
    DB::table('students')->update(['groups_id' => DB::raw('previous_groups_id')]);


    return redirect()->route('home')->with("success", "Iedereen is verhuisd naar de vorige klas.");
  }
}
