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
    return view('welcome');
});

Route::get('login', 'App\Http\Controllers\LoginController@login')->name('login');
Route::post('login', 'App\Http\Controllers\LoginController@login')->name('login');

// Student routes
Route::group(['middleware' => ['auth', 'role:student']], function() {
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('room', 'App\Http\Controllers\RoomController@index')->name('room');
});

// Agent routes
Route::group(['middleware' => ['auth', 'role:agent'], 'as' => 'agent.', 'prefix' => 'agent'], function() {
    Route::get('dashboard', 'App\Http\Controllers\Agent\DashboardController@index')->name('dashboard');
    Route::get('room/create', 'App\Http\Controllers\Agent\RoomController@create')->name('agent.room-form');
});

// Admin routes
Route::group(['middleware' => ['auth', 'role:admin'], 'as' => 'admin.', 'prefix' => 'admin'], function() {
    Route::get('dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
});