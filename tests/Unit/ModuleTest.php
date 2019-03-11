<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use LoaMonitor\Module;
use LoaMonitor\ModuleGroup;

class ModuleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetFullNameAttribute()
    {
      $moduleGroup = ModuleGroup::where("domains", '=', 'T')->first();
      $module = new Module([
        'level' => '9',
        'description' => 'Test',
        'module_groups_id' =>$moduleGroup->id,
        'sbu' => '10',
      ]);

      $this->assertEquals(
        $module->getFullNameAttribute(),
        'T9 Test (10)', "FullNameAttribe");
    }
}
