<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LoaMonitor\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;

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
          $currentDay = date("j F Y");

          $keyword = Input::get('keyword');
          if (isset($keyword)){
            $students = Student::getStudents($keyword);
          } else {
            $students = Student::getStudents('');
          }

    			return view('dashboard', compact('currentDay', 'students'));
    		}
    }
}
