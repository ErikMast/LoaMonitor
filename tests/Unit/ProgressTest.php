<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use DateTime;
use DateInterval;
use LoaMonitor\Progress;

class ProgressTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testhasDeadline()
    {
      $progress = factory(Progress::class)->make();

      // $deadline = new DateTime();
      //
      // $progress = new Progress([
      //   'students_id'=>'1' ,
      //   'date'=>new DateTime(),
      //   'date_deadline'=> null,
      //   'notes' => 'Deadline',
      //   'users_id' => 1
      // ]);

      $this->assertFalse($progress->hasDeadlineNotExpired(), 'Progress has NO UnExpired  Deadline');
      $this->assertFalse($progress->hasDeadlineExpired(), 'Progress NOT Expired');

      $progress->date_deadline =$progress->date->add(new DateInterval('P1D'));
      $this->assertTrue($progress->hasDeadlineNotExpired(), 'Progress has UnExpired Deadline');
      $this->assertFalse($progress->hasDeadlineExpired(), 'Progress NOT Expired');

      $progress->deadline_met = true;
      $this->assertFalse($progress->hasDeadlineNotExpired(), 'Progress has not UnExpired Deadline');
      $this->assertFalse($progress->hasDeadlineExpired(), 'Progress NOT Expired');

      $progress->deadline_met = false;
      $progress->date_deadline = $progress->date->sub(new DateInterval('P10D'));
      $this->assertFalse($progress->hasDeadlineNotExpired(), 'Progress has NO UnExpired  Deadline');
      $this->assertTrue($progress->hasDeadlineExpired(), 'Progress Expired');

      $progress->deadline_met = true;
      $this->assertFalse($progress->hasDeadlineNotExpired(), 'Progress has NO UnExpired  Deadline');
      $this->assertFalse($progress->hasDeadlineExpired(), 'Progress Expired');
    }
}
