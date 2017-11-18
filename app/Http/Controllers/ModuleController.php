<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\Module;

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
    $modules = Module::orderBy('level')->orderBy('domain')->paginate(10);
    return view('modules.index', compact('modules'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $module = new Module();
    $module -> domain = 'A';
    $module ->level = 0;
    $domains = $this->domains;
    $levels = $this->levels;
    return view('modules.create',compact('module', 'domains', 'levels'));

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
          'domain' => 'required',
          'level' => 'required',
          'description' => 'required'
      ]);
      $request["domain"] = $this->adjustDomain($request["domain"]);
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
      $domains = $this->domains;
      $levels = $this->levels;
      return view('modules.edit',compact('module', 'domains', 'levels'));
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
         'domain' => 'required',
         'level' => 'required',
         'description' => 'required'
     ]);

     //workaround voor lijst
     $request["domain"] = $this->adjustDomain($request["domain"]);

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
