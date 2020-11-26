<?php




Auth::routes();

Route::get('/', 'ProjectsController@index')->name('index');


Route::resource('projects', 'ProjectsController');
Route::resource('tasks', 'TasksController');
