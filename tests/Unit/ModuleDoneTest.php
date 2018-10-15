<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use LoaMonitor\ModuleDone;
use LoaMonitor\Module;
use LoaMonitor\Student;
use Mockery;
use Illuminate\Support\Facades\Log;

class ModuleDoneTest extends TestCase
{
    /**
     * @return void
     */
    public function testUIDescription()
    {
      /*
       * Standard test
       * result = 6, date = today
       */
      $moduleDone = ModuleDone::find(100);
      $this->assertEquals($moduleDone->descriptionHeader(), 'T1 (6)' ,'descriptionHeader');
      $this->assertEquals($moduleDone->descriptionBody(),
        $moduleDone->date->format('d-m-Y').' '.
        $moduleDone->Module->description.' ('.$moduleDone->Module->sbu.')' ,'descriptionBody');

      /*
       * Started working
       * result = NULL, date_start = Last week, date_end = null, date = NULL
       */
      $moduleDone = ModuleDone::find(101);
      $this->assertEquals($moduleDone->descriptionHeader(),
          'T2 (S: '.$moduleDone->date_start->format('d-m-Y').')' ,'descriptionHeader');
      $this->assertEquals($moduleDone->descriptionBody(),
          $moduleDone->Module->description.' ('.$moduleDone->Module->sbu.')' ,'descriptionBody');

       /*
        * Stopped working
        * result = NULL, date_start = Last week , date_end = Today
        */
      $moduleDone = ModuleDone::find(102);
      $this->assertEquals($moduleDone->descriptionHeader(),
          'T3 (S: '.$moduleDone->date_start->format('d-m-Y').')' ,'descriptionHeader');
      $this->assertEquals($moduleDone->descriptionBody(),
          $moduleDone->Module->description.' ('.$moduleDone->Module->sbu.')' ,'descriptionBody');


    }
}
