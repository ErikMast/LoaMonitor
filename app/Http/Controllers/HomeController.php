<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LoaMonitor\Student;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guest()) {
			return view('login');
		} else {
            //$totalStudents = Student::count();
            $currentDay = date("j F Y");
            $students = Student::orderBy('groups_id')->orderBy('lastname')->get();
			return view('dashboard', compact('currentDay', 'students'));
		}
    }
}
