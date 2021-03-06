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

Route::get('/', function () {
    return view('index');
});

Route::get('/validator', function(){
    return view('validator');
});

Route::prefix('/service')->group(function () {
    Route::get('/validate', 'ValidatorController@harvestURL')->name('harvest_url');
    Route::post('/validateXML','ValidatorController@validateXML')->name('validate_xml');
});

