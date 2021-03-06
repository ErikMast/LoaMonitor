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

  Route::get('/changepassword', 'PasswordController@edit')->name('changepassword');
  Route::post('/updatepassword/{id}', 'PasswordController@update')->name('updatepassword');

  Route::resource('students','StudentController');
  Route::resource('notes','NoteController');
  Route::resource('modulegroups', 'ModuleGroupController');
  Route::resource('modules', 'ModuleController');
  Route::resource('moduledones', 'ModuleDoneController');
  Route::resource('users', 'UserController');
  Route::resource('villages', 'VillageController');
  Route::resource('progresses', 'ProgressController');

  //csv import studenten
  Route::get('csvdata', 'CsvdataController@index');
  Route::post('csvdata/import', 'CsvdataController@import');
  Route::get('sbustats', 'SbuStatsController@index');

  //csv import Logboek
  Route::get('imports/logbook', 'ImportLogbook@index');
  Route::post('imports/logbook/import', 'ImportLogbook@import');
  Route::get('logbooks', 'LogbookController@index')->name('logbooks');
  Route::get('logbookoverview', 'LogbookOverviewController@index')->name('logbookoverview');


  //Studenten naar volgende klas
  Route::get('movestudents', 'MoveStudentsController@index');
  Route::post('movestudents/move', 'MoveStudentsController@move');
  Route::post('movestudents/revert', 'MoveStudentsController@revert');
  Route::resource('groups', 'GroupController');


  Route::get('laravel-version', function()  {
      $laravel = app();
      return "Your Laravel version is ".$laravel::VERSION;
});
  });
