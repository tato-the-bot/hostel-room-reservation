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
})->name('home');

Route::get('login', 'App\Http\Controllers\LoginController@login')->name('login');
Route::post('login', 'App\Http\Controllers\LoginController@login')->name('login');
Route::get('logout', 'App\Http\Controllers\LoginController@logout')->name('logout');


// Student routes
Route::group(['middleware' => ['auth', 'role:student']], function() {
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('room', 'App\Http\Controllers\RoomController@index')->name('room');
    Route::get('room/index', 'App\Http\Controllers\RoomController@index')->name('room-index');
    Route::get('room/view/{roomId}', 'App\Http\Controllers\RoomController@view')->name('room-view');
    Route::post('room/book/{roomId}', 'App\Http\Controllers\RoomController@book')->name('room-book');
    Route::get('reservation/index', 'App\Http\Controllers\ReservationController@index')->name('reservation-index');
    
    Route::get('reservation', 'App\Http\Controllers\ReservationController@index')->name('reservation');
});

// Agent routes
Route::group(['middleware' => ['auth', 'role:agent'], 'as' => 'agent.', 'prefix' => 'agent'], function() {
    Route::get('dashboard', 'App\Http\Controllers\Agent\DashboardController@index')->name('dashboard');
    Route::get('room/index', 'App\Http\Controllers\Agent\RoomController@index')->name('room-index');

    Route::get('room/update/{roomId}', 'App\Http\Controllers\Agent\RoomController@update')->name('room-update');
    Route::post('room/update/{roomId}', 'App\Http\Controllers\Agent\RoomController@update')->name('room-update');
    
    Route::get('room/delete/{roomId}', 'App\Http\Controllers\Agent\RoomController@delete')->name('room-delete');

    Route::get('room/create', 'App\Http\Controllers\Agent\RoomController@create')->name('room-create');
    Route::post('room/create', 'App\Http\Controllers\Agent\RoomController@create')->name('room-create');
});

// Admin routes
Route::group(['middleware' => ['auth', 'role:admin'], 'as' => 'admin.', 'prefix' => 'admin'], function() {
    Route::get('dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
});