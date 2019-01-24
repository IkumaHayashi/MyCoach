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

Route::get('/trainings/new', 'TrainingsController@new');

Route::post('/training/edit/{training_id}', 'TrainingsController@edit');

Route::post('/training/add', 'TrainingsController@add');

Route::delete('/training/{training}','TrainingsController@delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');