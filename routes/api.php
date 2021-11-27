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
Route::post('/app/login','UserController@login');
Route::post('/app/register','UserController@register');
Route::get('/app/logout','UserController@logout');

Route::middleware(['auth:api'])->group(function(){

    //Categories Routes
    Route::get('/categories/index','CategoryController@index');

    Route::post('/categories/store','CategoryController@store');
    Route::get('/categories/show/{id}','CategoryController@show');
    Route::post('/categories/update/{id}','CategoryController@update');
    Route::get('/categories/destroy/{id}','CategoryController@destroy');
    Route::get('/categories/search/{param}','CategoryController@search');

    //Clothes Routes
    Route::get('/clothes/index','ClotheController@index');
    Route::post('/clothes/store','ClotheController@store');
    Route::get('/clothes/show/{id}','ClotheController@show');
    Route::post('/clothes/update/{id}','ClotheController@update');
    Route::get('/clothes/destroy/{id}','ClotheController@destroy');
});