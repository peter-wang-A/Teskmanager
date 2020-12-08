<?php



Route::get('users/history', 'UsersController@history')->name('admin.users.history')->middleware(['history', 'auth']);
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


//错误
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('auth');


// pusher
Route::get('/pusher-test', function () {

    return view('message.test');
});

// chat 页面
Route::get('/chart/index','ChartController@index')->name('chart.index');



//在线聊天
Route::post('/chart/{chart}','ChartController@create')->name('chart.create');
Route::get('/chart','ChartController@index')->name('chart.index');


