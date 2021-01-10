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
      //Search in Student expect 2 in this group
      $students=Student::getStudents("avicos1a", false);
      $this->assertEquals(2, $students->count(), "StudentView: By group");

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
      //Search in Student expect 2 in this group
      $students=Student::getStudents("avicos1a", true);
      $this->assertEquals(2, $students->count(), "Dashboard: By Group");

      //Search by Firstname expect 2 students
      $students=Student::getStudents("jaap", true);
      $this->assertEquals(2, $students->count(), "Dashboard: By FirstName");

      //Search by Lastname expect 1 students
      $students=Student::getStudents("meloen", true);
      $this->assertEquals(2, $students->count(), "Dashboard: By LastName");

      //Search empty expect 4 students
      $students=Student::getStudents("", true);
      $this->assertEquals(4, $students->count(), "Dashboard: All");
    }

    public function testGetStudentsByVisibility() {
      Log::info("Testing Student::getStudentsByVisibility");
      //Expect 2 students in Dashboard
      $students=Student::getStudentsByVisibility(true);
      $this->assertEquals(4, $students->count(), "Dashboard:  visibility");

      //Expect 6 students in view
      $students=Student::getStudentsByVisibility(false);
      $this->assertEquals(6, $students->count(), "StudentView: visibility");

    }

    public function testToBeCalled(){
      //Student id =2 moet gebeld worden id= =1 niet
      $studentCall = Student::where("id","=", "2")->whereNull("end_date")->first();
      $student= Student::where("id","=", "1")->whereNull("end_date")->first();

      $this->assertTrue($studentCall->toBeCalled(), "Zichtbare student bellen");
      $this->assertFalse($student->toBeCalled(), "Zichtbare student NIET bellen");

      //Student id =3 (niet zichtbaar) en id=5 (einddatum) niet bellen
      $student= Student::where("id","=", "3")->first();
      $this->assertFalse($student->toBeCalled(), "Niet Zichtbare student NIET bellen");

      $student= Student::where("id","=", "5")->first();
      $this->assertFalse($student->toBeCalled(), "Student met einddatum NIET bellen");
    }

    public function testSumOfSBU(){
      //Student id = 2 sbu = 0
      $student = Student::find("2");
      $this->assertEquals(0, $student->sumOfSBU(), "Geen modules voltooid");

      //Student id = 1 sbu = 78 waarvan een dubbel gedaan
      $student = Student::find("1");
      $this->assertEquals(78, $student->sumOfSBU(), "Modules voltooid");
    }
}
