<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\Group;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::orderBy('sortorder')->paginate(10);
        return view("groups.index", compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $group = new Group();
      $groups = Group::orderBy('sortorder')->pluck('name', 'id');
      return view('groups.create',compact('group', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Group::create($request->all());
      return redirect()->route('groups.index')->with('success', 'Klas toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        $groups = Group::orderBy('sortorder')->pluck('name', 'id');
        $next = Group::find($group->next_groups_id);
        if ($group->next_groups_id==0) {
          $group ->next_groups_id = $group->id;
          $next = Group::find($id);
          $name = $next->name;
          Log::info("Startname: ".$name);
          if (strpos($name, '1')) {
            $name = str_replace('1', '2', $name);
          } elseif (strpos($name, '2')) {
            $name = str_replace('2', '3', $name);
          } elseif (strpos($name, '3')){
            $name = substr($name, 0, 2)."-vanopleiding";
          }
          Log::info("Nextname: ".$name);
          $next = Group::find(Group::getIdByName($name));
          if ($next != NULL && $next->id != 0) {
            $group ->next_groups_id = $next->id;
          }
        }
        return view('groups.edit', compact('group', 'groups'));
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
        Group::find($id)->update($request->all());
        return redirect()->route('groups.index')->with('success', 'Klas bewaard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
