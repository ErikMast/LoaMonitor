<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SbuStatsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $sbustats = DB::select('select sbus.som, count(sbus.som) as aantal from ( SELECT `students_id`, sum(sbu) as som FROM `module_dones` left join `modules` on `module_dones`.`modules_id` = `modules`.`id` group by `module_dones`.`students_id`) sbus group by som order by sbus.som');
      return view('sbustats', ['sbustats'=>$sbustats]);
  }


}
