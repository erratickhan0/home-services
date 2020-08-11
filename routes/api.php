<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function() {
Route::get('v1.0/user/{userId}/detail', 'UserController@show');
   //categories routes
    Route::get('v1.0/p_categories', 'CategoriesController@getParentCategories');
    Route::get('v1.0/child_categories/{parent_id}', 'CategoriesController@getChildrenCategories');
    //labours routes
    Route::get('v1.0/labours/{id}', 'LaboursController@findById');
    Route::get('v1.0/labours-all', 'LaboursController@findByAll');
    Route::get('v1.0/labours/{id}/timings', 'LaboursController@findLabourTimings');
    Route::get('v1.0/labours/{id}/locations', 'LaboursController@findLabourLocations');
    //create customer

});

Route::post('v1.0/register', 'AuthController@register');
Route::post('v1.0/login', 'AuthController@login');
Route::post('v1.0/register_customer', 'AuthController@register_customer');
