<?php




Auth::routes();

Route::get('/', 'ProjectsController@index')->name('index');


Route::resource('projects', 'ProjectsController');
Route::resource('tasks', 'TasksController');
Route::resource('tasks.steps', 'StepController');

Route::post('tasks/{id}/chechk', 'TasksController@check')->name('tasks.check');
