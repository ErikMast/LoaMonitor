<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\Module;
use LoaMonitor\ModuleGroup;

class ModuleController extends Controller
{

    public $domains = ['Domein', 'A', 'B', 'C', 'D', 'E', 'F', 'G'];
    public $levels =['Level', '1', '2', '3', '4', '5', '6'];

    public function adjustDomain($domain) {
      $domain = intval($domain);
      if (($domain>0)&&($domain<7)) {
        return $this->domains[$domain];
      } else {
        return $domain;
      }

    }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $modules = Module::select('modules.*')->join('module_groups', "module_groups.id", "=", "modules.module_groups_id")->orderBy('modules.level')->orderBy('module_groups.domains')->paginate(10);
    return view('modules.index', compact('modules'));
  }

  public function getModuleGroupDescriptions(){
    return ModuleGroup::selectRaw('id, concat (domains, " ",description) as full_description')->pluck('full_description','id');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $module = new Module();
    $module ->ModuleGroup = ModuleGroup::find(1);
    $module ->level = 0;
    $module ->sbu = 0;
    $moduleGroups = $this->getModuleGroupDescriptions();
    $levels = $this->levels;
    return view('modules.create',compact('module', 'moduleGroups', 'levels'));

  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
     $this->validate($request, [
          'module_groups_id' => 'required',
          'level' => 'required',
          'description' => 'required',
          'sbu'=> 'required|integer'
      ]);
      //$request["domain"] = $this->adjustDomain($request["domain"]);
      Module::create($request->all());
      return redirect()->route('modules.index')->with('success','Module toegevoegd');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $module = Module::find($id);

      return view('modules.show',compact('module'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $module = Module::find($id);
      $moduleGroups = $this->getModuleGroupDescriptions();
      $levels = $this->levels;
      return view('modules.edit',compact('module', 'moduleGroups', 'levels'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
         'module_groups_id' => 'required',
         'level' => 'required',
         'description' => 'required',
         'sbu'=> 'required|integer'
     ]);

     //workaround voor lijst
    // $request["domain"] = $this->adjustDomain($request["domain"]);

     Module::find($id)->update($request->all());
     return redirect()->route('modules.index')->with('success','Module aangepast');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {

      Module::find($id)->delete();

      return redirect()->route('modules.index')
                      ->with('success','Module verwijderd');
  }
}
