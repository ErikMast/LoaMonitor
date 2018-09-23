<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use LoaMonitor\Student;
use Illuminate\Support\Facades\Log;

class StudentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSearch()
    {
      Log::info("");
      Log::info("Testing Student::search");
      // In student view
      //Search in Student expect 3 in this group
      $students=Student::getStudents("avicos1a", false);
      $this->assertEquals(3, $students->count(), "StudentView: By group");

      //Search by Firstname expect 3 students
      $students=Student::getStudents("Jaap", false);
      $this->assertEquals(3, $students->count(), "StudentView: By FirstName");

      //Search by Lastname expect 3 students
      $students=Student::getStudents("meloen", false);
      $this->assertEquals(3, $students->count(), "StudentView: By LastName");

      //Search empty expect 6 students
      $students=Student::getStudents("", false);
      $this->assertEquals(6, $students->count(), "StudentView: All");

      // In student Dashboard
      //Search in Student expect 1 in this group
      $students=Student::getStudents("avicos1a", true);
      $this->assertEquals(1, $students->count(), "Dashboard: By Group");

      //Search by Firstname expect 1 students
      $students=Student::getStudents("jaap", true);
      $this->assertEquals(1, $students->count(), "Dashboard: By FirstName");

      //Search by Lastname expect 1 students
      $students=Student::getStudents("meloen", true);
      $this->assertEquals(1, $students->count(), "Dashboard: By LastName");

      //Search empty expect 2 students
      $students=Student::getStudents("", true);
      $this->assertEquals(2, $students->count(), "Dashboard: All");
    }

    public function testGetStudentsByVisibility() {
      Log::info("Testing Student::getStudentsByVisibility");
      //Expect 2 students in Dashboard
      $students=Student::getStudentsByVisibility(true);
      $this->assertEquals(2, $students->count(), "Dashboard:  visibility");

      //Expect 6 students in view
      $students=Student::getStudentsByVisibility(false);
      $this->assertEquals(6, $students->count(), "StudentView: visibility");

    }
}
