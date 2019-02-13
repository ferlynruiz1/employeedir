
<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
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
// date_default_timezone_set('Asia/Manila');

Route::get('cron/importlatest', 'EmployeeInfoController@checklatest');
Route::get('cron/attrition', 'EmployeeInfoController@attrition');

Route::get('/', function () {
	if(Auth::check()){
		if(Auth::user()->isAdmin()){
			return redirect('/dashboard');
		}else{
			return redirect('/home');		
		}
	}else{
    	return redirect('/home');	
	}
});

Route::get('logout', function(){
	 Auth::logout();
	 return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('employees', 'EmployeeInfoController@employees');
Route::get('profile/{id}', 'EmployeeInfoController@profile');

Route::get('admin/invalid', ['as' => 'admin-invalid', 'uses' => function(){
	return view('errors.notadmin');
}]);

Auth::routes();
Route::post('login', 'EmployeeInfoController@login');
Route::get('newhires', 'HomeController@newhires');

Route::middleware(['auth'])->group(function(){
	Route::middleware(['admin'])->group(function () {
		Route::get('dashboard', 'HomeController@dashboard');
		Route::resource('department', 'DepartmentController');
		Route::resource('employee_info', 'EmployeeInfoController');
		Route::resource('activities', 'ActivityController');
		Route::get('employee/{id}/changepassword', 'EmployeeInfoController@changepassword');
		Route::get('employees/separated', 'EmployeeInfoController@separatedEmployees');
	});

	Route::resource('leave', 'LeaveController');
	Route::get('myprofile', 'EmployeeInfoController@myprofile');
	Route::post('employee/{id}/savepassword', 'EmployeeInfoController@savepassword');
	Route::get('employees/import', 'EmployeeInfoController@import');
	Route::post('employees/import', 'EmployeeInfoController@importsave');
	Route::get('employees/export', function(){
		try {
			$files = File::allFiles('./public/excel/report');
			$files = array_slice($files, 0, 5);
		} catch (Exception $e) {
			$files = array();
		}
		
		return view('employee.export')->with('files', $files);
	});
	Route::get('exportdownload', 'EmployeeInfoController@exportdownload');
	Route::get('employees/sync', function(){
		return view('employee.sync');
	});
});

Route::get('showactivities/{id}', 'ActivityController@show');
Route::post('import/birthdays', "EmployeeInfoController@importbday");

Route::get('import/birthdays', function(){
	return "<form enctype='multipart/form-data' method='POST' action='birthdays'><input type='file' name='dump_file'>
	<input type='submit' value='submit' />".csrf_field()." </form>";
});

Route::post('api/login', 'EmployeeInfoController@loginAPI');
Route::post('api/v2/login', 'EmployeeInfoController@loginAPIv2');
Route::get('api/session', 'EmployeeInfoController@session');
