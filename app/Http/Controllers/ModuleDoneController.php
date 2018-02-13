<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\ModuleDone;
use LoaMonitor\Module;
use LoaMonitor\Student;
use LoaMonitor\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use DateTime;


class ModuleDoneController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $studentId = Input::get('student_id');
      if ($studentId != null) {
           $moduledones = ModuleDone::where('students_id','=',$studentId)
              ->orderBy('date','DESC')->paginate(10);
           $student = Student::find($studentId);
           return view('moduledones.index', compact('moduledones', 'student'));
      } else {
           return view('home');
      }
    }
  public function getModuleDescriptions(){
    return Module::selectRaw('id, concat (domain,level, " ",description) as full_description')->pluck('full_description','id');
    //return Module::pluck('description','id');
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $modules = $this->getModuleDescriptions();

    $moduledone = new ModuleDone();
    $moduledone->date = new DateTime();
    $moduledone->Module = Module::find(1);
    $moduledone->User = User::find(Input::get('user_id'));

    $studentId = Input::get('student_id');
    if ($studentId != null) {
      $student = Student::find($studentId);
      $moduledone->Student = $student;
      return view('moduledones.create', compact('student', 'modules', 'moduledone'));
    } else {
      return view('home');
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
     $this->validate($request, [
          'modules_id' => 'required',
          'date' => 'required',
          'students_id' => 'required',
          'users_id' => 'required',
          'result' => 'required'
      ]);

      ModuleDone::create($request->all());
      return redirect()->route('home')
                     ->with('success','Voltooide module toegevoegd');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $moduledone = ModuleDone::find($id);

      return view('moduledones.show',compact('moduledone'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $modules = $this->getModuleDescriptions();
      $moduledone = ModuleDone::find($id);
      $student = Student::find($moduledone->student_id);
      return view('moduledones.edit',compact('moduledone', 'student', 'modules'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      $this->validate($request, [
          'date' => 'required',
          'modules_id' => 'required',
          'students_id' => 'required',
          'users_id' => 'required',
          'result' => 'required'
      ]);

      ModuleDone::find($id)->update($request->all());

      return redirect()->route('home')
                      ->with('success','Voltooide module aangepast');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $moduledone = ModuleDone::find($id);
    $student_id = $moduledone->student->id;
    $user_id = $moduledone->user->id;
    ModuleDone::find($id)->delete();

    return redirect()->route('moduledones.index', ['student_id'=> $student_id, 'user_id'=> $user_id])
                      ->with('success','Voltooide module verwijderd');
  }}
