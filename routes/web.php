<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
    return View::make('auth.login');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', function(){
	 Auth::logout();
	 return redirect('/login');
});

Route::resource('employee_info', 'EmployeeInfoController');

Route::get('employee/{id}/changepassword', 'EmployeeInfoController@changepassword');
Route::post('employee/{id}/savepassword', 'EmployeeInfoController@savepassword');

Auth::routes();