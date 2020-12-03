<?php




Auth::routes();

Route::get('/', 'ProjectsController@index')->name('index');


Route::resource('projects', 'ProjectsController');
Route::get('/tasks/search', 'TasksController@search')->name('search');
Route::get('tasks/charts', 'TasksController@charts')->name('tasks.charts');
Route::resource('tasks', 'TasksController');

//完成所有
Route::post('tasks/{task}/steps/doneAll', 'StepController@doneAll');
//删除所有
Route::delete('tasks/{task}/steps/clearAll', 'StepController@clearAll');
//切换状态
Route::patch('tasks/{task}/steps/{step}/toggle', 'StepController@toggle');
Route::resource('tasks.steps', 'StepController');


Route::post('tasks/{id}/check', 'TasksController@check')->name('tasks.check');
