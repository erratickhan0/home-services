<?php

use Illuminate\Support\Facades\Route;

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
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin{any}', 'AdminController@adminIndex')->where('any', '.*');


Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth:web')->group(function() {
    //for admin panel routes
    //Categories
    Route::resource('category', 'CategoryController');
    Route::get('categories-all', 'CategoryController@getAll');
    Route::post('sub-category','CategoryController@subCategoryCreate');

    //Labours
    Route::resource('labour', 'LaboursController');
    Route::get('/labours-all', 'LaboursController@findByAllAdmin');

    Route::get('/jobs-all', 'JobsController@findByAllAdmin');
    Route::post('job-status-change','JobsController@jobStatusChangeByAdmin');


    Route::get('/time-slots', 'TimeSlotsController@findTimeSlots');
    Route::post('add-labour-timings','LaboursController@addLabourTimings');
    Route::get('/get-labour-slots', 'LaboursController@getLabourSlots');




});

Route::get('/insert-cities', 'AdminController@insertCities');
Route::get('/get-cities', 'AdminController@getAllCities');
