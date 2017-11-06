<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\Note;
use LoaMonitor\NoteType;
use LoaMonitor\Student;
use LoaMonitor\User;

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
        $student = null;
        if (isset($_GET) && isset($_GET['student_id'])) {
			       $notes = Note::where('students_id','=',$_GET['student_id'])
			          ->orderBy('id','DESC')->paginate(10);
             $student = Student::where('id','=', $_GET['student_id'])->first();
		    } else {
			       $notes = Note::orderBy('id','DESC')->paginate(10);
			       $allStudents = true;
		    }

        //return view('notes.index',compact('notes', 'student_id'))
        //    ->with('i', ($request->input('page', 1) - 1) * 5);

		return view('notes.index', compact('notes', 'allStudents', 'student'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (isset($_GET) && isset($_GET['student_id'])) {
        $notetypes = NoteType::pluck('name', 'id');
        $student = Student::where('id','=',$_GET['student_id'])->first();
        $note = new Note();
        $note->Student = $student;
        $note->NoteType = NoteType::where('id', '=', "1")->first();
        $note->User = User::where('id','=', $_GET['user_id'])->first();
        return view('notes.create', compact('student', 'notetypes', 'note'));
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
      dd($request);
      //  $this->validate($request, [
      //       'notes' => 'required',
      //       'date' => 'required',
      //   ]);
       //
      //   Note::create($request->all());
      //   return redirect()->route('notes')
      //                  ->with('success','Item created successfully');
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
		$student = Student::where('id','=',$note->student_id);
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
        ]);

        Note::find($id)->update($request->all());

        return redirect()->route('notes.index')
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
