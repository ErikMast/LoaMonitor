<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\Student;
use LoaMonitor\Logbook;
use LoaMonitor\Imports\LogbookImport;
use Excel;
use DateTime;
use Illuminate\Support\Facades\Input;

class ImportLogbook extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('imports/logbook');
  }

/**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
    public function import(Request $request) {

        if($request->file('imported-file'))	{
      			$path = $request->file('imported-file')->getRealPath();
            //new style phpspreadsheet 3.1
            //Excel::import(new LogbookImport, $path);
            $data = Excel::load($path, function($reader) {})->get();

            if(!empty($data) && $data->count() ){
        				//$data = $data->toArray();
        				for($i=0; $i<count($data); $i++){
        					//$data[$i] bevat een record uit een csv
                  //dd($data[$i]);
                  //Uit het email het studentnummer halen
                  $temp = explode('@',$data[$i][$data->getHeading()[3]]);
                  $stamnr = $temp[0];
                  //modules verzamelen
                  $progress= "";
                  for ($j = 5; $j<11;$j++) {
                    $progress .= $data[$i][$data->getHeading()[$j]];
                  }
                  $studentobj = Student::where('student_number', '=',$stamnr)->first();
                  if ($studentobj != null) {
                    $logbook = array();
                    $logbook["original_id"] = $data[$i][$data->getHeading()[0]];
                    $logbook["students_id"] = $studentobj->id;
                    $logbook["date"] = $data[$i][$data->getHeading()[1]];
                    $logbook["progress"] = $progress;
                    $logbook['specification'] =$data[$i][$data->getHeading()[11]];
                    $logbook['remark'] = $data[$i][$data->getHeading()[12]];
                    $logbook['users_id'] = $request->user()->id;
                    //dd($studentobj);
                    //dd($logbook);
                    $check = Logbook::where("original_id", "=",$logbook["original_id"])
                              ->where("students_id", "=",$logbook["students_id"])
                              ->where("date", "=",$logbook["date"])->first();
                    if ($check == null) {
                      Logbook::insert($logbook);
                    }
        				  }
                }

                return redirect()->route('home')
                      ->with('success','Logboek import gelukt');
      				} // niet leeg
    		} //er is een bestand

        return redirect()->route('home')
          ->with('errors','Logboek import mislukt');
    }
}
