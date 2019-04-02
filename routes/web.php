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
Route::post('/trainings/create', 'TrainingsController@create');
//Route::get('/trainings/create', 'TrainingsController@create');
Route::get('/trainings/manage', 'TrainingsController@manage');

Route::get('/trainings/{id}/edit', 'TrainingsController@edit')->name('trainings.edit');
Route::put('/trainings/{id}', 'TrainingsController@update');

Route::post('/training/store', 'TrainingsController@store');

Route::delete('/training/{training}','TrainingsController@delete');

Route::delete('/favorite', 'FavoritesController@delete');
Route::post('/favorite/store', 'FavoritesController@store');
Route::get('/favorite/show/{id}', 'FavoritesController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/welcome', 'HomeController@welcome');
