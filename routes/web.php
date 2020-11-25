<?php



Route::get('/', 'HomeController@root')->name('root');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::post('projects', 'ProjectsComntroller@store')->name('projects.store');
