<?php

namespace LoaMonitor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LoaMonitor\User;

class PasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
      $user = Auth::user();
      return view('users.changepassword', compact('user'));
    }

    public function update(Request $request, $id)
    {
       $this->validate($request, [
           'old_password' => 'required',
           'password' => 'required',
           'password_confirmation'=> 'required|same:password'
       ]);

       //dit kan nog beter...
       $user = User::findOrFail($id);
       $user->password = bcrypt($request->password);
       $user->save();

		   return redirect()->route('home')->with('success','Password changed');
    }
}
