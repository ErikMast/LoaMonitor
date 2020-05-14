<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogbookOverviewController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $logbooks = DB::select('SELECT m.progress, m.date FROM logbooks m LEFT JOIN logbooks b ON m.students_id = b.students_id  AND m.date < b.date WHERE b.date IS NULL');

      $progresses = array();

      foreach($logbooks as $l) {
          $split = explode(';', $l->progress);
          for ($i=0; $i<sizeof($split); $i++) {
            if (!empty($split[$i])) {
              if (!isset($progresses[$split[$i]])) {
                $progresses[$split[$i]] = array("count"=>1, "lastdate"=>date("d-m-Y", strtotime($l->date)));
              } else {
                $progresses[$split[$i]]["count"] += 1;
                if ($progresses[$split[$i]]["lastdate"]<date("d-m-Y", strtotime($l->date))) {
                  $progresses[$split[$i]]["lastdate"]=date("d-m-Y", strtotime($l->date));
                }
              }
            }
          }
      }

      ksort($progresses);
      return view('reports.logbook', ['progresses'=>$progresses]);
  }
}
