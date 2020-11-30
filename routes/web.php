<?php




Auth::routes();

Route::get('/', 'ProjectsController@index')->name('index');


Route::resource('projects', 'ProjectsController');
Route::resource('tasks', 'TasksController');

//完成所有
Route::post('tasks/{task}/steps/doneAll', 'StepController@doneAll');
//删除所有
Route::delete('tasks/{task}/steps/clearAll', 'StepController@clearAll');
Route::resource('tasks.steps', 'StepController');


Route::post('tasks/{id}/chechk', 'TasksController@check')->name('tasks.check');
