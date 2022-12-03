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


Route::get('student/login', 'App\Http\Controllers\LoginController@login')->name('student.login');
Route::post('student/login', 'App\Http\Controllers\LoginController@login')->name('student.login');

Route::get('agent/login', 'App\Http\Controllers\Agent\LoginController@login')->name('agent.login');
Route::post('agent/login', 'App\Http\Controllers\Agent\LoginController@login')->name('agent.login');

Route::get('admin/login', 'App\Http\Controllers\Admin\LoginController@login')->name('admin.login');
Route::post('admin/login', 'App\Http\Controllers\Admin\LoginController@login')->name('admin.login');

Route::get('login', 'App\Http\Controllers\LoginController@selectLogin')->name('login');
Route::get('logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

// Student routes
Route::group(['middleware' => ['auth:web_student']], function() {
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('room', 'App\Http\Controllers\RoomController@index')->name('room');
    Route::get('room/index', 'App\Http\Controllers\RoomController@index')->name('room-index');
    Route::get('room/view/{roomId}', 'App\Http\Controllers\RoomController@view')->name('room-view');
    Route::post('room/book/{roomId}', 'App\Http\Controllers\RoomController@book')->name('room-book');

    Route::get('reservation/index', 'App\Http\Controllers\ReservationController@index')->name('reservation-index');
    Route::get('reservation/update/{reservationId}', 'App\Http\Controllers\ReservationController@update')->name('reservation-update');
    Route::post('reservation/update/{reservationId}', 'App\Http\Controllers\ReservationController@update')->name('reservation-update');
    Route::get('reservation/cancel/{reservationId}', 'App\Http\Controllers\ReservationController@cancel')->name('reservation-cancel');
    Route::get('reservation/pay/{reservationId}', 'App\Http\Controllers\ReservationController@pay')->name('reservation-pay');
    
    // Route::get('reservation', 'App\Http\Controllers\ReservationController@index')->name('reservation');
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

    Route::get('reservation/index', 'App\Http\Controllers\Agent\ReservationController@index')->name('reservation-index');
    Route::get('reservation/approve/{reservationId}', 'App\Http\Controllers\Agent\ReservationController@approve')->name('reservation-approve');
    Route::get('reservation/reject/{reservationId}', 'App\Http\Controllers\Agent\ReservationController@reject')->name('reservation-reject');
});

// Admin routes
Route::group(['middleware' => ['auth', 'role:admin'], 'as' => 'admin.', 'prefix' => 'admin'], function() {
    Route::get('dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
});