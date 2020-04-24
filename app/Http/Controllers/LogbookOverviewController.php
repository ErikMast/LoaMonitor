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
      $logbooks = DB::select('SELECT m.progress FROM logbooks m LEFT JOIN logbooks b ON m.students_id = b.students_id  AND m.date < b.date WHERE b.date IS NULL');

      $progresses = array();

      foreach($logbooks as $l) {
          $split = explode(';', $l->progress);
          for ($i=0; $i<sizeof($split); $i++) {
            if (!empty($split[$i])) {
              if (!isset($progresses[$split[$i]])) {
                $progresses[$split[$i]] = 1;
              } else {
                $progresses[$split[$i]] += 1;
              }
            }
          }
      }

      ksort($progresses);
      return view('reports.logbook', ['progresses'=>$progresses]);
  }
}
