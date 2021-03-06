<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\Note;
use LoaMonitor\NoteType;
use LoaMonitor\Student;
use LoaMonitor\User;
use Illuminate\Support\Facades\Input;
use DateTime;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		    $allStudents = false;
        $studentId = Input::get('student_id');
        if ($studentId != null) {
			       $notes = Note::where('students_id','=',$studentId)
			          ->orderBy('date','DESC')->paginate(10);
             $student = Student::find($studentId);
             return view('notes.index', compact('notes', 'allStudents', 'student'));
		    } else {
			       $notes = Note::orderBy('date','DESC')->paginate(10);
			       $allStudents = true;
             return view('notes.index', compact('notes', 'allStudents'));
		    }
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $notetypes = NoteType::pluck('name', 'id');

      $note = new Note();
      $note->date = new DateTime();
      $note->NoteType = NoteType::find(1);
      $note->User = User::find(Input::get('user_id'));

      $studentId = Input::get('student_id');
      if ($studentId != null) {
        $student = Student::find($studentId);
        $note->Student = $student;
        return view('notes.create', compact('student', 'notetypes', 'note'));
      } else {
        return view('notes.create', compact('notetypes', 'note'));
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
            'notes' => 'required',
            'date' => 'required',
            'students_id' => 'required',
            'users_id' => 'required'
        ]);

        Note::create($request->all());
        return redirect()->route('home')
                       ->with('success','Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = Note::find($id);

        return view('notes.show',compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::find($id);
		    $notetypes = NoteType::pluck('name', 'id');
		    $student = Student::find($note->student_id);
        return view('notes.edit',compact('note', 'notetypes', 'student'));
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
            'notes' => 'required',
            'students_id' => 'required',
            'users_id' => 'required'
        ]);

        Note::find($id)->update($request->all());

        return redirect()->route('home')
                        ->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $note = Note::find($id);
      $student_id = $note->student->id;
      $user_id = $note->user->id;
      Note::find($id)->delete();

      return redirect()->route('notes.index', ['student_id'=> $student_id, 'user_id'=> $user_id])
                        ->with('success','Item deleted successfully');
    }
}
