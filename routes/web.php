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

// Student login page
Route::get('student/login', 'App\Http\Controllers\LoginController@login')->name('student.login');
Route::post('student/login', 'App\Http\Controllers\LoginController@login')->name('student.login');

// Student forget password page
Route::get('student/forget-password', 'App\Http\Controllers\LoginController@forgetPassword')->name('student.login.forget-password');
Route::post('student/forget-password', 'App\Http\Controllers\LoginController@forgetPassword')->name('student.login.forget-password');

// Student reset password OTP page
Route::get('student/password-reset-otp', 'App\Http\Controllers\LoginController@passwordResetOtp')->name('student.login.reset-password-otp');
Route::post('student/password-reset-otp', 'App\Http\Controllers\LoginController@passwordResetOtp')->name('student.login.reset-password-otp');

// Student reset password page
Route::get('student/password-reset', 'App\Http\Controllers\LoginController@passwordReset')->name('student.login.reset-password');
Route::post('student/password-reset', 'App\Http\Controllers\LoginController@passwordReset')->name('student.login.reset-password');

// Student register page
Route::get('student/register', 'App\Http\Controllers\RegisterController@register')->name('student.register');
Route::post('student/register', 'App\Http\Controllers\RegisterController@register')->name('student.register');

// Student OTP page
Route::get('student/register/otp', 'App\Http\Controllers\RegisterController@registerOtp')->name('student.register.otp');
Route::post('student/register/otp', 'App\Http\Controllers\RegisterController@registerOtp')->name('student.register.otp');

//Student Save rating 
Route::post('room/rating/{roomId}', 'App\Http\Controllers\RatingController@store')->name('room-rating');


// Agent login page
Route::get('agent/login', 'App\Http\Controllers\Agent\LoginController@login')->name('agent.login');
Route::post('agent/login', 'App\Http\Controllers\Agent\LoginController@login')->name('agent.login');

// Agent forget password page
Route::get('agent/forget-password', 'App\Http\Controllers\Agent\LoginController@forgetPassword')->name('agent.login.forget-password');
Route::post('agent/forget-password', 'App\Http\Controllers\Agent\LoginController@forgetPassword')->name('agent.login.forget-password');

// Agent reset password OTP page
Route::get('agent/password-reset-otp', 'App\Http\Controllers\Agent\LoginController@passwordResetOtp')->name('agent.login.reset-password-otp');
Route::post('agent/password-reset-otp', 'App\Http\Controllers\Agent\LoginController@passwordResetOtp')->name('agent.login.reset-password-otp');

// Agent reset password page
Route::get('agent/password-reset', 'App\Http\Controllers\Agent\LoginController@passwordReset')->name('agent.login.reset-password');
Route::post('agent/password-reset', 'App\Http\Controllers\Agent\LoginController@passwordReset')->name('agent.login.reset-password');

// Agent register page
Route::get('agent/register', 'App\Http\Controllers\Agent\RegisterController@register')->name('agent.register');
Route::post('agent/register', 'App\Http\Controllers\Agent\RegisterController@register')->name('agent.register');

// Agent OTP page
Route::get('agent/register/otp', 'App\Http\Controllers\Agent\RegisterController@registerOtp')->name('agent.register.otp');
Route::post('agent/register/otp', 'App\Http\Controllers\Agent\RegisterController@registerOtp')->name('agent.register.otp');


// Admin login page
Route::get('admin/login', 'App\Http\Controllers\Admin\LoginController@login')->name('admin.login');
Route::post('admin/login', 'App\Http\Controllers\Admin\LoginController@login')->name('admin.login');

// Agent forget password page
Route::get('admin/forget-password', 'App\Http\Controllers\Admin\LoginController@forgetPassword')->name('admin.login.forget-password');
Route::post('admin/forget-password', 'App\Http\Controllers\Admin\LoginController@forgetPassword')->name('admin.login.forget-password');

// admin reset password OTP page
Route::get('admin/password-reset-otp', 'App\Http\Controllers\Admin\LoginController@passwordResetOtp')->name('admin.login.reset-password-otp');
Route::post('admin/password-reset-otp', 'App\Http\Controllers\Admin\LoginController@passwordResetOtp')->name('admin.login.reset-password-otp');

// admin reset password page
Route::get('admin/password-reset', 'App\Http\Controllers\Admin\LoginController@passwordReset')->name('admin.login.reset-password');
Route::post('admin/password-reset', 'App\Http\Controllers\Admin\LoginController@passwordReset')->name('admin.login.reset-password');

// admin register page
Route::get('admin/register', 'App\Http\Controllers\Admin\RegisterController@register')->name('admin.register');
Route::post('admin/register', 'App\Http\Controllers\Admin\RegisterController@register')->name('admin.register');

// admin OTP page
Route::get('admin/register/otp', 'App\Http\Controllers\Admin\RegisterController@registerOtp')->name('admin.register.otp');
Route::post('admin/register/otp', 'App\Http\Controllers\Admin\RegisterController@registerOtp')->name('admin.register.otp');




// Choose login page
Route::get('login', 'App\Http\Controllers\LoginController@selectLogin')->name('login');

// Universal logout link
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
    Route::post('reservation/pay/{reservationId}', 'App\Http\Controllers\ReservationController@pay')->name('reservation-pay');

    Route::get('transaction/invoice/{transactionId}', 'App\Http\Controllers\TransactionController@invoice')->name('transaction-invoice');
});

// Agent routes
Route::group(['middleware' => ['auth:web_agent'], 'as' => 'agent.', 'prefix' => 'agent'], function() {
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
Route::group(['middleware' => ['auth:web_admin'], 'as' => 'admin.', 'prefix' => 'admin'], function() {
    Route::get('dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
});