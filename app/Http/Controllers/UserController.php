<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use LoaMonitor\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::all();
      return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = new User();
      $user->password = bcrypt('Welkom1234');
      return view('users.create',compact('user'));
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
          'firstname' => 'required',
          'lastname' => 'required',
          'email' => 'email|required'
      ]);
      User::create($request->all());
      return redirect()->route('users.index')
                     ->with('success','Gebruiker toegevoegd');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view ('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
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
          'firstname' => 'required',
          'lastname' => 'required',
          'email' => 'email|required'
      ]);
      User::find($id)->update($request->all());

      return redirect()->route('users.index')->with('success','Gebruiker gewijzigd');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //User::fincd($id)->delete();

      return redirect()-route('users.index')
        ->with('success', 'Gebruiker niet verwijderd');
    }
}
