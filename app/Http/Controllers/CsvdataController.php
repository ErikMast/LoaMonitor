<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('imports/csvdata');
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
      $prev_group = Group::where("name", "LIKE", "%niets%")->first();
			if(!empty($data) && $data->count()){
				$data = $data->toArray();
				for($i=0; $i<count($data); $i++){
					//$data[$i] bevat een record uit een csv
					$studentobj = Student::where('student_number', '=',$data[$i]['stamnummer'])->first();
					if ($studentobj==null) {
						$student = array();
						$village = Village::where("name", "=", "Onbekend")->first();
						if ($village==null) {
							Village::insert(array(["name"=>"Onbekend"]));
							$village = Village::where("name", "=", "Onbekend")->first();
						}
						$group = Group::where("name", "LIKE", "%".strtolower($data[$i]["klas"])."%")->first();
						if ($group==null) {
							Group::insert(array(["name"=>$data[$i]["klas"]]));
							$group = Group::where("name", "LIKE", "%".strtolower($data[$i]["klas"])."%")->first();
						}
						$student['villages_id']=$village->id;
						$student['firstname'] = $data[$i]['roepnaam'];

						if (!$data[$i]['tussenvoegsel']==""){
							$student['lastname'] = $data[$i]['tussenvoegsel'].' '.$data[$i]['achternaam'];
						} else {
							$student['lastname'] = $data[$i]['achternaam'];
						}

						$student['student_number']= $data[$i]['stamnummer'];
						//$student['eta'] = new DateTime('2000-01-01 12:30:00');
						$student['groups_id'] = $group->id;
            $student["previous_groups_id"] = $prev_group->id;
            $student["is_visible"] = "1";
						Student::insert($student);
						//$dataImported[] = $data[$i];
					} else {
						$group = Group::where("name", "LIKE", "%".strtolower($data[$i]["klas"])."%")->first();
						if ($group==null) {
							Group::insert(array(["name"=>$data[$i]["klas"]]));
							$group = Group::where("name", "LIKE", "%".strtolower($data[$i]["klas"])."%")->first();
						}
            $student = array();
						$student['groups_id'] = $group->id;
            $student["previous_groups_id"] = $studentobj->groups_id;
            $studentobj->update($student);
          }
				}
			}

			//Csvdata::insert($dataImported);
		}
		return redirect()->route('home')
                   ->with('success','Studentimport gelukt');
  }
}
