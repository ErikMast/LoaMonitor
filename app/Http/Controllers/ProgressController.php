<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\Progress;
use LoaMonitor\Student;
use LoaMonitor\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use DateTime;

class ProgressController extends Controller
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
           $progresses = Progress::where('students_id','=',$studentId)
              ->orderBy('date','DESC')->paginate(10)->appends(Input::except('page'));

           $student = Student::find($studentId);

           return view('progresses.index', compact('progresses', 'student'));
      } else {
           return redirect()->route('home');
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $progress = new Progress();
      $progress->date = new DateTime();
      $progress->User = User::find(Input::get('user_id'));

      $studentId = Input::get('student_id');
      if ($studentId != null) {
        $student = Student::find($studentId);
        $progress->Student = $student;
        return view('progresses.create', compact('student', 'progress'));
      } else {
        return redirect()->route('home');
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
           'students_id' => 'required',
           'users_id' => 'required'
       ]);

       Progress::create($request->all());

       return redirect()->route('home')
                      ->with('success','Voortgang toegevoegd');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $progress = Progress::find($id);

      return view('progresses.show',compact('progress'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $progress = Progress::find($id);
      $student = Student::find($progress->student_id);
      return view('progresses.edit',compact('progress', 'student'));
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
          'students_id' => 'required',
          'users_id' => 'required'
      ]);
      Progress::find($id)->update($request->all());
      return redirect()->route('home')
                     ->with('success','Voortgang aangepast');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $progress = Progress::find($id);
      $student_id = $progress->student->id;
      $user_id = $progress->user->id;
      Progress::find($id)->delete();

      return redirect()->route('progresses.index', ['student_id'=> $student_id, 'user_id'=> $user_id])
                        ->with('success','Voortgang verwijderd');
    }
}
