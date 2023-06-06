<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('clinic/', [TestController::class, 'getClinic']); */

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
	Route::get('/', function () {
		return view('home');
	});
	
	Route::group(['middleware' => ['guest']], function() {

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
        Route::get('/logout', 'LoginController@logout')->name('login.logout');        

    });
	
	
	//Route::middleware('clinicAdminAccess')->group(function(){
	Route::group(['prefix' => 'ca_dashboard', 'middleware' => ['clinicAdminAccess']], function() {
		Route::get('/', 'ClinicController@dashboard')->name('clinic.admin.dashboard');
		Route::get('/my-clinic', 'ClinicController@show')->name('my-clinic.show');
		Route::resource('staffs', 'StaffController');
	 
	});
	
	Route::group(['prefix' => 'doctor_dashboard', 'middleware' => ['doctorAdminAccess']], function() {
		Route::get('/', 'ClinicController@dashboard')->name('dashboard');
		//Route::get('/my-clinic', 'ClinicController@show')->name('my-clinic.show');	 
	});
	
});
