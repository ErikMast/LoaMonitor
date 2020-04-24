<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use LoaMonitor\Logbook;
use LoaMonitor\Student;

class LogbookController extends Controller
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
         $logbooks = Logbook::where('students_id','=',$studentId)
            ->orderBy('date','DESC')->paginate(10)->appends(Input::except('page'));

         $student = Student::find($studentId);
         return view('logbooks.index', compact('logbooks', 'student'));
    } else {
         return redirect()->route('home');
    }
  }
}
