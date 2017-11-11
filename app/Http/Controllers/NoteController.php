<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\Note;
use LoaMonitor\NoteType;
use LoaMonitor\Student;
use LoaMonitor\User;
use Illuminate\Support\Facades\Input;

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
			          ->orderBy('id','DESC')->paginate(10);
             $student = Student::find($studentId);
             return view('notes.index', compact('notes', 'allStudents', 'student'));
		    } else {
			       $notes = Note::orderBy('id','DESC')->paginate(10);
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
      $studentId = Input::get('student_id');
      if ($studentId != null) {
        $notetypes = NoteType::pluck('name', 'id');
        $student = Student::find($studentId);
        $note = new Note();
        $note->Student = $student;
        $note->NoteType = NoteType::find(1);
        $note->User = User::find(Input::get('user_id'));
        return view('notes.create', compact('student', 'notetypes', 'note'));
      } else {
        $note = new Note();
        $note->NoteType = NoteType::find(1);
        $note->User = User::find(Input::get('user_id'));
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

        Note::find($id)->delete();

        return redirect()->route('notes.index')
                        ->with('success','Item deleted successfully');
    }
}
