<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\ModuleGroup;

class ModuleGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $modulegroups = ModuleGroup::orderBy('module_groups.domains')->paginate(10);
      return view('modulegroups.index', compact('modulegroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $modulegroup = new ModuleGroup();
      return view('modulegroups.create',compact('modulegroup'));
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
           'domains' => 'required',
           'description' => 'required'
       ]);
       ModuleGroup::create($request->all());
       return redirect()->route('modulegroups.index')->with('success','Modulegroep toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $modulegroup = ModuleGroup::find($id);

      return view('modulegroups.show',compact('modulegroup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $modulegroup = ModuleGroup::find($id);
      return view('modulegroups.edit',compact('modulegroup'));
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
           'domains' => 'required',
           'description' => 'required'
       ]);

      ModuleGroup::find($id)->update($request->all());
      return redirect()->route('modulegroups.index')->with('success','Modulegroep aangepast');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      ModuleGroup::find($id)->delete();

      return redirect()->route('modulegroups.index')
                      ->with('success','Modulegroep verwijderd');
    }
}
