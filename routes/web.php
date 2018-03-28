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
date_default_timezone_set('Asia/Manila');
Route::get('test', function(){
	if (Hash::check('123123','$2y$10$UPVY0aLAstifspnrOvEJpufSL.7GM/Di.9FbHt3PlKnzQ5PxPEa.u')) {
    	return "true";
	}
	return "false";

});
Route::get('/', function () {
	if(Auth::check()){
		if(Auth::user()->isAdmin()){
			return redirect('/dashboard');
		}else{
			return redirect('/home');		
		}
	}else{
    	return View::make('auth.login');
	}
});

Route::get('logout', function(){
	 Auth::logout();
	 return redirect('/login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/invalid', ['as' => 'admin-invalid', 'uses' => function(){
	return view('errors.notadmin');
}]);

Auth::routes();

Route::post('login', 'EmployeeInfoController@login');
Route::middleware(['auth'])->group(function(){
	Route::get('employees', 'EmployeeInfoController@employees');
	Route::get('profile/{id}', 'EmployeeInfoController@profile');
	Route::get('myprofile', 'EmployeeInfoController@myprofile');

Route::middleware(['admin'])->group(function () {
	Route::get('dashboard', 'HomeController@dashboard');
	Route::resource('department', 'DepartmentController');
	Route::resource('employee_info', 'EmployeeInfoController');
	Route::get('employee/{id}/changepassword', 'EmployeeInfoController@changepassword');
});
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

});

function getNameFromNumber($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num - 1) / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2) . $letter;
    } else {
        return $letter;
    }
}
function genderValue($gender){
	if($gender == 'Female' || $gender == 'F' || $gender == 'FEMALE'){
		return 2;
	}else if ($gender == 'Male' || $gender == 'M' || $gender == 'MALE') {
		return 1;
	}else{
		return 0;
	}
}
function genderStringValue($gender){
	switch ($gender) {
		case '1':
			return "MALE";
		case 1:
			return "MALE";
		case '2';
			return "FEMALE";
		case 2:
			return "FEMALE";
		default:
			return "";
	}
}

function joinGrammar($prod_date){
	$prod_date_timestamp = strtotime($prod_date);
	$current_timestamp = time();

	if($prod_date_timestamp > $current_timestamp){
		return "Will join";
	}
	return "Joined";
}	