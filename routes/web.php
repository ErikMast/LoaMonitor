<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//Route::group: disables access when not logged in (redirect to Login page)
Route::group(['middleware' => ['auth']], function() {
  Route::get('/', 'HomeController@index')->name('home');

  //todo implement change password
  Route::get('/changepassword', 'PasswordController@edit')->name('changepassword');

  Route::resource('students','StudentController');
  Route::resource('notes','NoteController');
  Route::get('csvdata', 'CsvdataController@index');
  Route::post('csvdata/import', 'CsvdataController@import');
});
