<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\Csvdata;
use LoaMonitor\Village;
use LoaMonitor\Group;
use LoaMonitor\Student;
use Excel;

class CsvdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('csvdata');
    }
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
		if($request->file('imported-file'))
		{
			$path = $request->file('imported-file')->getRealPath();
			$data = Excel::load($path, function($reader) {})->get();

			if(!empty($data) && $data->count()){
				$data = $data->toArray();
				for($i=0; $i<count($data); $i++){
					//$data[$i] bevat een record uit een csv
					$studentobj = Student::where('student_number', '=',$data[$i]['stamnr'])->first();
					if ($studentobj==null) {
						$student = array();
						$village = Village::where("name", "=", $data[$i]["woonplaats"])->first();
						if ($village==null) {
							Village::insert(array(["name"=>$data[$i]["woonplaats"]]));
							$village = Village::where("name", "=", $data[$i]["woonplaats"])->first();
						}
						$group = Group::where("name", "=", $data[$i]["klas"])->first();
						if ($group==null) {
							Group::insert(array(["name"=>$data[$i]["klas"]]));
							$group = Group::where("name", "=", $data[$i]["klas"])->first();
						}
						$student['villages_id']=$village->id;
						$student['firstname'] = $data[$i]['roepnaam'];
					
						if (!$data[$i]['tussenv']==""){
							$student['lastname'] = $data[$i]['tussenv'].' '.$data[$i]['achternaam'];
						} else {
							$student['lastname'] = $data[$i]['achternaam'];
						}
					
						$student['student_number']= $data[$i]['stamnr'];
						//$student['eta'] = new DateTime('2000-01-01 12:30:00');
						$student['groups_id'] = $group->id;
						Student::insert($student);
						//$dataImported[] = $data[$i];
					}
				}
			}
			
			//Csvdata::insert($dataImported);
		}
		return back();
  }
}
