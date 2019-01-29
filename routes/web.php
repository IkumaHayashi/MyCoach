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
use App\Training;
use Illuminate\Http\Request;

Route::get('/', 'TrainingsController@index');
Route::get('/trainings', 'TrainingsController@index');
Route::get('/trainings/show/{id}','TrainingsController@show');
Route::get('/trainings/create', 'TrainingsController@create');

Route::get('/trainings/{id}/edit', 'TrainingsController@edit');
Route::put('/trainings/{id}', 'TrainingsController@update');

Route::post('/training/add', 'TrainingsController@add');

Route::delete('/training/{training}','TrainingsController@delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
