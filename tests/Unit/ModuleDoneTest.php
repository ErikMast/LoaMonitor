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
      $this->assertEquals(
        'T1 (6)' ,
        $moduleDone->descriptionHeader(),
        'descriptionHeader');
      $this->assertEquals(
        $moduleDone->date->format('d-m-Y').' '.
        $moduleDone->Module->description.' ('.$moduleDone->Module->sbu.')',
        $moduleDone->descriptionBody() ,
        'descriptionBody');

      /*
       * Started working
       * result = NULL, date_start = Last week, date_end = null, date = NULL
       */
      $moduleDone = ModuleDone::find(101);
      $this->assertEquals('T2 (S: '.$moduleDone->date_start->format('d-m-Y').')' ,
        $moduleDone->descriptionHeader(),
        'descriptionHeader');
      $this->assertEquals(
        $moduleDone->Module->description.' ('.$moduleDone->Module->sbu.')' ,
        $moduleDone->descriptionBody(),
        'descriptionBody');

       /*
        * Stopped working
        * result = NULL, date_start = Last week , date_end = Today
        */
      $moduleDone = ModuleDone::find(102);
      $this->assertEquals(
          'T3 (S: '.$moduleDone->date_start->format('d-m-Y').')' ,
          $moduleDone->descriptionHeader(),
          'descriptionHeader');
      $this->assertEquals(
          $moduleDone->Module->description.' ('.$moduleDone->Module->sbu.')' ,
          $moduleDone->descriptionBody(),
          'descriptionBody');


    }
}
