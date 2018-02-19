<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\Student;
use LoaMonitor\Village;
use LoaMonitor\Group;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;

class StudentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $keyword = Input::get('keyword');
        if (isset($keyword)){
          $students = Student::getStudents($keyword);
        } else {
          $students = Student::getStudents('');
        }

        return view('students.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('students.create');
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
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
		Student::create($request->all());
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
        $student = Student::find($id);

        return view('students.show',compact('student'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $student = Student::find($id);
		$villages = Village::pluck('name', 'id');
		$groups = Group::orderBy("sortorder")->pluck('name', 'id');
        return view('students.edit',compact('student', 'villages', 'groups'));
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
            'firstname' => 'required',
            'lastname' => 'required',
        ]);

        Student::find($id)->update($request->all());

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
        Student::find($id)->delete();

        return redirect()->route('home')
                        ->with('success','Item deleted successfully');
    }

}
