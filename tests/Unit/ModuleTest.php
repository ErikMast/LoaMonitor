<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use LoaMonitor\Module;

class ModuleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetFullNameAttribute()
    {
      $module = new Module([
        'domain' => 'T',
        'level' => '9',
        'description' => 'Test',
        'sbu' => '10',
      ]);

      $this->assertEquals($module->getFullNameAttribute(), 'T9 Test (10)', "FullNameAttribe");
    }
}
