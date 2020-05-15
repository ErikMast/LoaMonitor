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

      $format = "d-m-Y";

      foreach($logbooks as $l) {
          $split = explode(';', $l->progress);
          for ($i=0; $i<sizeof($split); $i++) {
            if (!empty($split[$i])) {

              //Carbon::createFromFormat('d-m-Y', $lastdate[0]);
              if (!isset($progresses[$split[$i]])) {
                $progresses[$split[$i]] = array("count"=>1, "lastdate"=>$l->date);
              } else {
                $progresses[$split[$i]]["count"] += 1;
                if ($progresses[$split[$i]]["lastdate"]<$l->date) {
                  $progresses[$split[$i]]["lastdate"] = $l->date;
                }
              }
            }
          }
      }

      //ksort($progresses);
      //usort($progresses, function ($a, $b) {return $a['lastdate'] < $b['lastdate'];});

      $custom = array();
      foreach ($progresses as $key => $row)
      {
          $custom["lastdate"][$key] = $row['lastdate'];
          $custom["count"][$key] = $row['count'];
      }

      //array_multisort($custom, SORT_DESC, $progresses);
      array_multisort($custom["lastdate"], SORT_DESC, $custom["count"], SORT_DESC, $progresses);
      return view('reports.logbook', ['progresses'=>$progresses]);
  }
}
